<?php

namespace App\Repositories\Interfaces;

use App\Models\History;
use App\Models\User;

interface HistoryRepositoryInterface
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
     * @param int $userId
     * @return mixed
     */
    public function getLatestRecords(int $userId): mixed;
}
