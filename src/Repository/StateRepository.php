<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\StateModel;
use App\Repository\StorageAdapter\StorageAdapterInterface;

class StateRepository implements StateRepositoryInterface
{
    private const GAME_ID = 'lucky_draw';

    public function __construct(private StorageAdapterInterface $storage)
    {
    }

    public function find(string $id): ?StateModel
    {
        $data = $this->storage->get(self::GAME_ID);
        return $data ? new StateModel($data) : null;
    }

    public function save(StateModel $model): void
    {
        $this->storage->save(self::GAME_ID, $model->jsonSerialize());
    }
}
