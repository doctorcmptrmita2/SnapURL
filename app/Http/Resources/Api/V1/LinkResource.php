<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'destination_url' => $this->destination_url,
            'short_url' => $this->short_url,
            'title' => $this->title,
            'description' => $this->description,
            'expires_at' => $this->expires_at?->toIso8601String(),
            'max_clicks' => $this->max_clicks,
            'click_count' => $this->click_count,
            'unique_click_count' => $this->unique_click_count,
            'status' => $this->status,
            'has_password' => !empty($this->password),
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
        ];
    }
}

