<?php

namespace App\Services\Interfaces;

use App\Models\History;
use App\Models\User;

interface HistoryServiceInterface
{
    /**
     * @param User $user
     * @param int $num
     * @param string $result
     * @param float $winAmount
     * @return History
     */
    public function createNewRecord(User $user, int $num, string $result, float $winAmount): History;

    /**
     * @param string $token
     * @return mixed
     */
    public function getLatestRecords(string $token): mixed;
}
