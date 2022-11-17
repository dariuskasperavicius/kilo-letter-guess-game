<?php

declare(strict_types=1);

namespace App\Tests\Unit\Game;

use App\Game\LuckyDrawGame;
use PHPUnit\Framework\TestCase;

class LuckyDrawGameTest extends TestCase
{
    public function testEmptyRound()
    {
        $game = new LuckyDrawGame();
        $game->makeTurn();
        $this->assertFalse($game->isFinished());
    }
}
