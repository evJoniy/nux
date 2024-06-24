<?php

namespace App\Services\Interfaces;

use App\Models\User;

interface UserServiceInterface
{
    /**
     * @param array $data
     * @return User
     */
    public function findOrCreate(array $data): User;

    /**
     * @param string $token
     * @return User
     */
    public function getUserByToken(string $token): User;
}
