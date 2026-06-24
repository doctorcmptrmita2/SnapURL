<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-seo-meta title="Disclaimer - SnapURL.to" description="Read SnapURL.to's Disclaimer." keywords="snapurl disclaimer" canonical="https://snapurl.to/disclaimer" />
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
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100"><div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"><div class="flex justify-between h-16"><div class="flex items-center gap-3"><button x-on:click="mobileMenuOpen = true" class="md:hidden p-2 -ml-2 text-gray-600 hover:text-gray-900"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg></button><a href="/" class="flex items-center gap-2"><div class="w-9 h-9 brand-gradient rounded-xl flex items-center justify-center"><svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg></div><span class="text-xl font-bold text-gray-900">Snap<span class="brand-text">URL</span></span></a></div><div class="hidden md:flex items-center gap-8"><a href="/#features" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Features</a><a href="{{ route('blog.index') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Blog</a><a href="{{ route('pages.faq') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">FAQ</a></div><div class="flex items-center gap-3">@auth<a href="{{ route('dashboard') }}" class="text-gray-600 text-sm font-medium hidden sm:block">Dashboard</a>@else<a href="{{ route('login') }}" class="text-gray-600 text-sm font-medium hidden sm:block">Log in</a><a href="{{ route('register') }}" class="brand-gradient text-white px-4 sm:px-5 py-2 rounded-full text-sm font-semibold">Sign Up</a>@endauth</div></div></div></nav>
    <main class="py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <div class="lg:col-span-3">
                    <div class="text-center mb-10">
                        <span class="inline-block px-4 py-1.5 bg-orange-50 text-orange-600 rounded-full text-sm font-semibold mb-4">Legal</span>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2"><span class="brand-text">Disclaimer</span></h1>
                        <p class="text-gray-500">Last updated: {{ date('F d, Y') }}</p>
                    </div>
                    <div class="bg-white rounded-2xl soft-shadow p-8 space-y-6">
                        <div><h2 class="text-xl font-bold text-gray-900 mb-3">General Disclaimer</h2><p class="text-gray-600">The information provided by SnapURL.to on our website is for general informational purposes only. We make no representation or warranty regarding the accuracy or completeness of any information on the site.</p></div>
                        <div><h2 class="text-xl font-bold text-gray-900 mb-3">External Links Disclaimer</h2><p class="text-gray-600">Our website may contain links to external websites. We do not guarantee the accuracy or completeness of any information on these external websites.</p></div>
                        <div><h2 class="text-xl font-bold text-gray-900 mb-3">Shortened Links Disclaimer</h2><p class="text-gray-600 mb-3">We are not responsible for:</p><ul class="list-disc list-inside space-y-1 text-gray-600 ml-4"><li>Content of websites that shortened links redirect to</li><li>Damages from accessing external websites through our links</li><li>Accuracy or legality of content on linked websites</li><li>Malicious content on linked websites</li></ul></div>
                        <div><h2 class="text-xl font-bold text-gray-900 mb-3">Advertisements Disclaimer</h2><p class="text-gray-600">Our website displays advertisements from third-party networks including Google AdSense. These are not endorsements by SnapURL.to.</p></div>
                        <div><h2 class="text-xl font-bold text-gray-900 mb-3">Limitation of Liability</h2><p class="text-gray-600">Under no circumstance shall we have any liability for any loss or damage incurred as a result of the use of the site. Your use of the site is solely at your own risk.</p></div>
                        <div><h2 class="text-xl font-bold text-gray-900 mb-3">Contact Us</h2><p class="text-gray-600">Questions? Contact us at <a href="mailto:support@snapurl.to" class="text-orange-600 hover:underline">support@snapurl.to</a>.</p></div>
                    </div>
                </div>
                <div class="lg:col-span-1"><div class="sticky top-24"><div class="ad-placeholder rounded-xl h-[600px] flex items-center justify-center"><span class="text-gray-400 text-sm font-medium">Advertisement</span></div></div></div>
            </div>
        </div>
    </main>
    <footer class="bg-gray-900 text-white py-14 px-4"><div class="max-w-6xl mx-auto"><div class="grid grid-cols-2 md:grid-cols-5 gap-8 mb-10"><div class="col-span-2"><div class="flex items-center gap-2 mb-4"><div class="w-9 h-9 brand-gradient rounded-xl flex items-center justify-center"><svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg></div><span class="text-xl font-bold">SnapURL</span></div><p class="text-gray-400 text-sm max-w-xs">100% free URL shortener with analytics and QR codes.</p></div><div><h3 class="text-sm font-semibold uppercase tracking-wider text-gray-300 mb-4">Product</h3><ul class="space-y-3 text-sm"><li><a href="/#features" class="text-gray-400 hover:text-white">Features</a></li><li><a href="{{ route('blog.index') }}" class="text-gray-400 hover:text-white">Blog</a></li><li><a href="{{ route('pages.faq') }}" class="text-gray-400 hover:text-white">FAQ</a></li></ul></div><div><h3 class="text-sm font-semibold uppercase tracking-wider text-gray-300 mb-4">Company</h3><ul class="space-y-3 text-sm"><li><a href="{{ route('pages.about') }}" class="text-gray-400 hover:text-white">About</a></li><li><a href="{{ route('pages.contact') }}" class="text-gray-400 hover:text-white">Contact</a></li><li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white">Sign Up</a></li></ul></div><div><h3 class="text-sm font-semibold uppercase tracking-wider text-gray-300 mb-4">Legal</h3><ul class="space-y-3 text-sm"><li><a href="{{ route('pages.privacy') }}" class="text-gray-400 hover:text-white">Privacy Policy</a></li><li><a href="{{ route('pages.terms') }}" class="text-gray-400 hover:text-white">Terms of Service</a></li><li><a href="{{ route('pages.disclaimer') }}" class="text-gray-400 hover:text-white">Disclaimer</a></li></ul></div></div><div class="border-t border-gray-800 pt-8 text-center"><p class="text-gray-500 text-sm">&copy; {{ date('Y') }} SnapURL.to. All rights reserved.</p></div></div></footer>
</body>
</html>
