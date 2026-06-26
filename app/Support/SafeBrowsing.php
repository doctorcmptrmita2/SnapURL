<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;

class SafeBrowsing
{
    /**
     * Returns true if the URL is flagged by Google Safe Browsing.
     * Fails open (returns false) when not configured or unreachable.
     */
    public function isThreat(string $url): bool
    {
        $key = config('services.safebrowsing.key');
        if (! $key) {
            return false;
        }

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

            return $resp->successful() && ! empty($resp->json('matches'));
        } catch (\Throwable $e) {
            return false;
        }
    }
}
