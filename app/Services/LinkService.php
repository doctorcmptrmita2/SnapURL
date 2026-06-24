<?php

namespace App\Services;

use App\Models\Link;
use App\Repositories\LinkRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LinkService
{
    public function __construct(
        private LinkRepositoryInterface $linkRepository
    ) {
    }

    /**
     * Create a new link.
     */
    public function createLink(array $data, ?int $userId = null): Link
    {
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Link::generateSlug();
        } else {
            // Check if slug already exists
            if ($this->linkRepository->findBySlug($data['slug'])) {
                throw new \Exception('Slug already exists');
            }
        }

        // Hash password if provided
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Set user ID
        $data['user_id'] = $userId;

        // Set default status
        $data['status'] = $data['status'] ?? 'active';

        return $this->linkRepository->create($data);
    }

    /**
     * Update a link.
     */
    public function updateLink(Link $link, array $data): Link
    {
        // Hash password if provided
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Check slug uniqueness if changed
        if (isset($data['slug']) && $data['slug'] !== $link->slug) {
            if ($this->linkRepository->findBySlug($data['slug'])) {
                throw new \Exception('Slug already exists');
            }
        }

        return $this->linkRepository->update($link, $data);
    }

    /**
     * Delete a link.
     */
    public function deleteLink(Link $link): bool
    {
        return $this->linkRepository->delete($link);
    }

    /**
     * Get link by slug for redirect.
     */
    public function getLinkForRedirect(string $slug): ?Link
    {
        $link = $this->linkRepository->findBySlug($slug);

        if (!$link) {
            return null;
        }

        // Check if link is expired
        if ($link->isExpired()) {
            $link->update(['status' => 'expired']);
            return null;
        }

        // Check if link is paused
        if ($link->status !== 'active') {
            return null;
        }

        return $link;
    }

    /**
     * Increment click count.
     */
    public function incrementClickCount(Link $link): void
    {
        $this->linkRepository->incrementClickCount($link);
    }

    /**
     * Get user links.
     */
    public function getUserLinks(int $userId, int $perPage = 15)
    {
        return $this->linkRepository->findByUser($userId, $perPage);
    }
}

