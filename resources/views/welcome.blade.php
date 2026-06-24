<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <x-seo-meta 
        title="Free URL Shortener - SnapURL.to | Shorten Links Instantly"
        description="SnapURL.to is a 100% free URL shortener. Create short links instantly with analytics, QR codes, and no signup required. Fast, secure, and privacy-first."
        keywords="free url shortener, shorten url free, free link shortener, snapurl, short link generator, url shortener no signup, free qr code generator"
        canonical="https://snapurl.to/"
    />
    
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "WebApplication",
      "name": "SnapURL.to",
      "url": "https://snapurl.to",
      "description": "100% Free URL shortener with analytics and QR codes. No signup required.",
      "applicationCategory": "UtilityApplication",
      "operatingSystem": "Web",
      "offers": {
        "@@type": "Offer",
        "price": "0",
        "priceCurrency": "USD"
      }
    }
    </script>

    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "Organization",
      "name": "SnapURL",
      "url": "https://snapurl.to",
      "logo": "https://snapurl.to/favicon.svg",
      "description": "SnapURL is a free URL shortener with click analytics and QR codes — no signup required."
    }
    </script>

    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "FAQPage",
      "mainEntity": [
        {"@@type":"Question","name":"Is SnapURL really free?","acceptedAnswer":{"@@type":"Answer","text":"Yes. You can shorten as many links as you like for free, and you don't even need to create an account to get started."}},
        {"@@type":"Question","name":"Do my short links ever expire?","acceptedAnswer":{"@@type":"Answer","text":"Your links stay active by default. If you want, you can set an optional expiration date or a maximum number of clicks when you create or edit a link."}},
        {"@@type":"Question","name":"Can I see how many people clicked my link?","acceptedAnswer":{"@@type":"Answer","text":"Absolutely. Every link includes free click analytics. Sign in to your dashboard to view total clicks and trends over time."}},
        {"@@type":"Question","name":"Does every link get a QR code?","acceptedAnswer":{"@@type":"Answer","text":"Yes, a scannable QR code is generated for every short link, so you can bridge your offline and online audiences instantly."}},
        {"@@type":"Question","name":"Are shortened links safe to click?","acceptedAnswer":{"@@type":"Answer","text":"SnapURL checks destinations against trusted safe-browsing databases and blocks known phishing and malware sites, helping keep every link you create trustworthy."}}
      ]
    }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Google AdSense -->
    <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-XXXXXXXX" crossorigin="anonymous"></script> -->

    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        .brand-gradient { background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 50%, #FFC107 100%); }
        .brand-text { background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .soft-shadow { box-shadow: 0 4px 24px rgba(0,0,0,0.06); }
        .card-shadow { box-shadow: 0 2px 12px rgba(0,0,0,0.04); }
        .input-shadow { box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
        .hover-lift { transition: all 0.2s ease; }
        .hover-lift:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.08); }
        .pattern-dots { background-image: radial-gradient(#e5e7eb 1px, transparent 1px); background-size: 20px 20px; }
        .ad-placeholder { background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border: 2px dashed #e2e8f0; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased" x-data="{ mobileMenuOpen: false }">
    <!-- Mobile Menu -->
    <x-mobile-menu />

    <!-- Top Ad Banner -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <div class="ad-placeholder rounded-lg h-[90px] flex items-center justify-center">
                <span class="text-gray-400 text-sm font-medium">Advertisement</span>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-3">
                    <!-- Mobile Menu Button -->
                    <button x-on:click="mobileMenuOpen = true" class="md:hidden p-2 -ml-2 text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <a href="/" class="flex items-center gap-2">
                        <div class="w-9 h-9 brand-gradient rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-900">Snap<span class="brand-text">URL</span></span>
                    </a>
                </div>
                <div class="hidden md:flex items-center gap-8">
                    <a href="#features" class="text-gray-600 hover:text-gray-900 text-sm font-medium transition-colors">Features</a>
                    <a href="#how-it-works" class="text-gray-600 hover:text-gray-900 text-sm font-medium transition-colors">How It Works</a>
                    <a href="{{ route('blog.index') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium transition-colors">Blog</a>
                    <a href="{{ route('pages.faq') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium transition-colors">FAQ</a>
                </div>
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium hidden sm:block">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium hidden sm:block">Log in</a>
                        <a href="{{ route('register') }}" class="brand-gradient text-white px-4 sm:px-5 py-2 rounded-full text-sm font-semibold hover:opacity-90 transition-opacity">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-16 lg:py-24 px-4 sm:px-6 lg:px-8 pattern-dots">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 bg-white px-4 py-2 rounded-full soft-shadow mb-8">
                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                <span class="text-sm font-medium text-gray-700">100% Free Forever</span>
                <span class="text-gray-300">•</span>
                <span class="text-sm text-gray-500">No Credit Card</span>
            </div>
            
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
                Shorten Your Links<br>
                <span class="brand-text">Share Everywhere</span>
            </h1>
            
            <p class="text-lg text-gray-600 mb-10 max-w-2xl mx-auto">
                Create short, memorable links in seconds. Track clicks, generate QR codes, and manage all your links — completely free.
            </p>

            <!-- URL Shortener Form -->
            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-2xl soft-shadow p-6">
                    <form id="shortenForm" class="space-y-4">
                        @csrf
                        <div class="flex flex-col sm:flex-row gap-3">
                            <div class="flex-1 relative">
                                <input 
                                    type="url" 
                                    id="destination_url" 
                                    name="destination_url" 
                                    required
                                    placeholder="Paste your long URL here..."
                                    class="w-full px-5 py-4 text-base rounded-xl bg-gray-50 border-2 border-gray-100 text-gray-800 placeholder-gray-400 focus:border-orange-400 focus:bg-white focus:outline-none transition-all input-shadow"
                                >
                            </div>
                            <button 
                                type="submit" 
                                class="brand-gradient text-white px-8 py-4 rounded-xl font-semibold text-base whitespace-nowrap hover:opacity-90 transition-opacity flex items-center justify-center gap-2"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Shorten
                            </button>
                        </div>
                        
                        @if(config('services.turnstile.site_key'))
                        <!-- Captcha (anti-spam) -->
                        <div class="cf-turnstile flex justify-center" data-sitekey="{{ config('services.turnstile.site_key') }}"></div>
                        @endif

                        <!-- Result Container -->
                        <div id="resultContainer" class="hidden mt-4 p-4 bg-green-50 border border-green-200 rounded-xl">
                            <div class="flex flex-col sm:flex-row items-center gap-3">
                                <div class="flex-1 w-full">
                                    <p class="text-sm text-green-700 font-medium mb-2 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        Your short URL is ready!
                                    </p>
                                    <input type="text" id="shortUrl" readonly class="w-full px-4 py-3 rounded-lg bg-white border border-green-200 font-mono text-gray-800">
                                </div>
                                <button type="button" onclick="copyToClipboard()" class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-lg font-semibold transition-colors flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" /></svg>
                                    Copy
                                </button>
                            </div>
                        </div>
                        
                        <!-- Error Container -->
                        <div id="errorContainer" class="hidden mt-4 p-4 bg-red-50 border border-red-200 rounded-xl">
                            <p id="errorMessage" class="text-sm text-red-600"></p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Stats -->
            <div class="mt-12 flex flex-wrap justify-center gap-8 lg:gap-16">
                <div class="text-center">
                    <div class="text-3xl font-bold brand-text">10M+</div>
                    <div class="text-gray-500 text-sm mt-1">Links Created</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold brand-text">50ms</div>
                    <div class="text-gray-500 text-sm mt-1">Avg. Redirect</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold brand-text">99.9%</div>
                    <div class="text-gray-500 text-sm mt-1">Uptime</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ad Banner - Horizontal -->
    <div class="bg-white py-6 border-y border-gray-100">
        <div class="max-w-5xl mx-auto px-4">
            <div class="ad-placeholder rounded-xl h-[250px] flex items-center justify-center">
                <div class="text-center">
                    <span class="text-gray-400 text-sm font-medium">Advertisement</span>
                    <p class="text-gray-300 text-xs mt-1">Google AdSense - 300x250 or Responsive</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section id="features" class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-14">
                <span class="inline-block px-4 py-1.5 bg-orange-50 text-orange-600 rounded-full text-sm font-semibold mb-4">Features</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                    Everything You Need, <span class="brand-text">Free</span>
                </h2>
                <p class="text-gray-600 max-w-xl mx-auto">
                    No hidden fees. All features are completely free forever.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div class="hover-lift bg-gray-50 rounded-2xl p-6 border border-gray-100">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Lightning Fast</h3>
                    <p class="text-gray-600 text-sm">Redirects in under 50ms. Your links work instantly.</p>
                </div>

                <!-- Feature 2 -->
                <div class="hover-lift bg-gray-50 rounded-2xl p-6 border border-gray-100">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Free Analytics</h3>
                    <p class="text-gray-600 text-sm">Track clicks, locations, devices, and referrers.</p>
                </div>

                <!-- Feature 3 -->
                <div class="hover-lift bg-gray-50 rounded-2xl p-6 border border-gray-100">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">QR Codes</h3>
                    <p class="text-gray-600 text-sm">Generate QR codes for any link instantly.</p>
                </div>

                <!-- Feature 4 -->
                <div class="hover-lift bg-gray-50 rounded-2xl p-6 border border-gray-100">
                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Password Protection</h3>
                    <p class="text-gray-600 text-sm">Secure your links with passwords.</p>
                </div>

                <!-- Feature 5 -->
                <div class="hover-lift bg-gray-50 rounded-2xl p-6 border border-gray-100">
                    <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Link Expiration</h3>
                    <p class="text-gray-600 text-sm">Set expiration dates or click limits.</p>
                </div>

                <!-- Feature 6 -->
                <div class="hover-lift bg-gray-50 rounded-2xl p-6 border border-gray-100">
                    <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Privacy First</h3>
                    <p class="text-gray-600 text-sm">GDPR compliant. We hash all personal data.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sidebar Ad + Content Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <div id="how-it-works" class="bg-white rounded-2xl soft-shadow p-8">
                        <span class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 rounded-full text-sm font-semibold mb-6">How It Works</span>
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-8">
                            Three Simple Steps
                        </h2>
                        
                        <div class="space-y-8">
                            <div class="flex gap-5">
                                <div class="flex-shrink-0 w-12 h-12 brand-gradient rounded-xl flex items-center justify-center text-white font-bold text-lg">1</div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Paste Your URL</h3>
                                    <p class="text-gray-600">Enter any long URL into the input field above.</p>
                                </div>
                            </div>
                            
                            <div class="flex gap-5">
                                <div class="flex-shrink-0 w-12 h-12 brand-gradient rounded-xl flex items-center justify-center text-white font-bold text-lg">2</div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Click Shorten</h3>
                                    <p class="text-gray-600">Hit the shorten button and we'll create your link instantly.</p>
                                </div>
                            </div>
                            
                            <div class="flex gap-5">
                                <div class="flex-shrink-0 w-12 h-12 brand-gradient rounded-xl flex items-center justify-center text-white font-bold text-lg">3</div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Share Anywhere</h3>
                                    <p class="text-gray-600">Copy your short link and share it on social media, emails, or anywhere.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar Ad -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24 space-y-6">
                        <div class="ad-placeholder rounded-xl h-[600px] flex items-center justify-center">
                            <div class="text-center">
                                <span class="text-gray-400 text-sm font-medium">Advertisement</span>
                                <p class="text-gray-300 text-xs mt-1">300x600</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Preview Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-white border-t border-gray-100">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10">
                <div>
                    <span class="inline-block px-4 py-1.5 bg-pink-50 text-pink-600 rounded-full text-sm font-semibold mb-3">Blog</span>
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Latest Articles</h2>
                </div>
                <a href="{{ route('blog.index') }}" class="mt-4 sm:mt-0 text-orange-600 hover:text-orange-700 font-medium flex items-center gap-1 transition-colors">
                    View All
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('blog.show', 'what-is-url-shortener') }}" class="hover-lift bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 group">
                    <div class="aspect-video bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center">
                        <svg class="w-12 h-12 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                    </div>
                    <div class="p-5">
                        <span class="text-xs font-semibold text-blue-600 uppercase tracking-wider">Basics</span>
                        <h3 class="text-base font-semibold text-gray-900 mt-2 mb-2 group-hover:text-orange-600 transition-colors">What is a URL Shortener?</h3>
                        <p class="text-gray-500 text-sm line-clamp-2">Learn everything about URL shorteners and how they work.</p>
                    </div>
                </a>
                
                <a href="{{ route('blog.show', 'benefits-of-short-urls') }}" class="hover-lift bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 group">
                    <div class="aspect-video bg-gradient-to-br from-green-100 to-green-50 flex items-center justify-center">
                        <svg class="w-12 h-12 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <div class="p-5">
                        <span class="text-xs font-semibold text-green-600 uppercase tracking-wider">Marketing</span>
                        <h3 class="text-base font-semibold text-gray-900 mt-2 mb-2 group-hover:text-orange-600 transition-colors">10 Benefits of Short URLs</h3>
                        <p class="text-gray-500 text-sm line-clamp-2">Discover the top benefits including better analytics.</p>
                    </div>
                </a>
                
                <a href="{{ route('blog.show', 'qr-codes-marketing-guide') }}" class="hover-lift bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 group">
                    <div class="aspect-video bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center">
                        <svg class="w-12 h-12 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                    </div>
                    <div class="p-5">
                        <span class="text-xs font-semibold text-purple-600 uppercase tracking-wider">Guide</span>
                        <h3 class="text-base font-semibold text-gray-900 mt-2 mb-2 group-hover:text-orange-600 transition-colors">QR Codes Marketing Guide</h3>
                        <p class="text-gray-500 text-sm line-clamp-2">Learn how to use QR codes for your marketing.</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Bottom Ad Banner -->
    <div class="bg-gray-50 py-6 border-y border-gray-100">
        <div class="max-w-5xl mx-auto px-4">
            <div class="ad-placeholder rounded-xl h-[90px] flex items-center justify-center">
                <div class="text-center">
                    <span class="text-gray-400 text-sm font-medium">Advertisement</span>
                    <p class="text-gray-300 text-xs mt-1">728x90 Leaderboard</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-5">
                Ready to Shorten Your First Link?
            </h2>
            <p class="text-lg text-gray-600 mb-8">
                Join millions of users who trust SnapURL. It's free, fast, and secure.
            </p>
            <a href="#" onclick="document.getElementById('destination_url').focus(); window.scrollTo({top: 0, behavior: 'smooth'}); return false;" class="inline-flex items-center brand-gradient text-white px-8 py-4 rounded-full text-lg font-semibold hover:opacity-90 transition-opacity">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                </svg>
                Start Shortening — It's Free
            </a>
        </div>
    </section>

    <!-- SEO / About content -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-gray-50 border-t border-gray-100">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">What Is SnapURL?</h2>
            <p class="text-gray-600 leading-relaxed mb-4">
                <strong>SnapURL</strong> is a free URL shortener that turns long, complicated web
                addresses into short, clean, and easy-to-share links. Instead of pasting a messy
                link full of tracking parameters, you get a tidy <code class="px-1.5 py-0.5 bg-gray-100 rounded text-sm">snapurl.to/abc123</code>
                link that looks professional and works everywhere — in social media bios, emails,
                SMS messages, presentations, printed materials, and QR codes. Every shortened link
                also comes with built-in click analytics and an instant QR code, so you can track
                performance and reach your audience on any device.
            </p>
            <p class="text-gray-600 leading-relaxed mb-4">
                You don't need an account to get started. Just paste your link, click
                <em>Shorten</em>, and copy your new short URL. If you sign up for a free account,
                you can manage all your links in one dashboard, edit destinations, set passwords,
                add expiration dates, and view detailed click statistics over time. Learn more in
                our guide on <a href="{{ route('blog.show', 'what-is-url-shortener') }}" class="text-orange-600 hover:underline font-medium">what a URL shortener is</a>.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">Why Shorten Your URLs?</h2>
            <p class="text-gray-600 leading-relaxed mb-5">
                Short links aren't just shorter — they're smarter. A good URL shortener helps your
                links look trustworthy, fit within character limits, and tell you exactly how your
                audience is engaging. Here's what you get with SnapURL:
            </p>
            <ul class="space-y-3 mb-4">
                <li class="flex items-start gap-3 text-gray-600">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"/></svg>
                    <span><strong>100% free, no signup required.</strong> Create unlimited short links without paying or registering.</span>
                </li>
                <li class="flex items-start gap-3 text-gray-600">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"/></svg>
                    <span><strong>Click analytics.</strong> See how many people click your links and when, so you can measure what works. Read more about <a href="{{ route('blog.show', 'link-tracking-analytics') }}" class="text-orange-600 hover:underline font-medium">link tracking and analytics</a>.</span>
                </li>
                <li class="flex items-start gap-3 text-gray-600">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"/></svg>
                    <span><strong>Free QR codes.</strong> Every link gets a scannable QR code — perfect for posters, packaging, and events. See our <a href="{{ route('blog.show', 'qr-codes-marketing-guide') }}" class="text-orange-600 hover:underline font-medium">QR code marketing guide</a>.</span>
                </li>
                <li class="flex items-start gap-3 text-gray-600">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"/></svg>
                    <span><strong>Password protection &amp; expiration.</strong> Keep sensitive links private or make them expire automatically after a date or click limit.</span>
                </li>
                <li class="flex items-start gap-3 text-gray-600">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"/></svg>
                    <span><strong>Cleaner sharing.</strong> Short, branded links are easier to remember, look more trustworthy, and fit platforms with strict character limits.</span>
                </li>
            </ul>

            <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">Who Is SnapURL For?</h2>
            <p class="text-gray-600 leading-relaxed mb-4">
                SnapURL works for anyone who shares links online. <strong>Marketers and businesses</strong>
                use it to track campaigns and add UTM parameters — see our
                <a href="{{ route('blog.show', 'utm-parameters-guide') }}" class="text-orange-600 hover:underline font-medium">UTM parameters guide</a>.
                <strong>Content creators and influencers</strong> shorten links for their
                <a href="{{ route('blog.show', 'url-shortener-for-social-media') }}" class="text-orange-600 hover:underline font-medium">social media bios and posts</a>,
                where every character counts. <strong>Small businesses</strong> add QR codes to menus,
                flyers, and product packaging. And <strong>everyday users</strong> simply want a quick,
                clean way to share a link without exposing a giant URL.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">Safe and Privacy-First by Design</h2>
            <p class="text-gray-600 leading-relaxed mb-4">
                Trust matters with short links, because the destination is hidden until someone clicks.
                That's why SnapURL automatically screens every link against known phishing and malware
                databases and blocks unsafe destinations before they can be shortened. We also protect
                the service with bot detection and abuse limits, so the links you share stay clean and
                reliable. You can read more about staying safe in our article on
                <a href="{{ route('blog.show', 'url-shortener-security') }}" class="text-orange-600 hover:underline font-medium">URL shortener security</a>.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-5">Frequently Asked Questions</h2>
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Is SnapURL really free?</h3>
                    <p class="text-gray-600 leading-relaxed">Yes. You can shorten as many links as you like for free, and you don't even need to create an account to get started.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Do my short links ever expire?</h3>
                    <p class="text-gray-600 leading-relaxed">Your links stay active by default. If you want, you can set an optional expiration date or a maximum number of clicks when you create or edit a link.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Can I see how many people clicked my link?</h3>
                    <p class="text-gray-600 leading-relaxed">Absolutely. Every link includes free click analytics. Sign in to your dashboard to view total clicks and trends over time.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Does every link get a QR code?</h3>
                    <p class="text-gray-600 leading-relaxed">Yes — a scannable QR code is generated for every short link, so you can bridge your offline and online audiences instantly.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Are shortened links safe to click?</h3>
                    <p class="text-gray-600 leading-relaxed">SnapURL checks destinations against trusted safe-browsing databases and blocks known phishing and malware sites, helping keep every link you create trustworthy.</p>
                </div>
            </div>

            <p class="text-gray-600 leading-relaxed mt-10">
                Ready to try it? <a href="#" onclick="document.getElementById('destination_url').focus(); window.scrollTo({top: 0, behavior: 'smooth'}); return false;" class="text-orange-600 hover:underline font-medium">Shorten your first link</a>,
                explore more tips on our <a href="{{ route('blog.index') }}" class="text-orange-600 hover:underline font-medium">blog</a>,
                or read our <a href="{{ route('pages.faq') }}" class="text-orange-600 hover:underline font-medium">FAQ</a> and
                <a href="{{ route('pages.about') }}" class="text-orange-600 hover:underline font-medium">about page</a> to learn more about SnapURL.
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-14 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-8 mb-10">
                <div class="col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-9 h-9 brand-gradient rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold">SnapURL</span>
                    </div>
                    <p class="text-gray-400 text-sm max-w-xs">
                        100% free URL shortener with analytics and QR codes. No signup required.
                    </p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-300 mb-4">Product</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#features" class="text-gray-400 hover:text-white transition-colors">Features</a></li>
                        <li><a href="{{ route('blog.index') }}" class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
                        <li><a href="{{ route('pages.faq') }}" class="text-gray-400 hover:text-white transition-colors">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-300 mb-4">Company</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('pages.about') }}" class="text-gray-400 hover:text-white transition-colors">About</a></li>
                        <li><a href="{{ route('pages.contact') }}" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                        <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white transition-colors">Sign Up</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-300 mb-4">Legal</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('pages.privacy') }}" class="text-gray-400 hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="{{ route('pages.terms') }}" class="text-gray-400 hover:text-white transition-colors">Terms of Service</a></li>
                        <li><a href="{{ route('pages.disclaimer') }}" class="text-gray-400 hover:text-white transition-colors">Disclaimer</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} SnapURL.to. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Cookie Consent -->
    <x-cookie-consent />

    @if(config('services.turnstile.site_key'))
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    @endif

    <!-- JavaScript -->
    <script>
        document.getElementById('shortenForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const url = document.getElementById('destination_url').value;
            const resultContainer = document.getElementById('resultContainer');
            const errorContainer = document.getElementById('errorContainer');
            const shortUrlInput = document.getElementById('shortUrl');
            const submitBtn = this.querySelector('button[type="submit"]');
            
            resultContainer.classList.add('hidden');
            errorContainer.classList.add('hidden');
            
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Shortening...';
            submitBtn.disabled = true;
            
            try {
                const response = await fetch('/links', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        destination_url: url,
                        'cf-turnstile-response': document.querySelector('[name="cf-turnstile-response"]')?.value
                    })
                });
                
                const data = await response.json();
                
                if (response.ok) {
                    shortUrlInput.value = data.link?.short_url || data.short_url || window.location.origin + '/' + (data.link?.slug || data.slug);
                    resultContainer.classList.remove('hidden');
                } else {
                    document.getElementById('errorMessage').textContent = data.message || data.errors?.destination_url?.[0] || 'An error occurred';
                    errorContainer.classList.remove('hidden');
                }
            } catch (error) {
                document.getElementById('errorMessage').textContent = 'Network error. Please try again.';
                errorContainer.classList.remove('hidden');
            } finally {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                if (window.turnstile) { window.turnstile.reset(); }
            }
        });
        
        function copyToClipboard() {
            const shortUrl = document.getElementById('shortUrl');
            shortUrl.select();
            document.execCommand('copy');
            
            const btn = event.target.closest('button');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Copied!';
            
            setTimeout(() => {
                btn.innerHTML = originalText;
            }, 2000);
        }
    </script>
</body>
</html>
