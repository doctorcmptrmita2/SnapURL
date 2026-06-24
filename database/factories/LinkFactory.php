<?php

namespace Database\Factories;

use App\Models\Link;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Link>
 */
class LinkFactory extends Factory
{
    protected $model = Link::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'slug' => Str::random(6),
            'destination_url' => $this->faker->url(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'password' => null,
            'expires_at' => null,
            'max_clicks' => null,
            'click_count' => 0,
            'unique_click_count' => 0,
            'status' => 'active',
            'custom_domain' => null,
            'is_public' => true,
            'ip_hash' => null,
        ];
    }
}
