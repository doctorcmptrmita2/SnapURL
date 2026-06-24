<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Link extends Model
{
    protected $fillable = [
        'user_id',
        'slug',
        'destination_url',
        'title',
        'description',
        'password',
        'expires_at',
        'max_clicks',
        'click_count',
        'unique_click_count',
        'status',
        'custom_domain',
        'is_public',
        'ip_hash',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'is_public' => 'boolean',
        ];
    }

    /**
     * Get the user that owns the link.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the clicks for the link.
     */
    public function clicks(): HasMany
    {
        return $this->hasMany(LinkClick::class);
    }

    /**
     * Get the analytics for the link.
     */
    public function analytics(): HasMany
    {
        return $this->hasMany(LinkAnalytic::class);
    }

    /**
     * Generate a unique slug.
     */
    public static function generateSlug(int $length = 6): string
    {
        do {
            $slug = Str::random($length);
        } while (self::where('slug', $slug)->exists());

        return $slug;
    }

    /**
     * Check if link is expired.
     */
    public function isExpired(): bool
    {
        if ($this->expires_at && $this->expires_at->isPast()) {
            return true;
        }

        if ($this->max_clicks && $this->click_count >= $this->max_clicks) {
            return true;
        }

        return false;
    }

    /**
     * Get the full short URL.
     */
    public function getShortUrlAttribute(): string
    {
        $domain = $this->custom_domain ?? config('app.url');
        return rtrim($domain, '/') . '/' . $this->slug;
    }
}
