<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Game\State;
use App\Player\PlayerInterface;

class FakePlayer implements PlayerInterface
{
    public function guessLetter(State $state): string
    {
        return 'h';
    }
}
