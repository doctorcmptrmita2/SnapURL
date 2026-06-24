<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;

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
        $users = User::with('plan')->paginate(20);
        return view('admin.users', compact('users'));
    }

    /**
     * Show all links.
     */
    public function links()
    {
        $links = Link::with('user')->paginate(20);
        return view('admin.links', compact('links'));
    }
}
