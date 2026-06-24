<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

/**
 * Validates that a destination URL is safe to shorten:
 *  - only http/https schemes
 *  - not pointing back to this site (loop / abuse amplification)
 *  - not localhost / internal / private or reserved IP ranges (SSRF + abuse)
 *  - not on the configured domain blocklist
 *  - optionally checked against Google Safe Browsing (when an API key is set)
 */
class SafeUrl implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $url = trim((string) $value);
        $parts = parse_url($url);

        if ($parts === false || empty($parts['scheme']) || empty($parts['host'])) {
            $fail('The :attribute is not a valid URL.');
            return;
        }

        $scheme = strtolower($parts['scheme']);
        if (! in_array($scheme, ['http', 'https'], true)) {
            $fail('Only http and https links can be shortened.');
            return;
        }

        $host = strtolower($parts['host']);

        // Block links that point back to this site (redirect loops / abuse).
        $appHost = parse_url((string) config('app.url'), PHP_URL_HOST);
        if ($appHost) {
            $appHost = strtolower($appHost);
            if ($host === $appHost || str_ends_with($host, '.' . $appHost)) {
                $fail('You cannot shorten a link that points to this site.');
                return;
            }
        }

        // Obvious internal / metadata endpoints.
        $blockedHosts = ['localhost', '0.0.0.0', '::1', 'metadata.google.internal', '169.254.169.254'];
        if (in_array($host, $blockedHosts, true)) {
            $fail('This destination is not allowed.');
            return;
        }

        // Configurable domain blocklist (BLOCKED_DOMAINS in .env).
        foreach ((array) config('linkguard.blocked_domains', []) as $bad) {
            $bad = strtolower(trim($bad));
            if ($bad !== '' && ($host === $bad || str_ends_with($host, '.' . $bad))) {
                $fail('This destination domain is blocked.');
                return;
            }
        }

        // Resolve to an IP and reject private / reserved ranges (SSRF + internal targets).
        $ip = filter_var($host, FILTER_VALIDATE_IP) ? $host : gethostbyname($host);
        if ($ip && filter_var($ip, FILTER_VALIDATE_IP)
            && ! filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            $fail('This destination is not allowed.');
            return;
        }

        // Optional Google Safe Browsing check (only if configured).
        $key = config('services.safebrowsing.key');
        if ($key) {
            try {
                $resp = Http::timeout(4)->post(
                    'https://safebrowsing.googleapis.com/v4/threatMatches:find?key=' . $key,
                    [
                        'client' => ['clientId' => 'snapurl', 'clientVersion' => '1.0'],
                        'threatInfo' => [
                            'threatTypes' => ['MALWARE', 'SOCIAL_ENGINEERING', 'UNWANTED_SOFTWARE', 'POTENTIALLY_HARMFUL_APPLICATION'],
                            'platformTypes' => ['ANY_PLATFORM'],
                            'threatEntryTypes' => ['URL'],
                            'threatEntries' => [['url' => $url]],
                        ],
                    ]
                );

                if ($resp->successful() && ! empty($resp->json('matches'))) {
                    $fail('This URL was flagged as unsafe and cannot be shortened.');
                    return;
                }
            } catch (\Throwable $e) {
                // Fail open: don't block legitimate users if the API is unreachable.
            }
        }
    }
}
