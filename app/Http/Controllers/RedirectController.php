<?php

namespace App\Http\Controllers;

use App\Jobs\LogLinkClick;
use App\Services\LinkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class RedirectController extends Controller
{
    public function __construct(
        private LinkService $linkService
    ) {
    }

    /**
     * Handle link redirect.
     */
    public function redirect(string $slug, Request $request)
    {
        // Check cache first
        $cacheKey = "link:{$slug}";
        $link = Cache::remember($cacheKey, 3600, function () use ($slug) {
            return $this->linkService->getLinkForRedirect($slug);
        });

        if (!$link) {
            abort(404, 'Link not found or expired');
        }

        // Check password protection
        if ($link->password) {
            $password = $request->get('password');
            if (!$password || !Hash::check($password, $link->password)) {
                return view('links.password', compact('link'));
            }
        }

        // Queue click logging (pass only primitive values to avoid serialization issues)
        LogLinkClick::dispatch(
            $link->id,
            $request->ip(),
            $request->userAgent(),
            $request->header('referer')
        );

        // Increment click count
        $this->linkService->incrementClickCount($link);

        // Clear cache
        Cache::forget($cacheKey);

        // Redirect with 301 (SEO-friendly). Mark noindex so the short link
        // itself is never indexed — only the destination matters.
        return redirect($link->destination_url, 301)
            ->header('X-Robots-Tag', 'noindex');
    }
}
