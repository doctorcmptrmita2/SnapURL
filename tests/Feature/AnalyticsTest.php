<?php

namespace Tests\Feature;

use App\Models\Link;
use App\Models\LinkAnalytic;
use App\Models\LinkClick;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnalyticsTest extends TestCase
{
    use RefreshDatabase;

    public function test_analytics_aggregation_works(): void
    {
        $link = Link::factory()->create();

        // Create some clicks
        LinkClick::factory()->count(10)->create([
            'link_id' => $link->id,
            'clicked_at' => now()->subDay(),
        ]);

        // Run aggregation command
        $this->artisan('links:aggregate', ['--date' => now()->subDay()->format('Y-m-d')])
            ->assertSuccessful();

        $this->assertDatabaseHas('link_analytics', [
            'link_id' => $link->id,
            'date' => now()->subDay()->format('Y-m-d'),
            'clicks' => 10,
        ]);
    }

    public function test_unique_clicks_are_counted_correctly(): void
    {
        $link = Link::factory()->create();

        // Create clicks with same IP (should count as 1 unique)
        LinkClick::factory()->count(5)->create([
            'link_id' => $link->id,
            'ip_hash' => hash('sha256', '127.0.0.1' . config('app.key')),
            'clicked_at' => now()->subDay(),
        ]);

        // Create clicks with different IP (should count as 1 unique)
        LinkClick::factory()->count(3)->create([
            'link_id' => $link->id,
            'ip_hash' => hash('sha256', '192.168.1.1' . config('app.key')),
            'clicked_at' => now()->subDay(),
        ]);

        $this->artisan('links:aggregate', ['--date' => now()->subDay()->format('Y-m-d')])
            ->assertSuccessful();

        $analytic = LinkAnalytic::where('link_id', $link->id)
            ->where('date', now()->subDay()->format('Y-m-d'))
            ->first();

        $this->assertEquals(8, $analytic->clicks);
        $this->assertEquals(2, $analytic->unique_clicks);
    }

    public function test_user_can_view_link_analytics(): void
    {
        $user = User::factory()->create();
        $link = Link::factory()->create(['user_id' => $user->id]);

        LinkAnalytic::factory()->count(5)->create([
            'link_id' => $link->id,
        ]);

        $response = $this->actingAs($user)->get("/links/{$link->id}");

        $response->assertStatus(200);
        $response->assertViewHas('analytics');
    }
}
