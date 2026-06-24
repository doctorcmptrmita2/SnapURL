<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-seo-meta title="{{ $article['title'] }} | SnapURL Blog" description="{{ $article['excerpt'] }}" keywords="{{ strtolower($article['category']) }}, url shortener, {{ $article['slug'] }}" canonical="https://snapurl.to/blog/{{ $article['slug'] }}" />
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script type="application/ld+json">{"@@context":"https://schema.org","@@type":"Article","headline":"{{ $article['title'] }}","description":"{{ $article['excerpt'] }}","image":"{{ $article['image'] }}","datePublished":"{{ $article['date'] }}","author":{"@@type":"Organization","name":"SnapURL"},"publisher":{"@@type":"Organization","name":"SnapURL.to"}}</script>
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        .brand-gradient { background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 50%, #FFC107 100%); }
        .brand-text { background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .soft-shadow { box-shadow: 0 4px 24px rgba(0,0,0,0.06); }
        .hover-lift { transition: all 0.2s ease; }
        .hover-lift:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(0,0,0,0.1); }
        .ad-placeholder { background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border: 2px dashed #e2e8f0; }
        .prose h2 { font-size: 1.5rem; font-weight: 700; color: #111827; margin-top: 2rem; margin-bottom: 1rem; }
        .prose h3 { font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-top: 1.5rem; margin-bottom: 0.75rem; }
        .prose p { color: #4b5563; line-height: 1.75; margin-bottom: 1rem; }
        .prose ul, .prose ol { color: #4b5563; margin-bottom: 1rem; padding-left: 1.5rem; }
        .prose li { margin-bottom: 0.5rem; }
        .prose a { color: #ea580c; text-decoration: underline; }
        .prose strong { color: #111827; font-weight: 600; }
        .prose img { border-radius: 0.75rem; margin: 1.5rem 0; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased" x-data="{ mobileMenuOpen: false }">
    <x-mobile-menu />
    <!-- Top Ad Banner -->
    <div class="bg-white border-b border-gray-100"><div class="max-w-7xl mx-auto px-4 py-3"><div class="ad-placeholder rounded-lg h-[90px] flex items-center justify-center"><span class="text-gray-400 text-sm font-medium">Advertisement</span></div></div></div>
    
    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100"><div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"><div class="flex justify-between h-16"><div class="flex items-center gap-3"><button x-on:click="mobileMenuOpen = true" class="md:hidden p-2 -ml-2 text-gray-600 hover:text-gray-900"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg></button><a href="/" class="flex items-center gap-2"><div class="w-9 h-9 brand-gradient rounded-xl flex items-center justify-center"><svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg></div><span class="text-xl font-bold text-gray-900">Snap<span class="brand-text">URL</span></span></a></div><div class="hidden md:flex items-center gap-8"><a href="/#features" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Features</a><a href="{{ route('blog.index') }}" class="text-gray-900 text-sm font-medium">Blog</a><a href="{{ route('pages.faq') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">FAQ</a></div><div class="flex items-center gap-3">@auth<a href="{{ route('dashboard') }}" class="text-gray-600 text-sm font-medium hidden sm:block">Dashboard</a>@else<a href="{{ route('login') }}" class="text-gray-600 text-sm font-medium hidden sm:block">Log in</a><a href="{{ route('register') }}" class="brand-gradient text-white px-4 sm:px-5 py-2 rounded-full text-sm font-semibold">Sign Up</a>@endauth</div></div></div></nav>

    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <nav class="flex items-center text-sm text-gray-500">
                <a href="/" class="hover:text-gray-700">Home</a>
                <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('blog.index') }}" class="hover:text-gray-700">Blog</a>
                <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-gray-900 font-medium truncate max-w-xs">{{ $article['title'] }}</span>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <main class="py-10 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Article Content -->
                <article class="lg:col-span-3">
                    <div class="bg-white rounded-2xl soft-shadow overflow-hidden">
                        <!-- Article Header -->
                        <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-64 md:h-80 object-cover">
                        <div class="p-6 md:p-10">
                            <div class="flex items-center gap-3 mb-4">
                                <span class="px-3 py-1 bg-orange-50 text-orange-600 rounded-full text-sm font-semibold">{{ $article['category'] }}</span>
                                <span class="text-gray-500 text-sm">{{ date('F d, Y', strtotime($article['date'])) }}</span>
                                <span class="text-gray-400">•</span>
                                <span class="text-gray-500 text-sm">{{ $article['read_time'] }} min read</span>
                            </div>
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">{{ $article['title'] }}</h1>
                            <p class="text-lg text-gray-600 mb-6">{{ $article['excerpt'] }}</p>
                            
                            <!-- In-Content Ad -->
                            <div class="ad-placeholder rounded-xl h-[90px] flex items-center justify-center mb-8"><span class="text-gray-400 text-sm font-medium">Advertisement</span></div>
                            
                            <!-- Article Body -->
                            <div class="prose max-w-none">
                                @include('blog.content.' . $article['slug'])
                            </div>
                            
                            <!-- Bottom In-Content Ad -->
                            <div class="ad-placeholder rounded-xl h-[250px] flex items-center justify-center my-8"><span class="text-gray-400 text-sm font-medium">Advertisement</span></div>
                            
                            <!-- Share Section -->
                            <div class="border-t border-gray-100 pt-6 mt-8">
                                <p class="text-sm font-semibold text-gray-700 mb-3">Share this article</p>
                                <div class="flex gap-3">
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article['title']) }}" target="_blank" rel="noopener" class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center transition-colors">
                                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                    </a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center transition-colors">
                                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    </a>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($article['title']) }}" target="_blank" rel="noopener" class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center transition-colors">
                                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                    </a>
                                    <button x-data x-on:click="navigator.clipboard.writeText('{{ url()->current() }}'); $el.innerHTML = '<svg class=\'w-5 h-5 text-green-600\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M5 13l4 4L19 7\'/></svg>'; setTimeout(() => $el.innerHTML = '<svg class=\'w-5 h-5 text-gray-600\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z\'/></svg>', 2000)" class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center transition-colors">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Sidebar -->
                <aside class="lg:col-span-1">
                    <div class="sticky top-24 space-y-6">
                        <!-- Sidebar Ad -->
                        <div class="ad-placeholder rounded-xl h-[300px] flex items-center justify-center"><span class="text-gray-400 text-sm font-medium">Advertisement</span></div>
                        
                        <!-- CTA Box -->
                        <div class="bg-white rounded-xl soft-shadow p-6">
                            <h3 class="font-bold text-gray-900 mb-2">Shorten Your Links Free</h3>
                            <p class="text-gray-600 text-sm mb-4">Create short URLs with analytics and QR codes. 100% free, forever.</p>
                            <a href="{{ route('register') }}" class="block w-full brand-gradient text-white text-center py-2.5 rounded-lg font-semibold text-sm">Get Started Free</a>
                        </div>
                        
                        <!-- Sidebar Ad 2 -->
                        <div class="ad-placeholder rounded-xl h-[600px] flex items-center justify-center"><span class="text-gray-400 text-sm font-medium">Advertisement</span></div>
                    </div>
                </aside>
            </div>
        </div>
    </main>

    <!-- Related Articles -->
    <section class="py-12 px-4 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Articles</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedArticles as $related)
                <article class="bg-gray-50 rounded-xl overflow-hidden hover-lift group">
                    <a href="{{ route('blog.show', $related['slug']) }}">
                        <div class="relative overflow-hidden"><img src="{{ $related['image'] }}" alt="{{ $related['title'] }}" class="w-full h-40 object-cover"><span class="absolute top-3 left-3 px-2 py-1 bg-white/90 text-gray-700 rounded-full text-xs font-medium">{{ $related['category'] }}</span></div>
                        <div class="p-5">
                            <h3 class="text-base font-semibold text-gray-900 mb-2 group-hover:text-orange-600 transition-colors line-clamp-2">{{ $related['title'] }}</h3>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $related['excerpt'] }}</p>
                            <div class="flex items-center justify-between text-xs text-gray-500"><span>{{ date('M d, Y', strtotime($related['date'])) }}</span><span>{{ $related['read_time'] }} min</span></div>
                        </div>
                    </a>
                </article>
                @endforeach
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

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-14 px-4"><div class="max-w-6xl mx-auto"><div class="grid grid-cols-2 md:grid-cols-5 gap-8 mb-10"><div class="col-span-2"><div class="flex items-center gap-2 mb-4"><div class="w-9 h-9 brand-gradient rounded-xl flex items-center justify-center"><svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg></div><span class="text-xl font-bold">SnapURL</span></div><p class="text-gray-400 text-sm max-w-xs">100% free URL shortener with analytics and QR codes.</p></div><div><h3 class="text-sm font-semibold uppercase tracking-wider text-gray-300 mb-4">Product</h3><ul class="space-y-3 text-sm"><li><a href="/#features" class="text-gray-400 hover:text-white">Features</a></li><li><a href="{{ route('blog.index') }}" class="text-gray-400 hover:text-white">Blog</a></li><li><a href="{{ route('pages.faq') }}" class="text-gray-400 hover:text-white">FAQ</a></li></ul></div><div><h3 class="text-sm font-semibold uppercase tracking-wider text-gray-300 mb-4">Company</h3><ul class="space-y-3 text-sm"><li><a href="{{ route('pages.about') }}" class="text-gray-400 hover:text-white">About</a></li><li><a href="{{ route('pages.contact') }}" class="text-gray-400 hover:text-white">Contact</a></li><li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white">Sign Up</a></li></ul></div><div><h3 class="text-sm font-semibold uppercase tracking-wider text-gray-300 mb-4">Legal</h3><ul class="space-y-3 text-sm"><li><a href="{{ route('pages.privacy') }}" class="text-gray-400 hover:text-white">Privacy Policy</a></li><li><a href="{{ route('pages.terms') }}" class="text-gray-400 hover:text-white">Terms of Service</a></li><li><a href="{{ route('pages.disclaimer') }}" class="text-gray-400 hover:text-white">Disclaimer</a></li></ul></div></div><div class="border-t border-gray-800 pt-8 text-center"><p class="text-gray-500 text-sm">&copy; {{ date('Y') }} SnapURL.to. All rights reserved.</p></div></div></footer>
    <x-cookie-consent />
</body>
</html>