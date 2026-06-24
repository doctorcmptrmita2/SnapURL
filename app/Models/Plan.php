<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'stripe_price_id',
        'price',
        'interval',
        'max_links',
        'max_clicks_per_link',
        'max_custom_domains',
        'analytics',
        'api_access',
        'priority_support',
        'is_active',
        'sort_order',
        'features',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'analytics' => 'boolean',
            'api_access' => 'boolean',
            'priority_support' => 'boolean',
            'is_active' => 'boolean',
            'features' => 'array',
        ];
    }

    /**
     * Get the users for the plan.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the subscriptions for the plan.
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Check if plan has unlimited links.
     */
    public function hasUnlimitedLinks(): bool
    {
        return $this->max_links === null;
    }
}
