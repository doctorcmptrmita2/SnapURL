<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Repository bindings
        $this->app->bind(
            \App\Repositories\LinkRepositoryInterface::class,
            \App\Repositories\LinkRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fix for MySQL utf8mb4 index key length issue
        Schema::defaultStringLength(191);

        // Rate limit for public link creation. Guests are limited tightly by IP
        // (per-minute + per-day) to stop spam/abuse; authenticated users get more.
        RateLimiter::for('link-create', function (Request $request) {
            return $request->user()
                ? [Limit::perMinute(30)->by('user:' . $request->user()->id)]
                : [
                    Limit::perMinute(5)->by('ip:' . $request->ip()),
                    Limit::perDay(50)->by('ipday:' . $request->ip()),
                ];
        });
    }
}
