<?php

namespace App\Repositories;

use App\Models\Link;
use App\Repositories\Interfaces\LinkRepositoryInterface;
use Carbon\Carbon;

class LinkRepository implements LinkRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function createLink(int $userId, string $token, int $lifetime = 7): Link
    {
        return Link::firstOrCreate(
            ['user_id' => $userId],
            [
                'token' => $token,
                'expires_at' => Carbon::now()->addDays($lifetime)->toDateTimeString(),
                'user_id' => $userId,
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function deactivateLink(string $token): void
    {
        $link = $this->findByToken($token);
        $link->delete();
    }

    /**
     * @inheritdoc
     */
    public function findByToken(string $token): ?Link
    {
        return Link::where('token', $token)->first();
    }
}
