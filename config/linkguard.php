<?php

$csv = static fn (string $key, string $default = '') => array_values(array_filter(array_map(
    static fn ($v) => strtolower(trim($v)),
    explode(',', (string) env($key, $default))
)));

return [
    /*
    | Comma-separated domains that may never be shortened. A match also covers
    | subdomains (e.g. "bad.com" blocks "x.bad.com"). Set BLOCKED_DOMAINS in .env.
    */
    'blocked_domains' => $csv('BLOCKED_DOMAINS'),

    /*
    | Other URL shorteners / link-cloakers. Chaining shorteners is the standard
    | way spammers hide a phishing destination from Safe Browsing, so we refuse
    | to be the second hop. Extend with BLOCKED_SHORTENERS in .env.
    */
    'blocked_shorteners' => array_merge([
        'bit.ly', 'tinyurl.com', 't.co', 'goo.gl', 'ow.ly', 'is.gd', 'buff.ly',
        'cutt.ly', 'rebrand.ly', 'shorturl.at', 'rb.gy', 's.id', 'tiny.cc',
        'bl.ink', 'short.io', 'urlshort.at', 'tinyur.in', 'flyn.im', 'shrturi.com',
        'adf.ly', 'shorte.st', 'ouo.io', 'exe.io', 'clk.sh', 'za.gl', 'gplinks.co',
        'droplink.co', 'linkvertise.com', 'mdisk.me', 'v.gd', 'soo.gd', 'clicky.me',
    ], $csv('BLOCKED_SHORTENERS')),

    /*
    | Free ephemeral tunnel / preview hosts. Legitimate sites do not live here,
    | but phishing kits do because the hostname rotates faster than blocklists.
    */
    'blocked_ephemeral_hosts' => array_merge([
        'trycloudflare.com', 'cfargotunnel.com', 'ngrok.io', 'ngrok-free.app',
        'ngrok.app', 'loca.lt', 'localtunnel.me', 'serveo.net', 'telebit.io',
        'tunnelto.dev', 'localhost.run', 'pagekite.me',
    ], $csv('BLOCKED_EPHEMERAL_HOSTS')),

    /*
    | TLDs with an overwhelming spam-to-legitimate ratio. Registrars sell these
    | for cents, which is why nearly every link we blocked used one.
    */
    'blocked_tlds' => array_merge([
        'lat', 'top', 'cfd', 'sbs', 'icu', 'cyou', 'rest', 'quest', 'bond',
        'cam', 'monster', 'lol', 'beauty', 'hair', 'skin', 'makeup', 'mom',
        'kim', 'autos', 'boats', 'yachts', 'zip', 'mov', 'tk', 'ml', 'ga', 'cf', 'gq',
    ], $csv('BLOCKED_TLDS')),

    /*
    | Brand names that get impersonated. If one of these appears as a label in
    | the hostname (exactly, or one character off for longer names) and the host
    | is not on the brand's own domain, it is a typosquat: "gooqle-meet-app.live",
    | "poshmark.safe-status.com". Keys are the brand, values its real domains.
    */
    'protected_brands' => [
        'google' => ['google.com', 'google.co.uk', 'goo.gl', 'youtube.com'],
        'youtube' => ['youtube.com', 'youtu.be'],
        'facebook' => ['facebook.com', 'fb.com'],
        'instagram' => ['instagram.com'],
        'whatsapp' => ['whatsapp.com'],
        'microsoft' => ['microsoft.com', 'live.com', 'office.com'],
        'outlook' => ['outlook.com', 'office.com', 'microsoft.com'],
        'apple' => ['apple.com', 'icloud.com'],
        'icloud' => ['icloud.com', 'apple.com'],
        'amazon' => ['amazon.com', 'amazon.co.uk', 'amazon.de', 'aws.amazon.com'],
        'netflix' => ['netflix.com'],
        'paypal' => ['paypal.com', 'paypal.me'],
        'binance' => ['binance.com'],
        'coinbase' => ['coinbase.com'],
        'metamask' => ['metamask.io'],
        'poshmark' => ['poshmark.com'],
        'linkedin' => ['linkedin.com', 'lnkd.in'],
        'snapchat' => ['snapchat.com'],
        'spotify' => ['spotify.com'],
        'telegram' => ['telegram.org', 't.me'],
        'steamcommunity' => ['steamcommunity.com', 'steampowered.com'],
    ],
];
