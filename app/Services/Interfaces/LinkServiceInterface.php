<?php

namespace App\Services\Interfaces;

use App\Models\Link;


interface LinkServiceInterface
{
    /**
     * @param string $userId
     * @return Link
     */
    public function findOrCreate(string $userId): Link;

    /**
     * @param string $token
     * @return Link
     */
    public function findByToken(string $token): Link;

    /**
     * @param string $token
     * @return Link
     */
    public function regenerate(string $token): Link;

    /**
     * @param string $token
     * @return void
     */
    public function deactivate(string $token): void;

    /**
     * @param string $token
     * @return bool
     */
    public function isLinkValid(string $token): bool;
}
