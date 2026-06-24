<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dynamic sitemap (includes all blog posts) — must be before the redirect catch-all
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

// Legacy URLs from the previous app version (/items/*, /public/items/*).
// Return 410 Gone so search engines drop them from the index.
Route::any('/items/{any}', fn () => abort(410))->where('any', '.*');
Route::any('/public/{any}', fn () => abort(410))->where('any', '.*');

// Auth routes - must be before redirect route
require __DIR__.'/auth.php';

// Public pages - must be before redirect route
Route::get('/about', [\App\Http\Controllers\PageController::class, 'about'])->name('pages.about');
Route::get('/contact', [\App\Http\Controllers\PageController::class, 'contact'])->name('pages.contact');
Route::get('/privacy', [\App\Http\Controllers\PageController::class, 'privacy'])->name('pages.privacy');
Route::get('/terms', [\App\Http\Controllers\PageController::class, 'terms'])->name('pages.terms');
Route::get('/faq', [\App\Http\Controllers\PageController::class, 'faq'])->name('pages.faq');
Route::get('/disclaimer', [\App\Http\Controllers\PageController::class, 'disclaimer'])->name('pages.disclaimer');

// Blog routes
Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

// Dashboard - must be before redirect route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Public link creation (no auth required) — rate limited against spam/abuse
Route::post('/links', [LinkController::class, 'store'])
    ->middleware('throttle:link-create')
    ->name('links.store');

// Authenticated routes - must be before redirect route
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Links routes (authenticated)
    Route::get('/links', [LinkController::class, 'index'])->name('links.index');
    Route::get('/links/create', [LinkController::class, 'create'])->name('links.create');
    Route::get('/links/{link}', [LinkController::class, 'show'])->name('links.show');
    Route::get('/links/{link}/edit', [LinkController::class, 'edit'])->name('links.edit');
    Route::put('/links/{link}', [LinkController::class, 'update'])->name('links.update');
    Route::delete('/links/{link}', [LinkController::class, 'destroy'])->name('links.destroy');
    Route::get('/links/{link}/qrcode', [LinkController::class, 'qrcode'])->name('links.qrcode');

    // Admin routes (require is_admin in addition to the auth group above)
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/users', [\App\Http\Controllers\Admin\DashboardController::class, 'users'])->name('users');
        Route::get('/links', [\App\Http\Controllers\Admin\DashboardController::class, 'links'])->name('links');
        Route::get('/settings/adsense', [\App\Http\Controllers\Admin\SettingsController::class, 'adsense'])->name('settings.adsense');
        Route::post('/settings/adsense', [\App\Http\Controllers\Admin\SettingsController::class, 'updateAdsense'])->name('settings.adsense.update');
    });
});

// Redirect engine - MUST BE LAST (catch-all for short links)
Route::get('/{slug}', [RedirectController::class, 'redirect'])
    ->where('slug', '[a-zA-Z0-9]+')
    ->name('redirect');
