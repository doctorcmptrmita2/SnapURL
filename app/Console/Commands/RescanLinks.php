<?php

namespace App\Console\Commands;

use App\Models\AbuseLog;
use App\Models\Link;
use App\Support\SafeBrowsing;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class RescanLinks extends Command
{
    protected $signature = 'links:rescan';

    protected $description = 'Re-scan active links against Google Safe Browsing and disable any that became unsafe';

    public function handle(SafeBrowsing $safeBrowsing): int
    {
        if (! config('services.safebrowsing.key')) {
            $this->warn('GOOGLE_SAFE_BROWSING_KEY not set — skipping rescan.');
            return self::SUCCESS;
        }

        $disabled = 0;

        Link::where('status', 'active')->orderBy('id')->chunk(100, function ($links) use ($safeBrowsing, &$disabled) {
            foreach ($links as $link) {
                if ($safeBrowsing->isThreat($link->destination_url)) {
                    $link->update(['status' => 'disabled']);
                    Cache::forget("link:{$link->slug}");
                    AbuseLog::record('safe_browsing_rescan', $link->destination_url);
                    $disabled++;
                    $this->warn("Disabled #{$link->id}: {$link->destination_url}");
                }
            }
        });

        $this->info("Rescan complete. Disabled {$disabled} unsafe link(s).");

        return self::SUCCESS;
    }
}
