<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LinkAnalytic extends Model
{
    protected $fillable = [
        'link_id',
        'date',
        'clicks',
        'unique_clicks',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    /**
     * Get the link that owns the analytic.
     */
    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class);
    }
}
