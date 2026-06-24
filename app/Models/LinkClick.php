<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LinkClick extends Model
{
    protected $fillable = [
        'link_id',
        'ip_hash',
        'user_agent_hash',
        'country',
        'city',
        'referrer',
        'device_type',
        'browser',
        'os',
        'clicked_at',
    ];

    protected function casts(): array
    {
        return [
            'clicked_at' => 'datetime',
        ];
    }

    /**
     * Get the link that owns the click.
     */
    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class);
    }
}
