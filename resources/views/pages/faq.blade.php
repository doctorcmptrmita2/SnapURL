<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-seo-meta title="FAQ - SnapURL.to" description="Find answers to common questions about SnapURL.to." keywords="snapurl faq, url shortener questions" canonical="https://snapurl.to/faq" />
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    <script type="application/ld+json">{"@@context":"https://schema.org","@@type":"FAQPage","mainEntity":[{"@@type":"Question","name":"Do I need to sign up?","acceptedAnswer":{"@@type":"Answer","text":"No! You can create short links without signing up."}},{"@@type":"Question","name":"Is SnapURL free?","acceptedAnswer":{"@@type":"Answer","text":"Yes! SnapURL is 100% free forever."}},{"@@type":"Question","name":"How long do links last?","acceptedAnswer":{"@@type":"Answer","text":"Links don't expire unless you set an expiration date."}}]}</script>
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
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100"><div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"><div class="flex justify-between h-16"><div class="flex items-center gap-3"><button x-on:click="mobileMenuOpen = true" class="md:hidden p-2 -ml-2 text-gray-600 hover:text-gray-900"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg></button><a href="/" class="flex items-center gap-2"><div class="w-9 h-9 brand-gradient rounded-xl flex items-center justify-center"><svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg></div><span class="text-xl font-bold text-gray-900">Snap<span class="brand-text">URL</span></span></a></div><div class="hidden md:flex items-center gap-8"><a href="/#features" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Features</a><a href="{{ route('blog.index') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Blog</a><a href="{{ route('pages.faq') }}" class="text-gray-900 text-sm font-medium">FAQ</a></div><div class="flex items-center gap-3">@auth<a href="{{ route('dashboard') }}" class="text-gray-600 text-sm font-medium hidden sm:block">Dashboard</a>@else<a href="{{ route('login') }}" class="text-gray-600 text-sm font-medium hidden sm:block">Log in</a><a href="{{ route('register') }}" class="brand-gradient text-white px-4 sm:px-5 py-2 rounded-full text-sm font-semibold">Sign Up</a>@endauth</div></div></div></nav>

    <main class="py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <div class="lg:col-span-3">
                    <div class="text-center mb-10">
                        <span class="inline-block px-4 py-1.5 bg-yellow-50 text-yellow-600 rounded-full text-sm font-semibold mb-4">FAQ</span>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Frequently Asked <span class="brand-text">Questions</span></h1>
                        <p class="text-gray-600">Find answers to common questions about SnapURL.to</p>
                    </div>
                    <div class="space-y-4" x-data="{ openIndex: null }">
                        <div class="bg-white rounded-xl soft-shadow overflow-hidden border border-gray-100">
                            <button x-on:click="openIndex = openIndex === 0 ? null : 0" class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                                <h3 class="font-semibold text-gray-900">Do I need to sign up to create links?</h3>
                                <svg class="w-5 h-5 text-gray-400 transform transition-transform" :class="{ 'rotate-180': openIndex === 0 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </button>
                            <div x-show="openIndex === 0" x-collapse class="px-6 pb-5 text-gray-600"><p>No! You can create short links without signing up. However, signing up gives you access to analytics and link management.</p></div>
                        </div>
                        <div class="bg-white rounded-xl soft-shadow overflow-hidden border border-gray-100">
                            <button x-on:click="openIndex = openIndex === 1 ? null : 1" class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                                <h3 class="font-semibold text-gray-900">Is SnapURL really 100% free?</h3>
                                <svg class="w-5 h-5 text-gray-400 transform transition-transform" :class="{ 'rotate-180': openIndex === 1 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </button>
                            <div x-show="openIndex === 1" x-collapse class="px-6 pb-5 text-gray-600"><p>Yes! SnapURL is completely free forever. All features including analytics, QR codes, and password protection are available at no cost.</p></div>
                        </div>
                        <div class="bg-white rounded-xl soft-shadow overflow-hidden border border-gray-100">
                            <button x-on:click="openIndex = openIndex === 2 ? null : 2" class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                                <h3 class="font-semibold text-gray-900">How long do links last?</h3>
                                <svg class="w-5 h-5 text-gray-400 transform transition-transform" :class="{ 'rotate-180': openIndex === 2 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </button>
                            <div x-show="openIndex === 2" x-collapse class="px-6 pb-5 text-gray-600"><p>Links don't expire unless you set an expiration date. You can set custom expiration dates or click limits for any link.</p></div>
                        </div>
                        <div class="bg-white rounded-xl soft-shadow overflow-hidden border border-gray-100">
                            <button x-on:click="openIndex = openIndex === 3 ? null : 3" class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                                <h3 class="font-semibold text-gray-900">Is my data private?</h3>
                                <svg class="w-5 h-5 text-gray-400 transform transition-transform" :class="{ 'rotate-180': openIndex === 3 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </button>
                            <div x-show="openIndex === 3" x-collapse class="px-6 pb-5 text-gray-600"><p>Yes! We hash IP addresses and user agents before storing them. We comply with GDPR and other privacy regulations.</p></div>
                        </div>
                        <div class="bg-white rounded-xl soft-shadow overflow-hidden border border-gray-100">
                            <button x-on:click="openIndex = openIndex === 4 ? null : 4" class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                                <h3 class="font-semibold text-gray-900">How fast is the redirect?</h3>
                                <svg class="w-5 h-5 text-gray-400 transform transition-transform" :class="{ 'rotate-180': openIndex === 4 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </button>
                            <div x-show="openIndex === 4" x-collapse class="px-6 pb-5 text-gray-600"><p>Our redirects are lightning-fast thanks to Redis caching. Most redirects happen in under 50ms.</p></div>
                        </div>
                        <div class="bg-white rounded-xl soft-shadow overflow-hidden border border-gray-100">
                            <button x-on:click="openIndex = openIndex === 5 ? null : 5" class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                                <h3 class="font-semibold text-gray-900">Can I track link performance?</h3>
                                <svg class="w-5 h-5 text-gray-400 transform transition-transform" :class="{ 'rotate-180': openIndex === 5 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </button>
                            <div x-show="openIndex === 5" x-collapse class="px-6 pb-5 text-gray-600"><p>Yes! All users get comprehensive click tracking with analytics including referrers, devices, and locations — all completely free.</p></div>
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
