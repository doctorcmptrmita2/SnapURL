<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public static function getArticles()
    {
        return [
            [
                'slug' => 'what-is-url-shortener',
                'title' => 'What is a URL Shortener? Complete Guide for Beginners',
                'excerpt' => 'Learn everything about URL shorteners, how they work, and why millions of people use them daily for sharing links.',
                'category' => 'Basics',
                'date' => '2026-01-15',
                'read_time' => 8,
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'benefits-of-short-urls',
                'title' => '10 Amazing Benefits of Using Short URLs in 2026',
                'excerpt' => 'Discover the top benefits of URL shortening including better analytics, improved click rates, and professional branding.',
                'category' => 'Marketing',
                'date' => '2026-01-14',
                'read_time' => 7,
                'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'url-shortener-for-social-media',
                'title' => 'How to Use URL Shorteners for Social Media Marketing',
                'excerpt' => 'Master social media marketing with shortened URLs. Learn platform-specific strategies for Twitter, Instagram, and LinkedIn.',
                'category' => 'Social Media',
                'date' => '2026-01-13',
                'read_time' => 9,
                'image' => 'https://images.unsplash.com/photo-1611162617474-5b21e879e113?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'qr-codes-marketing-guide',
                'title' => 'QR Codes Marketing: The Ultimate Guide for Businesses',
                'excerpt' => 'Learn how to create and use QR codes effectively for your marketing campaigns and drive more engagement.',
                'category' => 'Marketing',
                'date' => '2026-01-12',
                'read_time' => 10,
                'image' => 'https://images.unsplash.com/photo-1595079676339-1534801ad6cf?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'link-tracking-analytics',
                'title' => 'Link Tracking and Analytics: Measure Your Marketing Success',
                'excerpt' => 'Understand how link tracking works and use analytics to optimize your marketing campaigns for better ROI.',
                'category' => 'Analytics',
                'date' => '2026-01-11',
                'read_time' => 8,
                'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'branded-short-links',
                'title' => 'Branded Short Links: Build Trust and Recognition',
                'excerpt' => 'Create branded short links that increase click-through rates and build brand recognition across all channels.',
                'category' => 'Branding',
                'date' => '2026-01-10',
                'read_time' => 7,
                'image' => 'https://images.unsplash.com/photo-1493421419110-74f4e85ba126?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'url-shortener-seo-impact',
                'title' => 'Do URL Shorteners Affect SEO? The Complete Truth',
                'excerpt' => 'Understand the relationship between shortened URLs and search engine optimization. Learn best practices for SEO.',
                'category' => 'SEO',
                'date' => '2026-01-09',
                'read_time' => 9,
                'image' => 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'email-marketing-short-urls',
                'title' => 'Short URLs in Email Marketing: Boost Your Click Rates',
                'excerpt' => 'Improve your email marketing campaigns with shortened URLs. Track clicks and optimize your email performance.',
                'category' => 'Email Marketing',
                'date' => '2026-01-08',
                'read_time' => 8,
                'image' => 'https://images.unsplash.com/photo-1596526131083-e8c633c948d2?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'link-management-best-practices',
                'title' => 'Link Management Best Practices for Digital Marketers',
                'excerpt' => 'Master link management with proven strategies. Organize, track, and optimize all your marketing links effectively.',
                'category' => 'Marketing',
                'date' => '2026-01-07',
                'read_time' => 10,
                'image' => 'https://images.unsplash.com/photo-1553484771-371a605b060b?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'url-shortener-security',
                'title' => 'URL Shortener Security: Protecting Your Links and Data',
                'excerpt' => 'Learn about URL shortener security features including password protection, expiration dates, and privacy controls.',
                'category' => 'Security',
                'date' => '2026-01-06',
                'read_time' => 8,
                'image' => 'https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'twitter-character-limit-urls',
                'title' => 'Twitter Character Limit: Why Short URLs Are Essential',
                'excerpt' => 'Maximize your Twitter presence with shortened URLs. Save characters and track engagement on every tweet.',
                'category' => 'Social Media',
                'date' => '2026-01-05',
                'read_time' => 6,
                'image' => 'https://images.unsplash.com/photo-1611605698335-8b1569810432?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'instagram-bio-link-strategies',
                'title' => 'Instagram Bio Link Strategies That Drive Traffic',
                'excerpt' => 'Optimize your Instagram bio link for maximum traffic. Learn strategies to convert followers into website visitors.',
                'category' => 'Social Media',
                'date' => '2026-01-04',
                'read_time' => 7,
                'image' => 'https://images.unsplash.com/photo-1611262588024-d12430b98920?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'affiliate-marketing-link-tracking',
                'title' => 'Affiliate Marketing Link Tracking: Complete Guide',
                'excerpt' => 'Track your affiliate links effectively and maximize your earnings with proper link management strategies.',
                'category' => 'Affiliate',
                'date' => '2026-01-03',
                'read_time' => 9,
                'image' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'utm-parameters-guide',
                'title' => 'UTM Parameters: Track Your Marketing Campaigns Like a Pro',
                'excerpt' => 'Master UTM parameters to track marketing campaigns accurately. Learn how to create and analyze UTM tagged URLs.',
                'category' => 'Analytics',
                'date' => '2026-01-02',
                'read_time' => 10,
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'link-retargeting-strategies',
                'title' => 'Link Retargeting: Turn Clicks into Customers',
                'excerpt' => 'Use link retargeting to build custom audiences and convert link clickers into paying customers.',
                'category' => 'Marketing',
                'date' => '2026-01-01',
                'read_time' => 8,
                'image' => 'https://images.unsplash.com/photo-1533750349088-cd871a92f312?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'mobile-marketing-short-urls',
                'title' => 'Mobile Marketing with Short URLs: Best Practices',
                'excerpt' => 'Optimize your mobile marketing campaigns with shortened URLs designed for smartphone users.',
                'category' => 'Mobile',
                'date' => '2025-12-31',
                'read_time' => 7,
                'image' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'podcast-promotion-links',
                'title' => 'Podcast Promotion: Using Short Links to Grow Your Audience',
                'excerpt' => 'Promote your podcast effectively with trackable short links. Measure listener engagement across platforms.',
                'category' => 'Content',
                'date' => '2025-12-30',
                'read_time' => 8,
                'image' => 'https://images.unsplash.com/photo-1590602847861-f357a9332bbc?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'youtube-video-promotion',
                'title' => 'YouTube Video Promotion with Shortened URLs',
                'excerpt' => 'Boost your YouTube views with strategic link sharing. Track which platforms drive the most video traffic.',
                'category' => 'Video',
                'date' => '2025-12-29',
                'read_time' => 7,
                'image' => 'https://images.unsplash.com/photo-1611162616475-46b635cb6868?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'ecommerce-link-strategies',
                'title' => 'E-commerce Link Strategies to Increase Sales',
                'excerpt' => 'Drive more sales with optimized product links. Learn e-commerce link strategies that convert browsers to buyers.',
                'category' => 'E-commerce',
                'date' => '2025-12-28',
                'read_time' => 9,
                'image' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'nonprofit-url-shortening',
                'title' => 'URL Shortening for Nonprofits: Maximize Donations',
                'excerpt' => 'Help your nonprofit reach more donors with effective link strategies. Track campaign performance easily.',
                'category' => 'Nonprofit',
                'date' => '2025-12-27',
                'read_time' => 7,
                'image' => 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'print-marketing-qr-codes',
                'title' => 'Print Marketing with QR Codes: Bridge Offline and Online',
                'excerpt' => 'Connect your print materials to digital content with QR codes. Track offline marketing effectiveness.',
                'category' => 'Marketing',
                'date' => '2025-12-26',
                'read_time' => 8,
                'image' => 'https://images.unsplash.com/photo-1586339949916-3e9457bef6d3?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'event-marketing-links',
                'title' => 'Event Marketing: Using Short Links for Registrations',
                'excerpt' => 'Promote your events effectively with trackable registration links. Measure marketing channel performance.',
                'category' => 'Events',
                'date' => '2025-12-25',
                'read_time' => 7,
                'image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'influencer-marketing-tracking',
                'title' => 'Influencer Marketing: Track Campaign Performance',
                'excerpt' => 'Measure influencer marketing ROI with unique tracking links. Identify your best performing partnerships.',
                'category' => 'Influencer',
                'date' => '2025-12-24',
                'read_time' => 9,
                'image' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'sms-marketing-short-urls',
                'title' => 'SMS Marketing with Short URLs: Complete Guide',
                'excerpt' => 'Maximize SMS marketing effectiveness with shortened URLs. Save characters and track message performance.',
                'category' => 'SMS',
                'date' => '2025-12-23',
                'read_time' => 8,
                'image' => 'https://images.unsplash.com/photo-1577563908411-5077b6dc7624?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'linkedin-marketing-links',
                'title' => 'LinkedIn Marketing: Optimize Your Profile and Post Links',
                'excerpt' => 'Boost your LinkedIn presence with strategic link placement. Track professional network engagement.',
                'category' => 'Social Media',
                'date' => '2025-12-22',
                'read_time' => 7,
                'image' => 'https://images.unsplash.com/photo-1611944212129-29977ae1398c?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'tiktok-bio-link-optimization',
                'title' => 'TikTok Bio Link: Drive Traffic from Short Videos',
                'excerpt' => 'Convert TikTok viewers into website visitors with optimized bio links. Track your viral content performance.',
                'category' => 'Social Media',
                'date' => '2025-12-21',
                'read_time' => 6,
                'image' => 'https://images.unsplash.com/photo-1611605698335-8b1569810432?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'ab-testing-landing-pages',
                'title' => 'A/B Testing Landing Pages with Tracked Links',
                'excerpt' => 'Improve conversion rates with A/B testing. Use tracked links to measure landing page performance accurately.',
                'category' => 'Optimization',
                'date' => '2025-12-20',
                'read_time' => 9,
                'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'customer-journey-tracking',
                'title' => 'Customer Journey Tracking with Link Analytics',
                'excerpt' => 'Understand your customer journey with comprehensive link tracking. Optimize touchpoints for better conversions.',
                'category' => 'Analytics',
                'date' => '2025-12-19',
                'read_time' => 10,
                'image' => 'https://images.unsplash.com/photo-1553484771-371a605b060b?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'content-marketing-distribution',
                'title' => 'Content Marketing Distribution: Track What Works',
                'excerpt' => 'Distribute your content effectively and track performance across channels. Optimize your content strategy.',
                'category' => 'Content',
                'date' => '2025-12-18',
                'read_time' => 8,
                'image' => 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=800&h=450&fit=crop',
            ],
            [
                'slug' => 'digital-marketing-trends-2026',
                'title' => 'Digital Marketing Trends 2026: The Role of Link Management',
                'excerpt' => 'Stay ahead with 2026 digital marketing trends. Learn how link management fits into modern marketing strategies.',
                'category' => 'Trends',
                'date' => '2025-12-17',
                'read_time' => 11,
                'image' => 'https://images.unsplash.com/photo-1504868584819-f8e8b4b6d7e3?w=800&h=450&fit=crop',
            ],
        ];
    }

    public function index()
    {
        $articles = self::getArticles();
        return view('blog.index', compact('articles'));
    }

    public function show($slug)
    {
        $articles = self::getArticles();
        $article = collect($articles)->firstWhere('slug', $slug);
        
        if (!$article) {
            abort(404);
        }

        $relatedArticles = collect($articles)
            ->where('slug', '!=', $slug)
            ->random(3)
            ->values()
            ->all();

        return view('blog.show', compact('article', 'relatedArticles'));
    }
}