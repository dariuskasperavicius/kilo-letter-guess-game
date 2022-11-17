<?php

namespace App\Tests\Unit\Player;

use App\Game\State;
use App\Player\DrunkPlayer;
use PHPUnit\Framework\TestCase;

class DrunkPlayerTest extends TestCase
{
    public function testIsLetter()
    {
        $state = $this->createMock(State::class);
        $player = new DrunkPlayer();
        $letter = $player->guessLetter($state);
        $this->assertIsString($letter);
        $this->assertSame(strlen($letter), 1);
    }
}
