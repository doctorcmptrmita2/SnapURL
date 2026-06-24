<?php

namespace Tests\Feature;

use App\Models\Link;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RedirectTest extends TestCase
{
    use RefreshDatabase;

    public function test_redirect_works_for_active_link(): void
    {
        $link = Link::factory()->create([
            'slug' => 'test-slug',
            'destination_url' => 'https://example.com',
            'status' => 'active',
        ]);

        $response = $this->get("/{$link->slug}");

        $response->assertRedirect('https://example.com');
        $response->assertStatus(301);
    }

    public function test_redirect_returns_404_for_invalid_slug(): void
    {
        $response = $this->get('/invalid-slug-12345');

        $response->assertStatus(404);
    }

    public function test_redirect_returns_404_for_expired_link(): void
    {
        $link = Link::factory()->create([
            'slug' => 'expired-slug',
            'destination_url' => 'https://example.com',
            'status' => 'expired',
        ]);

        $response = $this->get("/{$link->slug}");

        $response->assertStatus(404);
    }

    public function test_redirect_increments_click_count(): void
    {
        $link = Link::factory()->create([
            'slug' => 'test-click',
            'destination_url' => 'https://example.com',
            'click_count' => 0,
        ]);

        $this->get("/{$link->slug}");

        $link->refresh();
        $this->assertEquals(1, $link->click_count);
    }

    public function test_password_protected_link_requires_password(): void
    {
        $link = Link::factory()->create([
            'slug' => 'protected',
            'destination_url' => 'https://example.com',
            'password' => bcrypt('secret123'),
        ]);

        $response = $this->get("/{$link->slug}");

        $response->assertStatus(200);
        $response->assertViewIs('links.password');
    }
}
