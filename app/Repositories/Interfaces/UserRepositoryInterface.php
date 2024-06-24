<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function findOrCreate($data): mixed;
}
