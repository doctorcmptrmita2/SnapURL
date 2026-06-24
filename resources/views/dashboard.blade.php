<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Header -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Welcome back, {{ Auth::user()->name }}!</h1>
                <p class="text-gray-500 mt-1">Here's what's happening with your links</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-2xl soft-shadow p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Links</p>
                            <p class="text-2xl font-bold text-gray-900">{{ auth()->user()->links()->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl soft-shadow p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Clicks</p>
                            <p class="text-2xl font-bold text-gray-900">{{ auth()->user()->links()->sum('click_count') }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl soft-shadow p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Unique Clicks</p>
                            <p class="text-2xl font-bold text-gray-900">{{ auth()->user()->links()->sum('unique_click_count') }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl soft-shadow p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Active Links</p>
                            <p class="text-2xl font-bold text-gray-900">{{ auth()->user()->links()->where('status', 'active')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ad Banner (Header) -->
            <x-adsense slot="header" />

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white rounded-2xl soft-shadow p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-900">Quick Actions</h2>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            <a href="{{ route('links.create') }}" class="flex flex-col items-center p-4 bg-gray-50 rounded-xl hover:bg-orange-50 transition-colors group">
                                <div class="w-10 h-10 brand-gradient rounded-lg flex items-center justify-center mb-2">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-700 group-hover:text-orange-600">New Link</span>
                            </a>
                            <a href="{{ route('links.index') }}" class="flex flex-col items-center p-4 bg-gray-50 rounded-xl hover:bg-blue-50 transition-colors group">
                                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mb-2">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-700 group-hover:text-blue-600">All Links</span>
                            </a>
                            <a href="{{ route('profile.edit') }}" class="flex flex-col items-center p-4 bg-gray-50 rounded-xl hover:bg-purple-50 transition-colors group">
                                <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center mb-2">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-700 group-hover:text-purple-600">Profile</span>
                            </a>
                            <a href="{{ route('admin.settings.adsense') }}" class="flex flex-col items-center p-4 bg-gray-50 rounded-xl hover:bg-green-50 transition-colors group">
                                <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center mb-2">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-700 group-hover:text-green-600">AdSense</span>
                            </a>
                        </div>
                    </div>

                    <!-- Analytics Chart -->
                    @php
                        $allAnalytics = \App\Models\LinkAnalytic::whereIn('link_id', auth()->user()->links()->pluck('id'))
                            ->selectRaw('date, SUM(clicks) as total_clicks, SUM(unique_clicks) as total_unique_clicks')
                            ->groupBy('date')
                            ->orderBy('date', 'desc')
                            ->limit(30)
                            ->get()
                            ->reverse();
                    @endphp
                    @if($allAnalytics->count() > 0)
                        <div class="bg-white rounded-2xl soft-shadow p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Analytics Overview</h2>
                            <canvas id="dashboardChart" height="100"></canvas>
                        </div>
                    @endif

                    <!-- Recent Links -->
                    <div class="bg-white rounded-2xl soft-shadow p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-900">Recent Links</h2>
                            <a href="{{ route('links.index') }}" class="text-orange-600 hover:text-orange-700 text-sm font-medium">View All →</a>
                        </div>
                        @php
                            $recentLinks = auth()->user()->links()->latest()->limit(5)->get();
                        @endphp
                        @if($recentLinks->count() > 0)
                            <div class="space-y-3">
                                @foreach($recentLinks as $link)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                                        <div class="flex-1 min-w-0">
                                            <a href="{{ route('links.show', $link) }}" class="text-gray-900 font-medium hover:text-orange-600 truncate block">
                                                {{ $link->slug }}
                                            </a>
                                            <p class="text-gray-500 text-sm truncate">{{ Str::limit($link->destination_url, 40) }}</p>
                                        </div>
                                        <div class="flex items-center gap-4 ml-4">
                                            <div class="text-right">
                                                <p class="text-gray-900 font-semibold">{{ $link->click_count }}</p>
                                                <p class="text-gray-500 text-xs">clicks</p>
                                            </div>
                                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $link->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                                {{ ucfirst($link->status) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                </div>
                                <p class="text-gray-500 mb-4">No links yet. Create your first short link!</p>
                                <a href="{{ route('links.create') }}" class="inline-flex items-center gap-2 brand-gradient text-white px-6 py-2 rounded-lg font-semibold hover:opacity-90">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Create Link
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Sidebar Ad -->
                    <x-adsense slot="sidebar" />

                    <!-- Tips Card -->
                    <div class="bg-gradient-to-br from-orange-500 to-pink-500 rounded-2xl p-6 text-white">
                        <h3 class="font-semibold mb-2">💡 Pro Tip</h3>
                        <p class="text-white/90 text-sm">Use custom slugs to make your links more memorable and brandable. Short, descriptive slugs perform better!</p>
                    </div>

                    <!-- Another Sidebar Ad -->
                    <x-adsense slot="sidebar" />
                </div>
            </div>

            <!-- Footer Ad -->
            <x-adsense slot="footer" />
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            @if($allAnalytics->count() > 0)
            const ctx = document.getElementById('dashboardChart');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($allAnalytics->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d'))->values()) !!},
                    datasets: [{
                        label: 'Total Clicks',
                        data: {!! json_encode($allAnalytics->pluck('total_clicks')->values()) !!},
                        borderColor: 'rgb(255, 107, 107)',
                        backgroundColor: 'rgba(255, 107, 107, 0.1)',
                        tension: 0.4,
                        fill: true
                    }, {
                        label: 'Unique Clicks',
                        data: {!! json_encode($allAnalytics->pluck('total_unique_clicks')->values()) !!},
                        borderColor: 'rgb(255, 142, 83)',
                        backgroundColor: 'rgba(255, 142, 83, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
            @endif
        </script>
    @endpush
</x-app-layout>
