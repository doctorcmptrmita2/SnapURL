<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Http\Resources\Api\V1\LinkResource;
use App\Models\Link;
use App\Services\LinkService;
use Illuminate\Http\Request;

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
        $links = $this->linkService->getUserLinks($request->user()->id);

        return LinkResource::collection($links);
    }

    /**
     * Store a newly created link.
     */
    public function store(StoreLinkRequest $request)
    {
        try {
            $link = $this->linkService->createLink(
                $request->validated(),
                $request->user()->id
            );

            return new LinkResource($link);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    /**
     * Display the specified link.
     */
    public function show(Link $link)
    {
        // Check authorization
        if ($link->user_id !== request()->user()->id && !request()->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return new LinkResource($link);
    }

    /**
     * Update the specified link.
     */
    public function update(UpdateLinkRequest $request, Link $link)
    {
        try {
            $link = $this->linkService->updateLink($link, $request->validated());

            return new LinkResource($link);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    /**
     * Remove the specified link.
     */
    public function destroy(Link $link)
    {
        // Check authorization
        if ($link->user_id !== request()->user()->id && !request()->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $this->linkService->deleteLink($link);

        return response()->json([
            'message' => 'Link deleted successfully',
        ]);
    }

    /**
     * Get link statistics.
     */
    public function stats(Link $link)
    {
        // Check authorization
        if ($link->user_id !== request()->user()->id && !request()->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $analytics = $link->analytics()
            ->orderBy('date', 'desc')
            ->limit(30)
            ->get();

        $clicks = $link->clicks()
            ->selectRaw('device_type, COUNT(*) as count')
            ->groupBy('device_type')
            ->get();

        $countries = $link->clicks()
            ->selectRaw('country, COUNT(*) as count')
            ->whereNotNull('country')
            ->groupBy('country')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        return response()->json([
            'total_clicks' => $link->click_count,
            'unique_clicks' => $link->unique_click_count,
            'analytics' => $analytics,
            'devices' => $clicks,
            'countries' => $countries,
        ]);
    }
}
