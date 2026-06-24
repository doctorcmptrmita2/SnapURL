<?php

namespace Database\Factories;

use App\Models\Link;
use App\Models\LinkAnalytic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LinkAnalytic>
 */
class LinkAnalyticFactory extends Factory
{
    protected $model = LinkAnalytic::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $clicks = $this->faker->numberBetween(1, 100);
        $uniqueClicks = $this->faker->numberBetween(1, $clicks);

        return [
            'link_id' => Link::factory(),
            'date' => $this->faker->dateTimeBetween('-30 days', 'now'),
            'clicks' => $clicks,
            'unique_clicks' => $uniqueClicks,
        ];
    }
}
