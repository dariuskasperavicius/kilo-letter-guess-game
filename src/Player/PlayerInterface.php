<?php

declare(strict_types=1);

namespace App\Player;

use App\Game\State;

interface PlayerInterface
{
    public const PLAYER_HTTP_NAME = 'Online player';

    public function __invoke(State $state): string;
}
