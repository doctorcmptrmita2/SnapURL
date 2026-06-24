<?php

use App\Http\Controllers\Api\V1\LinkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API v1 routes
Route::prefix('v1')->middleware(['auth:sanctum', 'throttle:100,1'])->group(function () {
    Route::apiResource('links', LinkController::class);
    Route::get('/links/{link}/stats', [LinkController::class, 'stats'])->name('links.stats');
});

