<?php

declare(strict_types=1);

namespace App\Game;

use App\Model\StateModel;
use App\Repository\StateRepositoryInterface;

final class GameProducer
{
    public function __construct(private StateRepositoryInterface $repository)
    {
    }

    public function produce(): GameInterface
    {
        $state = $this->repository->find('lucky_draw');
        if ($state !== null) {
            return new LuckyDrawGame(State::fromModel($state));
        }

        return new LuckyDrawGame();
    }

    public function store(State $state)
    {
        return $this->repository->save(new StateModel($state->dump()));
    }
}
