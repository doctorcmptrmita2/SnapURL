@props([
    'title' => 'Shorten Your URL in a Snap - snapurl.to',
    'description' => 'SnapURL.to is a global, privacy-first link shortener that combines speed, analytics, and simplicity. With SnapURL, you can create short links in a snap — no signup needed.',
    'keywords' => 'url shortener, shorten url, free link shortener, snapurl, snapurl.to, shorten links, link shortener tool, private URL shortener, secure link generator, GDPR safe shortener, SaaS URL shortener, analytics shortener, branded link generator, QR code shortener',
    'canonical' => 'https://snapurl.to/',
    'ogImage' => 'https://snapurl.to/og-image.jpg',
    'type' => 'website'
])

<!-- Primary Meta Tags -->
<title>{{ $title }}</title>
<meta name="title" content="{{ $title }}">
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<meta name="robots" content="index, follow">
<meta name="language" content="en">
<meta name="author" content="SnapURL.to">
<meta name="theme-color" content="#2563eb">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $type }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:site_name" content="SnapURL.to">
<meta property="og:locale" content="en_US">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ $canonical }}">
<meta property="twitter:title" content="{{ $title }}">
<meta property="twitter:description" content="{{ Str::limit($description, 200) }}">
<meta property="twitter:image" content="{{ $ogImage }}">
<meta property="twitter:creator" content="@snapurlto">

<!-- Canonical -->
<link rel="canonical" href="{{ $canonical }}">

<!-- Favicon -->
<link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.ico') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.ico') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon.svg') }}">
<link rel="manifest" href="{{ asset('site.webmanifest') }}">

<!-- Preconnect for Performance -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link rel="dns-prefetch" href="https://fonts.bunny.net">

