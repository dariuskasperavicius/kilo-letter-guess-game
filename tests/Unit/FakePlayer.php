<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Domain\Game\State;
use App\Domain\Player\PlayerInterface;

class FakePlayer implements PlayerInterface
{
    public function __invoke(State $state): string
    {
        return 'h';
    }
}
