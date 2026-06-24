<?php

namespace Tests\Feature;

use App\Models\Link;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LinkTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_link(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/links', [
            'destination_url' => 'https://example.com',
            'title' => 'Test Link',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('links', [
            'user_id' => $user->id,
            'destination_url' => 'https://example.com',
            'title' => 'Test Link',
        ]);
    }

    public function test_user_can_create_link_with_custom_slug(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/links', [
            'destination_url' => 'https://example.com',
            'slug' => 'my-custom-slug',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('links', [
            'slug' => 'my-custom-slug',
        ]);
    }

    public function test_user_can_update_link(): void
    {
        $user = User::factory()->create();
        $link = Link::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put("/links/{$link->id}", [
            'destination_url' => 'https://updated.com',
            'title' => 'Updated Title',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('links', [
            'id' => $link->id,
            'destination_url' => 'https://updated.com',
            'title' => 'Updated Title',
        ]);
    }

    public function test_user_can_delete_link(): void
    {
        $user = User::factory()->create();
        $link = Link::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete("/links/{$link->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('links', ['id' => $link->id]);
    }

    public function test_link_expires_when_max_clicks_reached(): void
    {
        $link = Link::factory()->create([
            'max_clicks' => 5,
            'click_count' => 4,
            'status' => 'active',
        ]);

        $this->assertFalse($link->isExpired());

        $link->update(['click_count' => 5]);
        $link->refresh();

        $this->assertTrue($link->isExpired());
    }

    public function test_link_expires_when_expiration_date_passed(): void
    {
        $link = Link::factory()->create([
            'expires_at' => now()->addDay(),
            'status' => 'active',
        ]);

        $this->assertFalse($link->isExpired());

        $link->update(['expires_at' => now()->subDay()]);
        $link->refresh();

        $this->assertTrue($link->isExpired());
    }
}
