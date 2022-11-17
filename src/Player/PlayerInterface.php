<?php

declare(strict_types=1);

namespace App\Player;

use App\Game\State;

interface PlayerInterface
{
    public function __invoke(State $state): string;
}
