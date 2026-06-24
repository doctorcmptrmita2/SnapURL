<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;

/**
 * Cloudflare Turnstile verification.
 *
 * If no secret key is configured the verifier returns true (captcha disabled),
 * so the site keeps working until keys are added. When configured it fails
 * closed (a missing/invalid token is rejected).
 */
class Turnstile
{
    public function enabled(): bool
    {
        return ! empty(config('services.turnstile.secret_key'));
    }

    public function verify(?string $token, ?string $ip = null): bool
    {
        if (! $this->enabled()) {
            return true;
        }

        if (empty($token)) {
            return false;
        }

        try {
            $resp = Http::asForm()->timeout(5)->post(
                'https://challenges.cloudflare.com/turnstile/v0/siteverify',
                [
                    'secret' => config('services.turnstile.secret_key'),
                    'response' => $token,
                    'remoteip' => $ip,
                ]
            );

            return (bool) $resp->json('success', false);
        } catch (\Throwable $e) {
            return false;
        }
    }
}
