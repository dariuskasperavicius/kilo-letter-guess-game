<?php

namespace App\Tests\Unit\Player;

use App\Domain\Game\State;
use App\Domain\Player\DrunkPlayer;
use PHPUnit\Framework\TestCase;

class DrunkPlayerTest extends TestCase
{
    public function testIsLetter()
    {
        $state = $this->createMock(State::class);
        $player = new DrunkPlayer();
        $letter = $player->__invoke($state);
        $this->assertIsString($letter);
        $this->assertSame(strlen($letter), 1);

        $letter2 = $player->__invoke($state);
        $this->assertNotSame($letter, $letter2);
    }
}
