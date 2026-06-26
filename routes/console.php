<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Daily re-scan of existing links against Safe Browsing (catches zero-day
// phishing that gets flagged after a link was created).
Schedule::command('links:rescan')->dailyAt('03:00');
