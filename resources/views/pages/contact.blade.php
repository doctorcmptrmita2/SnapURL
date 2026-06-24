<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-seo-meta title="Contact Us - SnapURL.to" description="Get in touch with SnapURL.to. Have questions or need support?" keywords="contact snapurl, snapurl support" canonical="https://snapurl.to/contact" />
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        .brand-gradient { background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 50%, #FFC107 100%); }
        .brand-text { background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .soft-shadow { box-shadow: 0 4px 24px rgba(0,0,0,0.06); }
        .ad-placeholder { background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border: 2px dashed #e2e8f0; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased" x-data="{ mobileMenuOpen: false }">
    <x-mobile-menu />
    <div class="bg-white border-b border-gray-100"><div class="max-w-7xl mx-auto px-4 py-3"><div class="ad-placeholder rounded-lg h-[90px] flex items-center justify-center"><span class="text-gray-400 text-sm font-medium">Advertisement</span></div></div></div>
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-3"><button x-on:click="mobileMenuOpen = true" class="md:hidden p-2 -ml-2 text-gray-600 hover:text-gray-900"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg></button><a href="/" class="flex items-center gap-2"><div class="w-9 h-9 brand-gradient rounded-xl flex items-center justify-center"><svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg></div><span class="text-xl font-bold text-gray-900">Snap<span class="brand-text">URL</span></span></a></div>
                <div class="hidden md:flex items-center gap-8"><a href="/#features" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Features</a><a href="{{ route('blog.index') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Blog</a><a href="{{ route('pages.faq') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">FAQ</a></div>
                <div class="flex items-center gap-3">@auth<a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium hidden sm:block">Dashboard</a>@else<a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium hidden sm:block">Log in</a><a href="{{ route('register') }}" class="brand-gradient text-white px-4 sm:px-5 py-2 rounded-full text-sm font-semibold">Sign Up</a>@endauth</div>
            </div>
        </div>
    </nav>

    <main class="py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <div class="lg:col-span-3">
                    <div class="text-center mb-10">
                        <span class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 rounded-full text-sm font-semibold mb-4">Contact</span>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Get in <span class="brand-text">Touch</span></h1>
                        <p class="text-gray-600">Have a question or need support? We're here to help!</p>
                    </div>
                    <div class="bg-white rounded-2xl soft-shadow p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-6">
                                <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center"><svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg></div>
                                        <h3 class="font-semibold text-gray-900">Email Support</h3>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-2">For general inquiries and support</p>
                                    <a href="mailto:support@snapurl.to" class="text-orange-600 hover:text-orange-700 font-medium">support@snapurl.to</a>
                                </div>
                                <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center"><svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg></div>
                                        <h3 class="font-semibold text-gray-900">Business Inquiries</h3>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-2">For partnerships and business</p>
                                    <a href="mailto:business@snapurl.to" class="text-orange-600 hover:text-orange-700 font-medium">business@snapurl.to</a>
                                </div>
                            </div>
                            <div class="bg-orange-50 rounded-xl p-6 border border-orange-100">
                                <h3 class="font-semibold text-gray-900 mb-4">Response Time</h3>
                                <p class="text-gray-600 mb-6">We typically respond within 24 hours during business days.</p>
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg><span class="text-gray-700">24/7 Support Available</span></div>
                                    <div class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg><span class="text-gray-700">Fast Response Times</span></div>
                                    <div class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg><span class="text-gray-700">Expert Team Ready</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-1"><div class="sticky top-24"><div class="ad-placeholder rounded-xl h-[600px] flex items-center justify-center"><span class="text-gray-400 text-sm font-medium">Advertisement</span></div></div></div>
            </div>
        </div>
    </main>
    <footer class="bg-gray-900 text-white py-14 px-4"><div class="max-w-6xl mx-auto"><div class="grid grid-cols-2 md:grid-cols-5 gap-8 mb-10"><div class="col-span-2"><div class="flex items-center gap-2 mb-4"><div class="w-9 h-9 brand-gradient rounded-xl flex items-center justify-center"><svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg></div><span class="text-xl font-bold">SnapURL</span></div><p class="text-gray-400 text-sm max-w-xs">100% free URL shortener with analytics and QR codes.</p></div><div><h3 class="text-sm font-semibold uppercase tracking-wider text-gray-300 mb-4">Product</h3><ul class="space-y-3 text-sm"><li><a href="/#features" class="text-gray-400 hover:text-white">Features</a></li><li><a href="{{ route('blog.index') }}" class="text-gray-400 hover:text-white">Blog</a></li><li><a href="{{ route('pages.faq') }}" class="text-gray-400 hover:text-white">FAQ</a></li></ul></div><div><h3 class="text-sm font-semibold uppercase tracking-wider text-gray-300 mb-4">Company</h3><ul class="space-y-3 text-sm"><li><a href="{{ route('pages.about') }}" class="text-gray-400 hover:text-white">About</a></li><li><a href="{{ route('pages.contact') }}" class="text-gray-400 hover:text-white">Contact</a></li><li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white">Sign Up</a></li></ul></div><div><h3 class="text-sm font-semibold uppercase tracking-wider text-gray-300 mb-4">Legal</h3><ul class="space-y-3 text-sm"><li><a href="{{ route('pages.privacy') }}" class="text-gray-400 hover:text-white">Privacy Policy</a></li><li><a href="{{ route('pages.terms') }}" class="text-gray-400 hover:text-white">Terms of Service</a></li><li><a href="{{ route('pages.disclaimer') }}" class="text-gray-400 hover:text-white">Disclaimer</a></li></ul></div></div><div class="border-t border-gray-800 pt-8 text-center"><p class="text-gray-500 text-sm">&copy; {{ date('Y') }} SnapURL.to. All rights reserved.</p></div></div></footer>
</body>
</html>
