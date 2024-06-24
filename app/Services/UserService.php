<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\LinkServiceInterface;
use App\Services\Interfaces\UserServiceInterface;

class UserService implements UserServiceInterface
{
    public function __construct(
        protected LinkServiceInterface $linkService,
        protected UserRepositoryInterface $userRepository
    ) {
    }

    /**
     * @inheritdoc
     */
    public function findOrCreate(array $data): User
    {
        return $this->userRepository->findOrCreate($data);
    }

    /**
     * @inheritdoc
     */
    public function getUserByToken(string $token): User
    {
        return $this->linkService->findByToken($token)->belongsToUser;
    }
}
