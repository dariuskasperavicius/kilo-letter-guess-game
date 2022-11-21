<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Turn;

use App\Domain\Game\State;

class TurnResponseModel
{
    public function __construct(private State $state)
    {
    }

    public function getState(): State
    {
        return $this->state;
    }
}
