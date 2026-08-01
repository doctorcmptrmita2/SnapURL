<?php

namespace App\Rules;

use App\Models\AbuseLog;
use App\Support\SafeBrowsing;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Validates that a destination URL is safe to shorten:
 *  - only http/https schemes
 *  - not pointing back to this site (loop / abuse amplification)
 *  - not localhost / internal / private or reserved IP ranges (SSRF + abuse)
 *  - not on the configured domain blocklist
 *  - not another URL shortener (chaining hides the real destination)
 *  - not a free ephemeral tunnel host (trycloudflare, ngrok, ...)
 *  - not on a TLD we see almost nothing but spam from
 *  - not impersonating a protected brand ("gooqle-meet-app.live")
 *  - not flagged by Google Safe Browsing (when an API key is set)
 *
 * Every block is recorded to the abuse log for admin visibility.
 */
class SafeUrl implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $url = trim((string) $value);
        $parts = parse_url($url);

        if ($parts === false || empty($parts['scheme']) || empty($parts['host'])) {
            $this->block($fail, 'invalid_url', $url, 'The :attribute is not a valid URL.');
            return;
        }

        $scheme = strtolower($parts['scheme']);
        if (! in_array($scheme, ['http', 'https'], true)) {
            $this->block($fail, 'scheme', $url, 'Only http and https links can be shortened.');
            return;
        }

        $host = strtolower($parts['host']);

        // Block links that point back to this site (redirect loops / abuse).
        $appHost = parse_url((string) config('app.url'), PHP_URL_HOST);
        if ($appHost) {
            $appHost = strtolower($appHost);
            if ($host === $appHost || str_ends_with($host, '.' . $appHost)) {
                $this->block($fail, 'self_link', $url, 'You cannot shorten a link that points to this site.');
                return;
            }
        }

        // Obvious internal / metadata endpoints.
        $blockedHosts = ['localhost', '0.0.0.0', '::1', 'metadata.google.internal', '169.254.169.254'];
        if (in_array($host, $blockedHosts, true)) {
            $this->block($fail, 'internal', $url, 'This destination is not allowed.');
            return;
        }

        // Configurable domain blocklist (BLOCKED_DOMAINS in .env).
        if ($this->hostMatches($host, config('linkguard.blocked_domains', []))) {
            $this->block($fail, 'blocklist', $url, 'This destination domain is blocked.');
            return;
        }

        // Other shorteners / cloakers: refuse to be the second hop in a chain.
        if ($this->hostMatches($host, config('linkguard.blocked_shorteners', []))) {
            $this->block($fail, 'shortener_chain', $url, 'Links to other URL shorteners cannot be shortened.');
            return;
        }

        // Free tunnel / preview hosts, which rotate faster than any blocklist.
        if ($this->hostMatches($host, config('linkguard.blocked_ephemeral_hosts', []))) {
            $this->block($fail, 'ephemeral_host', $url, 'This destination is not allowed.');
            return;
        }

        // High-abuse TLDs.
        $tld = strtolower((string) substr(strrchr($host, '.') ?: '', 1));
        if ($tld !== '' && in_array($tld, (array) config('linkguard.blocked_tlds', []), true)) {
            $this->block($fail, 'blocked_tld', $url, 'This destination domain is blocked.');
            return;
        }

        // Brand impersonation / typosquatting.
        if ($brand = $this->impersonatedBrand($host)) {
            $this->block($fail, 'brand_impersonation', $url, 'This destination looks like it impersonates ' . ucfirst($brand) . '.');
            return;
        }

        // Resolve to an IP and reject private / reserved ranges (SSRF + internal targets).
        $ip = filter_var($host, FILTER_VALIDATE_IP) ? $host : gethostbyname($host);
        if ($ip && filter_var($ip, FILTER_VALIDATE_IP)
            && ! filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            $this->block($fail, 'ssrf', $url, 'This destination is not allowed.');
            return;
        }

        // Google Safe Browsing (only if configured).
        if (app(SafeBrowsing::class)->isThreat($url)) {
            $this->block($fail, 'safe_browsing', $url, 'This URL was flagged as unsafe and cannot be shortened.');
            return;
        }
    }

    /**
     * True when the host is one of the domains, or a subdomain of one.
     */
    private function hostMatches(string $host, mixed $domains): bool
    {
        foreach ((array) $domains as $domain) {
            $domain = strtolower(trim((string) $domain));
            if ($domain !== '' && ($host === $domain || str_ends_with($host, '.' . $domain))) {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns the brand a hostname impersonates, or null. A brand is considered
     * impersonated when it appears as a hostname token ("paypal" in
     * "paypal.safe-status.com") — or, for longer brands, a single-character typo
     * of one ("gooqle-meet-app.live") — while the host is not on the brand's own
     * domain. Tokens are split on dots and dashes so "pineapple.com" stays clean.
     */
    private function impersonatedBrand(string $host): ?string
    {
        $tokens = preg_split('/[.\-_]+/', $host, -1, PREG_SPLIT_NO_EMPTY) ?: [];

        foreach ((array) config('linkguard.protected_brands', []) as $brand => $official) {
            if ($this->hostMatches($host, $official)) {
                continue;
            }

            foreach ($tokens as $token) {
                if ($token === $brand) {
                    return $brand;
                }

                // Typo variants only for names long enough that a 1-edit match
                // is not a coincidence ("beta" vs "meta" would be).
                if (strlen($brand) >= 6 && levenshtein($token, $brand) === 1) {
                    return $brand;
                }
            }
        }

        return null;
    }

    private function block(Closure $fail, string $reason, string $url, string $message): void
    {
        AbuseLog::record($reason, $url);
        $fail($message);
    }
}
