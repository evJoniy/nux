<?php

namespace App\Repositories;

use App\Models\History;
use App\Models\User;
use App\Repositories\Interfaces\HistoryRepositoryInterface;

class HistoryRepository implements HistoryRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function createNewRecord(User $user, int $num, string $result, float $winAmount): History
    {
        return History::create([
            'user_id' => $user->getId(),
            'number' => $num,
            'result' => $result,
            'win_amount' => $winAmount,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getLatestRecords(int $userId): mixed
    {
        return History::where('user_id', $userId)
            ->latest()
            ->take(3)
            ->get();
    }
}
