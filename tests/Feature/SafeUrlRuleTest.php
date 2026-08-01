<?php

namespace Tests\Feature;

use App\Rules\SafeUrl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class SafeUrlRuleTest extends TestCase
{
    use RefreshDatabase;

    private function blocked(string $url): bool
    {
        return Validator::make(['url' => $url], ['url' => [new SafeUrl]])->fails();
    }

    public function test_it_blocks_chained_shorteners(): void
    {
        $this->assertTrue($this->blocked('https://bit.ly/abc123'));
        $this->assertTrue($this->blocked('https://tinyur.in/iIyQ9m'));
        $this->assertTrue($this->blocked('https://urlshort.at/9kbvOm0'));
    }

    public function test_it_blocks_ephemeral_tunnel_hosts(): void
    {
        $this->assertTrue($this->blocked('https://schedules-guest-eastern.trycloudflare.com/apps/instapps/'));
        $this->assertTrue($this->blocked('https://foo.ngrok-free.app/login'));
    }

    public function test_it_blocks_high_abuse_tlds(): void
    {
        $this->assertTrue($this->blocked('https://nowarclintktonenowhere.lat/lVTYzNUj'));
        $this->assertTrue($this->blocked('https://irx.efsywv.lol/c/'));
    }

    public function test_it_blocks_brand_impersonation_and_typosquats(): void
    {
        $this->assertTrue($this->blocked('https://gooqle-meet-app.live/call/5689'));
        $this->assertTrue($this->blocked('https://poshmark.safe-status.com/v/1835231869'));
        $this->assertTrue($this->blocked('https://paypal-verify.example.net/'));
    }

    public function test_it_allows_real_brand_domains_and_innocent_lookalikes(): void
    {
        $this->assertFalse($this->blocked('https://open.spotify.com/playlist/7oNW7RvbwAIFknES2fw78R'));
        $this->assertFalse($this->blocked('https://www.snapchat.com/add/someone'));
        $this->assertFalse($this->blocked('https://youtu.be/dQw4w9WgXcQ'));
        $this->assertFalse($this->blocked('https://pineapple.com/recipes'));
        $this->assertFalse($this->blocked('https://www.mumsnet.com/talk'));
    }
}
