<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AdSense Settings - SnapURL</title>
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
</head>
<body class="bg-gray-50 antialiased">
    <!-- Navigation -->
    <nav class="bg-white soft-shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-8">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <div class="w-9 h-9 brand-gradient rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-900">Snap<span class="brand-text">URL</span></span>
                    </a>
                    <div class="hidden md:flex items-center gap-6">
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 font-medium">Dashboard</a>
                        <a href="{{ route('links.index') }}" class="text-gray-600 hover:text-gray-900 font-medium">Links</a>
                        <a href="{{ route('admin.settings.adsense') }}" class="text-orange-600 font-semibold">AdSense</a>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-gray-600 text-sm">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-gray-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">AdSense Settings</h1>
            <p class="text-gray-500 mt-1">Configure your Google AdSense ad units for the website</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.settings.adsense.update') }}">
            @csrf

            <!-- AdSense Client ID -->
            <div class="bg-white rounded-2xl soft-shadow p-6 mb-6">
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-12 h-12 brand-gradient rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Publisher ID</h2>
                        <p class="text-gray-500 text-sm">Your Google AdSense Publisher ID (without "ca-pub-" prefix)</p>
                    </div>
                </div>
                <div>
                    <label for="adsense_client_id" class="block text-sm font-medium text-gray-700 mb-2">Publisher ID</label>
                    <div class="flex items-center">
                        <span class="px-4 py-3 bg-gray-100 border border-r-0 border-gray-200 rounded-l-xl text-gray-500 text-sm">ca-pub-</span>
                        <input type="text" id="adsense_client_id" name="adsense_client_id" value="{{ $settings['adsense_client_id'] }}"
                            class="flex-1 px-4 py-3 border border-gray-200 rounded-r-xl text-gray-800 focus:outline-none input-focus"
                            placeholder="1234567890123456">
                    </div>
                    @error('adsense_client_id')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Ad Slots -->
            <div class="bg-white rounded-2xl soft-shadow p-6 mb-6">
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Ad Unit Slots</h2>
                        <p class="text-gray-500 text-sm">Enter the slot IDs for each ad placement area</p>
                    </div>
                </div>

                <div class="grid gap-6">
                    <!-- Header Slot -->
                    <div>
                        <label for="adsense_header_slot" class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <span class="w-3 h-3 bg-purple-500 rounded-full"></span>
                                Header Ad Slot
                            </span>
                        </label>
                        <input type="text" id="adsense_header_slot" name="adsense_header_slot" value="{{ $settings['adsense_header_slot'] }}"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-800 focus:outline-none input-focus"
                            placeholder="1234567890">
                        <p class="mt-1 text-xs text-gray-400">Displayed at the top of pages (728x90 recommended)</p>
                    </div>

                    <!-- Sidebar Slot -->
                    <div>
                        <label for="adsense_sidebar_slot" class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                                Sidebar Ad Slot
                            </span>
                        </label>
                        <input type="text" id="adsense_sidebar_slot" name="adsense_sidebar_slot" value="{{ $settings['adsense_sidebar_slot'] }}"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-800 focus:outline-none input-focus"
                            placeholder="1234567890">
                        <p class="mt-1 text-xs text-gray-400">Displayed in sidebar areas (300x250 recommended)</p>
                    </div>

                    <!-- Content Slot -->
                    <div>
                        <label for="adsense_content_slot" class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <span class="w-3 h-3 bg-orange-500 rounded-full"></span>
                                In-Content Ad Slot
                            </span>
                        </label>
                        <input type="text" id="adsense_content_slot" name="adsense_content_slot" value="{{ $settings['adsense_content_slot'] }}"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-800 focus:outline-none input-focus"
                            placeholder="1234567890">
                        <p class="mt-1 text-xs text-gray-400">Displayed within content areas (responsive recommended)</p>
                    </div>

                    <!-- Footer Slot -->
                    <div>
                        <label for="adsense_footer_slot" class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                                Footer Ad Slot
                            </span>
                        </label>
                        <input type="text" id="adsense_footer_slot" name="adsense_footer_slot" value="{{ $settings['adsense_footer_slot'] }}"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-800 focus:outline-none input-focus"
                            placeholder="1234567890">
                        <p class="mt-1 text-xs text-gray-400">Displayed at the bottom of pages (728x90 recommended)</p>
                    </div>
                </div>
            </div>

            <!-- Info Box -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
                <div class="flex gap-3">
                    <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="text-sm text-blue-700">
                        <p class="font-medium mb-1">How to find your Ad Unit Slot IDs:</p>
                        <ol class="list-decimal list-inside space-y-1 text-blue-600">
                            <li>Go to your Google AdSense dashboard</li>
                            <li>Navigate to Ads → By ad unit</li>
                            <li>Create or select an ad unit</li>
                            <li>Copy the data-ad-slot value from the code</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="brand-gradient text-white px-8 py-3 rounded-xl font-semibold hover:opacity-90 transition-opacity flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</body>
</html>
