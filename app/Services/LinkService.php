<?php

namespace App\Services;

use App\Models\Link;
use App\Repositories\Interfaces\LinkRepositoryInterface;
use App\Services\Interfaces\LinkServiceInterface;
use Illuminate\Support\Str;

class LinkService implements LinkServiceInterface
{
    public function __construct(
        protected LinkRepositoryInterface $linkRepository
    ) {
    }

    /**
     * @inheritdoc
     */
    public function findOrCreate(string $userId): Link
    {
        return $this->linkRepository->createLink($userId, $this->generateUniqueLink());
    }

    /**
     * @inheritdoc
     */
    public function findByToken(string $token): Link
    {
        return $this->linkRepository->findByToken($token);
    }

    /**
     * @inheritdoc
     */
    public function regenerate(string $token): Link
    {
        $link = $this->linkRepository->findByToken($token);
        $this->deactivate($token);

        return $this->linkRepository->createLink($link->belongsToUser->getId(), $this->generateUniqueLink());
    }

    /**
     * @inheritdoc
     */
    public function deactivate(string $token): void
    {
        $this->linkRepository->deactivateLink($token);
    }

    /**
     * @inheritdoc
     */
    public function isLinkValid(string $token): bool
    {
        $link = $this->linkRepository->findByToken($token);

        if (!$link) {
            return false;
        }

        return !$link->getExpiresAt()->isPast() && !$link->getDeletedAt();
    }

    /**
     * Generate unique short url of 8 symbols in 5 tries, fallback to 10 symbols
     *
     * @param int $retryLimit
     * @return string
     */
    private function generateUniqueLink(int $retryLimit = 5): string
    {
        for ($i = 0; $i < $retryLimit; $i++) {
            $shortenedUrl = Str::random(8);
            if (!$this->linkRepository->findByToken($shortenedUrl)) {
                return $shortenedUrl;
            }
        }

        return Str::random(10); // Fallback strategy
    }
}
