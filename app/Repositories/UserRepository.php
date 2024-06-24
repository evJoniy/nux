<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\LinkServiceInterface;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        protected LinkServiceInterface $linkService
    ) {
    }

    /**
     * @inheritdoc
     */
    public function findOrCreate($data): mixed
    {
        return User::firstOrCreate(
            ['username' => $data['username']],
            [
                'mobile' => $data['mobile'],
            ]
        );
    }
}
