<?php

namespace Database\Factories;

use App\Models\Link;
use App\Models\LinkClick;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LinkClick>
 */
class LinkClickFactory extends Factory
{
    protected $model = LinkClick::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ip = $this->faker->ipv4();
        $userAgent = $this->faker->userAgent();

        return [
            'link_id' => Link::factory(),
            'ip_hash' => hash('sha256', $ip . config('app.key')),
            'user_agent_hash' => hash('sha256', $userAgent . config('app.key')),
            'country' => $this->faker->countryCode(),
            'city' => $this->faker->city(),
            'referrer' => $this->faker->url(),
            'device_type' => $this->faker->randomElement(['desktop', 'mobile', 'tablet']),
            'browser' => $this->faker->randomElement(['Chrome', 'Firefox', 'Safari', 'Edge']),
            'os' => $this->faker->randomElement(['Windows', 'macOS', 'Linux', 'Android', 'iOS']),
            'clicked_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
