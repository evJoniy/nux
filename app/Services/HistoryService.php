<?php

namespace App\Services;

use App\Models\History;
use App\Models\User;
use App\Repositories\Interfaces\HistoryRepositoryInterface;
use App\Services\Interfaces\HistoryServiceInterface;
use App\Services\Interfaces\LinkServiceInterface;
use App\Services\Interfaces\UserServiceInterface;

class HistoryService implements HistoryServiceInterface
{
    public function __construct(
        protected HistoryRepositoryInterface $historyRepository,
        protected LinkServiceInterface       $linkService,
        protected UserServiceInterface       $userService
    ) {
    }

    /**
     * @inheritdoc
     */
    public function createNewRecord(User $user, int $num, string $result, float $winAmount): History
    {
        if (is_numeric($result)) {
            $result = number_format($result, 2);
        }

        return $this->historyRepository->createNewRecord($user, $num, $result, $winAmount);
    }

    /**
     * @inheritdoc
     */
    public function getLatestRecords(string $token): mixed
    {
        return $this->historyRepository->getLatestRecords($this->userService->getUserByToken($token)->getId());
    }
}
