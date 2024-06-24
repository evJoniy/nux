<?php

namespace App\Services\Interfaces;

interface LuckyServiceInterface
{
    /**
     * @param string $token
     * @return array
     */
    public function getLucky(string $token): array;
}
