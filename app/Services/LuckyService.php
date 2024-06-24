<?php

namespace App\Services;

use App\Services\Interfaces\HistoryServiceInterface;
use App\Services\Interfaces\LuckyServiceInterface;
use App\Services\Interfaces\UserServiceInterface;

class LuckyService implements LuckyServiceInterface
{
    public function __construct(
        protected HistoryServiceInterface $historyService,
        protected UserServiceInterface $userService
    ) {
    }

    /**
     * @inheritdoc
     */
    public function getLucky(string $token): array
    {
        $num = rand(1, 1000);
        $result = $num % 2 === 0 ? 'Win' : 'Lose';

        $winAmount = match (true) {
            $result === 'Lose' => 0,
            $num > 900 => $num * 0.7,
            $num > 600 => $num * 0.5,
            $num > 300 => $num * 0.3,
            default => $num * 0.1,
        };

        $user = $this->userService->getUserByToken($token);
        $record = $this->historyService->createNewRecord($user, $num, $result, $winAmount);

        return [
            'number' => $record->getNumber(),
            'result' => $record->getResult(),
            'win_amount' => $record->getWinAmount(),
        ];
    }
}
