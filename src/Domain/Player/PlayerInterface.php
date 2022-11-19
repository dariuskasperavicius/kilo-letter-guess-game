<?php

declare(strict_types=1);

namespace App\Domain\Player;

use App\Domain\Game\State;

interface PlayerInterface
{
    public function __invoke(State $state): string;
}
