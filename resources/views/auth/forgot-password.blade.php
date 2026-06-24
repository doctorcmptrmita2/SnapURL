<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forgot Password - SnapURL</title>
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
                    Reset Your<br>Password
                </h1>
                <p class="text-white/80 text-lg mb-10 max-w-md">
                    No worries! It happens to the best of us. Enter your email and we'll send you a reset link.
                </p>
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="text-white/90">Check your inbox for reset link</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <span class="text-white/90">Create a new secure password</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-white/90">Get back to shortening links</span>
                    </div>
                </div>
            </div>
            <!-- Decorative Elements -->
            <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-white/10 rounded-full"></div>
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full"></div>
        </div>

        <!-- Right Side - Reset Form -->
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
                        <div class="w-16 h-16 brand-gradient rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Forgot Password?</h2>
                        <p class="text-gray-500">Enter your email and we'll send you a reset link</p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-sm text-green-600 flex items-center gap-3">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                        @csrf

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 text-gray-800 placeholder-gray-400 focus:outline-none input-focus transition-all"
                                placeholder="you@example.com">
                            @error('email')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full brand-gradient text-white py-3.5 rounded-xl font-semibold hover:opacity-90 transition-opacity flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Send Reset Link
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="relative my-8">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500">Remember your password?</span>
                        </div>
                    </div>

                    <!-- Back to Login -->
                    <a href="{{ route('login') }}" class="block w-full text-center py-3.5 rounded-xl border-2 border-gray-200 text-gray-700 font-semibold hover:border-orange-300 hover:text-orange-600 transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Sign In
                    </a>
                </div>

                <!-- Footer -->
                <p class="text-center text-gray-500 text-sm mt-8">
                    Need help? <a href="{{ route('pages.contact') }}" class="text-orange-600 hover:underline">Contact Support</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
