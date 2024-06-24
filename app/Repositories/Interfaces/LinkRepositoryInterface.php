<?php

namespace App\Repositories\Interfaces;

use App\Models\Link;

interface LinkRepositoryInterface
{
    /**
     * @param int $userId
     * @param string $token
     * @param int $lifetime
     * @return Link
     */
    public function createLink(int $userId, string $token, int $lifetime = 7): Link;

    /**
     * @param string $token
     * @return void
     */
    public function deactivateLink(string $token): void;

    /**
     * @param string $token
     * @return Link|null
     */
    public function findByToken(string $token): ?Link;
}
