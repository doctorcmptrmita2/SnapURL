<?php

namespace App\Repositories;

use App\Models\Link;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class LinkRepository implements LinkRepositoryInterface
{
    public function findById(int $id): ?Link
    {
        return Link::find($id);
    }

    public function findBySlug(string $slug): ?Link
    {
        return Link::where('slug', $slug)->first();
    }

    public function findByUser(int $userId, int $perPage = 15): LengthAwarePaginator
    {
        return Link::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function create(array $data): Link
    {
        return Link::create($data);
    }

    public function update(Link $link, array $data): Link
    {
        $link->update($data);
        return $link->fresh();
    }

    public function delete(Link $link): bool
    {
        return $link->delete();
    }

    public function incrementClickCount(Link $link): void
    {
        $link->increment('click_count');
    }

    public function getExpiredLinks(): Collection
    {
        return Link::where('status', 'active')
            ->where(function ($query) {
                $query->whereNotNull('expires_at')
                    ->where('expires_at', '<=', now())
                    ->orWhere(function ($q) {
                        $q->whereNotNull('max_clicks')
                            ->whereColumn('click_count', '>=', 'max_clicks');
                    });
            })
            ->get();
    }
}

