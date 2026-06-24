<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Log In - SnapURL</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        .brand-gradient { background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 50%, #FFC107 100%); }
        .brand-text { background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .soft-shadow { box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .input-focus:focus { border-color: #FF8E53; box-shadow: 0 0 0 3px rgba(255, 142, 83, 0.1); }
        .pattern-dots { background-image: radial-gradient(#e5e7eb 1px, transparent 1px); background-size: 20px 20px; }
    </style>
</head>
<body class="bg-gray-50 antialiased">
    <div class="min-h-screen flex">
        <!-- Left Side - Branding -->
        <div class="hidden lg:flex lg:w-1/2 brand-gradient relative overflow-hidden">
            <div class="absolute inset-0 pattern-dots opacity-10"></div>
            <div class="relative z-10 flex flex-col justify-center px-12 xl:px-20">
                <a href="/" class="flex items-center gap-3 mb-12">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                    </div>
                    <span class="text-3xl font-bold text-white">SnapURL</span>
                </a>
                <h1 class="text-4xl xl:text-5xl font-bold text-white mb-6 leading-tight">
                    Shorten Links,<br>Amplify Results
                </h1>
                <p class="text-white/80 text-lg mb-10 max-w-md">
                    Join millions of marketers who trust SnapURL for link management, analytics, and QR codes.
                </p>
                <div class="flex items-center gap-8">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white">10M+</div>
                        <div class="text-white/70 text-sm">Links Created</div>
                    </div>
                    <div class="w-px h-12 bg-white/20"></div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white">99.9%</div>
                        <div class="text-white/70 text-sm">Uptime</div>
                    </div>
                    <div class="w-px h-12 bg-white/20"></div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white">Free</div>
                        <div class="text-white/70 text-sm">Forever</div>
                    </div>
                </div>
            </div>
            <!-- Decorative Elements -->
            <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-white/10 rounded-full"></div>
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full"></div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
            <div class="w-full max-w-md">
                <!-- Mobile Logo -->
                <div class="lg:hidden flex justify-center mb-8">
                    <a href="/" class="flex items-center gap-2">
                        <div class="w-10 h-10 brand-gradient rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-gray-900">Snap<span class="brand-text">URL</span></span>
                    </a>
                </div>

                <div class="bg-white rounded-2xl soft-shadow p-8 sm:p-10">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Welcome back</h2>
                        <p class="text-gray-500">Sign in to your account to continue</p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-xl text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 text-gray-800 placeholder-gray-400 focus:outline-none input-focus transition-all"
                                placeholder="you@example.com">
                            @error('email')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-sm text-orange-600 hover:text-orange-700 font-medium">Forgot password?</a>
                                @endif
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 text-gray-800 placeholder-gray-400 focus:outline-none input-focus transition-all"
                                placeholder="••••••••">
                            @error('password')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input id="remember_me" type="checkbox" name="remember" 
                                class="w-4 h-4 rounded border-gray-300 text-orange-500 focus:ring-orange-500">
                            <label for="remember_me" class="ml-2 text-sm text-gray-600">Remember me</label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full brand-gradient text-white py-3.5 rounded-xl font-semibold hover:opacity-90 transition-opacity">
                            Sign In
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="relative my-8">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500">New to SnapURL?</span>
                        </div>
                    </div>

                    <!-- Register Link -->
                    <a href="{{ route('register') }}" class="block w-full text-center py-3.5 rounded-xl border-2 border-gray-200 text-gray-700 font-semibold hover:border-orange-300 hover:text-orange-600 transition-all">
                        Create Free Account
                    </a>
                </div>

                <!-- Footer -->
                <p class="text-center text-gray-500 text-sm mt-8">
                    By signing in, you agree to our 
                    <a href="{{ route('pages.terms') }}" class="text-orange-600 hover:underline">Terms</a> and 
                    <a href="{{ route('pages.privacy') }}" class="text-orange-600 hover:underline">Privacy Policy</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>