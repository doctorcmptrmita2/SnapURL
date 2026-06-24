<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SnapURL') }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        .brand-gradient { background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 50%, #FFC107 100%); }
        .brand-text { background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .soft-shadow { box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .input-focus:focus { border-color: #FF8E53; box-shadow: 0 0 0 3px rgba(255, 142, 83, 0.1); }
    </style>
    @php
        $adsenseClientId = \App\Models\SiteSetting::get('adsense_client_id');
    @endphp
    @if($adsenseClientId)
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-{{ $adsenseClientId }}" crossorigin="anonymous"></script>
    @endif
</head>
<body class="bg-gray-50 antialiased" x-data="{ mobileMenu: false }">
    <!-- Navigation -->
    <nav class="bg-white soft-shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-8">
                    <!-- Logo -->
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <div class="w-9 h-9 brand-gradient rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-900">Snap<span class="brand-text">URL</span></span>
                    </a>
                    <!-- Desktop Nav -->
                    <div class="hidden md:flex items-center gap-6">
                        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'text-orange-600 font-semibold' : 'text-gray-600 hover:text-gray-900' }} font-medium">Dashboard</a>
                        <a href="{{ route('links.index') }}" class="{{ request()->routeIs('links.*') ? 'text-orange-600 font-semibold' : 'text-gray-600 hover:text-gray-900' }} font-medium">My Links</a>
                        <a href="{{ route('links.create') }}" class="brand-gradient text-white px-4 py-2 rounded-lg text-sm font-semibold hover:opacity-90 transition-opacity flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            New Link
                        </a>
                    </div>
                </div>
                <!-- User Menu -->
                <div class="hidden md:flex items-center gap-4">
                    <a href="{{ route('admin.settings.adsense') }}" class="text-gray-500 hover:text-gray-700" title="AdSense Settings">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </a>
                    <div x-data="{ open: false }" class="relative">
                        <button x-on:click="open = !open" class="flex items-center gap-2 text-gray-700 hover:text-gray-900">
                            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                <span class="text-sm font-semibold text-gray-600">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-on:click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-xl soft-shadow py-2 z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">Profile</a>
                            <a href="{{ route('admin.settings.adsense') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">AdSense Settings</a>
                            <hr class="my-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">Log Out</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button x-on:click="mobileMenu = !mobileMenu" class="text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div x-show="mobileMenu" x-transition class="md:hidden bg-white border-t">
            <div class="px-4 py-4 space-y-3">
                <a href="{{ route('dashboard') }}" class="block py-2 text-gray-700 font-medium">Dashboard</a>
                <a href="{{ route('links.index') }}" class="block py-2 text-gray-700 font-medium">My Links</a>
                <a href="{{ route('links.create') }}" class="block py-2 text-orange-600 font-semibold">+ New Link</a>
                <hr>
                <a href="{{ route('profile.edit') }}" class="block py-2 text-gray-700">Profile</a>
                <a href="{{ route('admin.settings.adsense') }}" class="block py-2 text-gray-700">AdSense Settings</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left py-2 text-red-600">Log Out</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    @stack('scripts')
</body>
</html>
