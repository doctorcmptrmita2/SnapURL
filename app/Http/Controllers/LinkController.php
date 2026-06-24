<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Models\Link;
use App\Services\LinkService;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LinkController extends Controller
{
    public function __construct(
        private LinkService $linkService
    ) {
    }

    /**
     * Display a listing of links.
     */
    public function index(Request $request)
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        $links = $this->linkService->getUserLinks($request->user()->id);

        return view('links.index', compact('links'));
    }

    /**
     * Show the form for creating a new link.
     */
    public function create()
    {
        return view('links.create');
    }

    /**
     * Store a newly created link.
     */
    public function store(StoreLinkRequest $request)
    {
        try {
            $data = $request->validated();
            // Record a hashed IP so anonymous creators are traceable / rate-limitable.
            $data['ip_hash'] = hash('sha256', (string) $request->ip());

            $link = $this->linkService->createLink(
                $data,
                $request->user()?->id
            );

            if ($request->expectsJson() || $request->wantsJson() || $request->ajax()) {
                // Build short URL manually
                $domain = $link->custom_domain ?? config('app.url');
                $shortUrl = rtrim($domain, '/') . '/' . $link->slug;
                
                return response()->json([
                    'message' => 'Link created successfully',
                    'link' => [
                        'id' => $link->id,
                        'slug' => $link->slug,
                        'destination_url' => $link->destination_url,
                        'short_url' => $shortUrl,
                        'click_count' => $link->click_count,
                        'status' => $link->status,
                        'created_at' => $link->created_at->toIso8601String(),
                    ],
                ], 201);
            }

            return redirect()->route('links.show', $link)
                ->with('success', 'Link created successfully');
        } catch (\Exception $e) {
            if ($request->expectsJson() || $request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'error' => $e->getMessage(),
                ], 422);
            }

            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified link.
     */
    public function show(Link $link)
    {
        // Check authorization
        if ($link->user_id && $link->user_id !== auth()->id() && !auth()->user()?->is_admin) {
            abort(403);
        }

        $analytics = $link->analytics()
            ->orderBy('date', 'desc')
            ->limit(30)
            ->get();

        return view('links.show', compact('link', 'analytics'));
    }

    /**
     * Show the form for editing the specified link.
     */
    public function edit(Link $link)
    {
        // Check authorization
        if ($link->user_id && $link->user_id !== auth()->id() && !auth()->user()?->is_admin) {
            abort(403);
        }

        return view('links.edit', compact('link'));
    }

    /**
     * Update the specified link.
     */
    public function update(UpdateLinkRequest $request, Link $link)
    {
        try {
            $link = $this->linkService->updateLink($link, $request->validated());

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Link updated successfully',
                    'link' => $link,
                ]);
            }

            return redirect()->route('links.show', $link)
                ->with('success', 'Link updated successfully');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $e->getMessage(),
                ], 422);
            }

            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified link.
     */
    public function destroy(Link $link)
    {
        // Check authorization
        if ($link->user_id && $link->user_id !== auth()->id() && !auth()->user()?->is_admin) {
            abort(403);
        }

        $this->linkService->deleteLink($link);

        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'Link deleted successfully',
            ]);
        }

        return redirect()->route('links.index')
            ->with('success', 'Link deleted successfully');
    }

    /**
     * Generate QR code for link.
     */
    public function qrcode(Link $link, Request $request)
    {
        $format = $request->get('format', 'svg'); // svg only (png requires imagick extension)

        $url = $link->short_url;

        // PNG format requires imagick extension which is not installed
        // Only SVG format is supported
        if ($format === 'png') {
            // Return SVG instead of PNG since imagick is not available
            return response(QrCode::format('svg')->size(300)->generate($url))
                ->header('Content-Type', 'image/svg+xml');
        }

        return response(QrCode::format('svg')->size(300)->generate($url))
            ->header('Content-Type', 'image/svg+xml');
    }
}
