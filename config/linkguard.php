<?php

return [
    /*
    | Comma-separated domains that may never be shortened. A match also covers
    | subdomains (e.g. "bad.com" blocks "x.bad.com"). Set BLOCKED_DOMAINS in .env.
    */
    'blocked_domains' => array_filter(array_map(
        'trim',
        explode(',', (string) env('BLOCKED_DOMAINS', ''))
    )),
];
