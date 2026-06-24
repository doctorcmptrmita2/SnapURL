<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Free',
                'slug' => 'free',
                'price' => 0,
                'interval' => 'month',
                'max_links' => 10,
                'max_clicks_per_link' => 1000,
                'max_custom_domains' => 0,
                'analytics' => false,
                'api_access' => false,
                'priority_support' => false,
                'is_active' => true,
                'sort_order' => 1,
                'features' => [
                    '10 links',
                    'Basic analytics',
                    'QR codes',
                ],
            ],
            [
                'name' => 'Pro',
                'slug' => 'pro',
                'price' => 9.99,
                'interval' => 'month',
                'max_links' => null, // unlimited
                'max_clicks_per_link' => null,
                'max_custom_domains' => 3,
                'analytics' => true,
                'api_access' => true,
                'priority_support' => false,
                'is_active' => true,
                'sort_order' => 2,
                'features' => [
                    'Unlimited links',
                    'Advanced analytics',
                    '3 custom domains',
                    'API access',
                    'QR codes',
                ],
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'price' => 29.99,
                'interval' => 'month',
                'max_links' => null,
                'max_clicks_per_link' => null,
                'max_custom_domains' => 10,
                'analytics' => true,
                'api_access' => true,
                'priority_support' => true,
                'is_active' => true,
                'sort_order' => 3,
                'features' => [
                    'Unlimited links',
                    'Advanced analytics',
                    '10 custom domains',
                    'API access',
                    'Priority support',
                    'Team management',
                    'SLA guarantee',
                ],
            ],
        ];

        foreach ($plans as $plan) {
            Plan::updateOrCreate(
                ['slug' => $plan['slug']],
                $plan
            );
        }
    }
}
