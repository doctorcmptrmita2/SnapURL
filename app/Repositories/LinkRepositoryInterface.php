<?php

namespace App\Repositories;

use App\Models\Link;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface LinkRepositoryInterface
{
    public function findById(int $id): ?Link;

    public function findBySlug(string $slug): ?Link;

    public function findByUser(int $userId, int $perPage = 15): LengthAwarePaginator;

    public function create(array $data): Link;

    public function update(Link $link, array $data): Link;

    public function delete(Link $link): bool;

    public function incrementClickCount(Link $link): void;

    public function getExpiredLinks(): Collection;
}

