<?php

declare(strict_types=1);

namespace App\Player;

use App\Game\State;

class DrunkPlayer implements PlayerInterface
{
    public function guessLetter(State $state): string
    {
        return 'a';
    }
}
