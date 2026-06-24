<?php

namespace App\Jobs;

use App\Models\LinkClick;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class LogLinkClick implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $linkId,
        public ?string $ip,
        public ?string $userAgent,
        public ?string $referrer
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Hash IP and User Agent for privacy
        $ipHash = $this->ip ? hash('sha256', $this->ip . config('app.key')) : null;
        $userAgentHash = $this->userAgent ? hash('sha256', $this->userAgent . config('app.key')) : null;

        // Get device type
        $deviceType = $this->getDeviceType($this->userAgent);
        $browser = $this->getBrowser($this->userAgent);
        $os = $this->getOS($this->userAgent);

        // Get location (simplified - in production use GeoIP service)
        $country = $this->getCountry($this->ip);
        $city = null; // Would require GeoIP service

        LinkClick::create([
            'link_id' => $this->linkId,
            'ip_hash' => $ipHash,
            'user_agent_hash' => $userAgentHash,
            'country' => $country,
            'city' => $city,
            'referrer' => $this->referrer,
            'device_type' => $deviceType,
            'browser' => $browser,
            'os' => $os,
            'clicked_at' => now(),
        ]);
    }

    /**
     * Get device type from user agent.
     */
    private function getDeviceType(?string $userAgent): ?string
    {
        if (!$userAgent) {
            return null;
        }

        if (preg_match('/mobile|android|iphone|ipad/i', $userAgent)) {
            return 'mobile';
        }

        if (preg_match('/tablet|ipad/i', $userAgent)) {
            return 'tablet';
        }

        return 'desktop';
    }

    /**
     * Get browser from user agent.
     */
    private function getBrowser(?string $userAgent): ?string
    {
        if (!$userAgent) {
            return null;
        }

        if (preg_match('/chrome/i', $userAgent)) {
            return 'Chrome';
        }
        if (preg_match('/firefox/i', $userAgent)) {
            return 'Firefox';
        }
        if (preg_match('/safari/i', $userAgent)) {
            return 'Safari';
        }
        if (preg_match('/edge/i', $userAgent)) {
            return 'Edge';
        }

        return 'Unknown';
    }

    /**
     * Get OS from user agent.
     */
    private function getOS(?string $userAgent): ?string
    {
        if (!$userAgent) {
            return null;
        }

        if (preg_match('/windows/i', $userAgent)) {
            return 'Windows';
        }
        if (preg_match('/macintosh|mac os/i', $userAgent)) {
            return 'macOS';
        }
        if (preg_match('/linux/i', $userAgent)) {
            return 'Linux';
        }
        if (preg_match('/android/i', $userAgent)) {
            return 'Android';
        }
        if (preg_match('/iphone|ipad|ipod/i', $userAgent)) {
            return 'iOS';
        }

        return 'Unknown';
    }

    /**
     * Get country from IP (simplified - in production use GeoIP).
     */
    private function getCountry(?string $ip): ?string
    {
        if (!$ip) {
            return null;
        }
        
        // Simplified - in production use a GeoIP service like MaxMind
        // For now, return null
        return null;
    }
}
