<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-seo-meta title="Blog - URL Shortening Tips & Marketing Guides | SnapURL" description="Learn about URL shortening, link management, and digital marketing strategies." keywords="url shortener blog, link management tips, digital marketing guides" canonical="https://snapurl.to/blog" />
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        .brand-gradient { background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 50%, #FFC107 100%); }
        .brand-text { background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .soft-shadow { box-shadow: 0 4px 24px rgba(0,0,0,0.06); }
        .hover-lift { transition: all 0.2s ease; }
        .hover-lift:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(0,0,0,0.1); }
        .ad-placeholder { background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border: 2px dashed #e2e8f0; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased" x-data="{ mobileMenuOpen: false }">
    <x-mobile-menu />
    <div class="bg-white border-b border-gray-100"><div class="max-w-7xl mx-auto px-4 py-3"><div class="ad-placeholder rounded-lg h-[90px] flex items-center justify-center"><span class="text-gray-400 text-sm font-medium">Advertisement</span></div></div></div>
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100"><div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"><div class="flex justify-between h-16"><div class="flex items-center gap-3"><button x-on:click="mobileMenuOpen = true" class="md:hidden p-2 -ml-2 text-gray-600 hover:text-gray-900"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg></button><a href="/" class="flex items-center gap-2"><div class="w-9 h-9 brand-gradient rounded-xl flex items-center justify-center"><svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg></div><span class="text-xl font-bold text-gray-900">Snap<span class="brand-text">URL</span></span></a></div><div class="hidden md:flex items-center gap-8"><a href="/#features" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Features</a><a href="{{ route('blog.index') }}" class="text-gray-900 text-sm font-medium">Blog</a><a href="{{ route('pages.faq') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">FAQ</a></div><div class="flex items-center gap-3">@auth<a href="{{ route('dashboard') }}" class="text-gray-600 text-sm font-medium hidden sm:block">Dashboard</a>@else<a href="{{ route('login') }}" class="text-gray-600 text-sm font-medium hidden sm:block">Log in</a><a href="{{ route('register') }}" class="brand-gradient text-white px-4 sm:px-5 py-2 rounded-full text-sm font-semibold">Sign Up</a>@endauth</div></div></div></nav>

    <!-- Hero -->
    <section class="bg-white py-14 px-4 border-b border-gray-100">
        <div class="max-w-4xl mx-auto text-center">
            <span class="inline-block px-4 py-1.5 bg-orange-50 text-orange-600 rounded-full text-sm font-semibold mb-4">Blog</span>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Learn, Grow, <span class="brand-text">Succeed</span></h1>
            <p class="text-gray-600 max-w-xl mx-auto">Expert guides on URL shortening, link management, and digital marketing.</p>
        </div>
    </section>

    <!-- Blog Grid -->
    <section class="py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <div class="lg:col-span-3">
                    <!-- Featured Article -->
                    <a href="{{ route('blog.show', $articles[0]['slug']) }}" class="block group mb-8">
                        <div class="bg-white rounded-2xl overflow-hidden soft-shadow hover-lift">
                            <div class="md:flex">
                                <div class="md:w-1/2"><img src="{{ $articles[0]['image'] }}" alt="{{ $articles[0]['title'] }}" class="w-full h-56 md:h-full object-cover"></div>
                                <div class="md:w-1/2 p-6 flex flex-col justify-center">
                                    <span class="inline-block px-3 py-1 bg-orange-50 text-orange-600 rounded-full text-xs font-semibold mb-3 w-fit">{{ $articles[0]['category'] }}</span>
                                    <h2 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors">{{ $articles[0]['title'] }}</h2>
                                    <p class="text-gray-600 text-sm mb-3">{{ $articles[0]['excerpt'] }}</p>
                                    <div class="flex items-center text-xs text-gray-500"><span>{{ date('M d, Y', strtotime($articles[0]['date'])) }}</span><span class="mx-2">•</span><span>{{ $articles[0]['read_time'] }} min read</span></div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Articles Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach(array_slice($articles, 1) as $article)
                        <article class="bg-white rounded-xl overflow-hidden soft-shadow hover-lift group">
                            <a href="{{ route('blog.show', $article['slug']) }}">
                                <div class="relative overflow-hidden"><img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-40 object-cover"><span class="absolute top-3 left-3 px-2 py-1 bg-white/90 text-gray-700 rounded-full text-xs font-medium">{{ $article['category'] }}</span></div>
                                <div class="p-5">
                                    <h3 class="text-base font-semibold text-gray-900 mb-2 group-hover:text-orange-600 transition-colors line-clamp-2">{{ $article['title'] }}</h3>
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $article['excerpt'] }}</p>
                                    <div class="flex items-center justify-between text-xs text-gray-500"><span>{{ date('M d, Y', strtotime($article['date'])) }}</span><span>{{ $article['read_time'] }} min</span></div>
                                </div>
                            </a>
                        </article>
                        @if($loop->iteration == 4 || $loop->iteration == 12 || $loop->iteration == 20)
                        <div class="ad-placeholder rounded-xl p-6 flex items-center justify-center min-h-[250px]"><span class="text-gray-400 text-sm font-medium">Advertisement</span></div>
                        @endif
                        @endforeach
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24 space-y-6">
                        <div class="ad-placeholder rounded-xl h-[300px] flex items-center justify-center"><span class="text-gray-400 text-sm font-medium">Advertisement</span></div>
                        <div class="ad-placeholder rounded-xl h-[600px] flex items-center justify-center"><span class="text-gray-400 text-sm font-medium">Advertisement</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-14 px-4 brand-gradient">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-2xl font-bold text-white mb-4">Ready to Shorten Your Links?</h2>
            <p class="text-white/80 mb-6">Join millions of users. It's free forever.</p>
            <a href="{{ route('register') }}" class="inline-block bg-white text-orange-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition-colors">Create Free Account</a>
        </div>
    </section>

    <footer class="bg-gray-900 text-white py-14 px-4"><div class="max-w-6xl mx-auto"><div class="grid grid-cols-2 md:grid-cols-5 gap-8 mb-10"><div class="col-span-2"><div class="flex items-center gap-2 mb-4"><div class="w-9 h-9 brand-gradient rounded-xl flex items-center justify-center"><svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg></div><span class="text-xl font-bold">SnapURL</span></div><p class="text-gray-400 text-sm max-w-xs">100% free URL shortener with analytics and QR codes.</p></div><div><h3 class="text-sm font-semibold uppercase tracking-wider text-gray-300 mb-4">Product</h3><ul class="space-y-3 text-sm"><li><a href="/#features" class="text-gray-400 hover:text-white">Features</a></li><li><a href="{{ route('blog.index') }}" class="text-gray-400 hover:text-white">Blog</a></li><li><a href="{{ route('pages.faq') }}" class="text-gray-400 hover:text-white">FAQ</a></li></ul></div><div><h3 class="text-sm font-semibold uppercase tracking-wider text-gray-300 mb-4">Company</h3><ul class="space-y-3 text-sm"><li><a href="{{ route('pages.about') }}" class="text-gray-400 hover:text-white">About</a></li><li><a href="{{ route('pages.contact') }}" class="text-gray-400 hover:text-white">Contact</a></li><li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white">Sign Up</a></li></ul></div><div><h3 class="text-sm font-semibold uppercase tracking-wider text-gray-300 mb-4">Legal</h3><ul class="space-y-3 text-sm"><li><a href="{{ route('pages.privacy') }}" class="text-gray-400 hover:text-white">Privacy Policy</a></li><li><a href="{{ route('pages.terms') }}" class="text-gray-400 hover:text-white">Terms of Service</a></li><li><a href="{{ route('pages.disclaimer') }}" class="text-gray-400 hover:text-white">Disclaimer</a></li></ul></div></div><div class="border-t border-gray-800 pt-8 text-center"><p class="text-gray-500 text-sm">&copy; {{ date('Y') }} SnapURL.to. All rights reserved.</p></div></div></footer>
    <x-cookie-consent />
</body>
</html>
