<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Infrastructure\Model\StateModel;

interface StateRepositoryInterface
{
    public function find(string $id): ?StateModel;

    public function save(StateModel $model);
}
