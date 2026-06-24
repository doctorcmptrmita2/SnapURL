<?php

namespace App\Http\Controllers;

class SitemapController extends Controller
{
    public function index()
    {
        $base = rtrim((string) config('app.url'), '/');

        // [path, priority, changefreq]
        $staticPages = [
            ['/', '1.0', 'daily'],
            ['/blog', '0.9', 'weekly'],
            ['/about', '0.5', 'monthly'],
            ['/contact', '0.5', 'monthly'],
            ['/faq', '0.6', 'monthly'],
            ['/privacy', '0.3', 'yearly'],
            ['/terms', '0.3', 'yearly'],
            ['/disclaimer', '0.3', 'yearly'],
            ['/login', '0.4', 'monthly'],
            ['/register', '0.4', 'monthly'],
        ];

        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($staticPages as [$path, $priority, $freq]) {
            $xml .= $this->urlEntry($base . $path, null, $freq, $priority);
        }

        foreach (BlogController::getArticles() as $article) {
            $xml .= $this->urlEntry(
                $base . '/blog/' . $article['slug'],
                $article['date'] ?? null,
                'monthly',
                '0.7'
            );
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    private function urlEntry(string $loc, ?string $lastmod, string $changefreq, string $priority): string
    {
        $entry  = "  <url>\n";
        $entry .= '    <loc>' . htmlspecialchars($loc, ENT_XML1) . "</loc>\n";
        if ($lastmod) {
            $entry .= "    <lastmod>{$lastmod}</lastmod>\n";
        }
        $entry .= "    <changefreq>{$changefreq}</changefreq>\n";
        $entry .= "    <priority>{$priority}</priority>\n";
        $entry .= "  </url>\n";

        return $entry;
    }
}
