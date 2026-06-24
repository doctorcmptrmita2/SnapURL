<?php

namespace App\Console\Commands;

use App\Models\Link;
use App\Models\LinkAnalytic;
use App\Models\LinkClick;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AggregateLinkAnalytics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'links:aggregate {--date=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aggregate link click data into daily analytics';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = $this->option('date') ?: now()->subDay()->format('Y-m-d');

        $this->info("Aggregating analytics for date: {$date}");

        // Get all links with clicks on this date
        $links = Link::whereHas('clicks', function ($query) use ($date) {
            $query->whereDate('clicked_at', $date);
        })->get();

        foreach ($links as $link) {
            $clicks = LinkClick::where('link_id', $link->id)
                ->whereDate('clicked_at', $date)
                ->get();

            $totalClicks = $clicks->count();
            $uniqueClicks = $clicks->unique('ip_hash')->count();

            // Update or create analytics record
            LinkAnalytic::updateOrCreate(
                [
                    'link_id' => $link->id,
                    'date' => $date,
                ],
                [
                    'clicks' => $totalClicks,
                    'unique_clicks' => $uniqueClicks,
                ]
            );
        }

        $this->info("Aggregated analytics for {$links->count()} links");
    }
}
