<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbuseLog;
use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard.
     */
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_links' => Link::count(),
            'total_clicks' => Link::sum('click_count'),
            'active_links' => Link::where('status', 'active')->count(),
            'abuse_blocks' => AbuseLog::count(),
        ];

        $recentUsers = User::latest()->limit(10)->get();
        $recentLinks = Link::with('user')->latest()->limit(10)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentLinks'));
    }

    /**
     * Show all users.
     */
    public function users()
    {
        $users = User::with('plan')->withCount('links')->latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    /**
     * Show all links (URL shortening activity).
     */
    public function links(Request $request)
    {
        $query = Link::with('user')->latest();

        if ($search = trim((string) $request->get('q'))) {
            $query->where('destination_url', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%");
        }

        $links = $query->paginate(25)->withQueryString();
        return view('admin.links', compact('links'));
    }

    /**
     * Abuse log — where spam/abuse was blocked.
     */
    public function abuseLogs()
    {
        $logs = AbuseLog::latest()->paginate(50);

        $topIps = AbuseLog::selectRaw('ip_address, COUNT(*) as hits')
            ->whereNotNull('ip_address')
            ->groupBy('ip_address')
            ->orderByDesc('hits')
            ->limit(10)
            ->get();

        $byReason = AbuseLog::selectRaw('reason, COUNT(*) as hits')
            ->groupBy('reason')
            ->orderByDesc('hits')
            ->get();

        return view('admin.abuse-logs', compact('logs', 'topIps', 'byReason'));
    }

    /**
     * Delete a link (moderation).
     */
    public function destroyLink(Link $link)
    {
        Cache::forget("link:{$link->slug}");
        $link->delete();

        return back()->with('success', 'Link deleted.');
    }

    /**
     * Delete a user and their links (moderation). Cannot delete admins or yourself.
     */
    public function destroyUser(User $user)
    {
        if ($user->is_admin || $user->id === auth()->id()) {
            return back()->withErrors(['error' => 'You cannot delete an admin or your own account.']);
        }

        Link::where('user_id', $user->id)->delete();
        $user->delete();

        return back()->with('success', 'User and their links deleted.');
    }
}
