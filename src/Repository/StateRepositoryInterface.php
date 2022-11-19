<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\StateModel;

interface StateRepositoryInterface
{
    public function find(string $id): ?StateModel;

    public function save(StateModel $model);
}
