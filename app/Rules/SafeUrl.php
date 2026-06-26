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
        foreach ((array) config('linkguard.blocked_domains', []) as $bad) {
            $bad = strtolower(trim($bad));
            if ($bad !== '' && ($host === $bad || str_ends_with($host, '.' . $bad))) {
                $this->block($fail, 'blocklist', $url, 'This destination domain is blocked.');
                return;
            }
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

    private function block(Closure $fail, string $reason, string $url, string $message): void
    {
        AbuseLog::record($reason, $url);
        $fail($message);
    }
}
