<?php

declare(strict_types=1);

namespace App\Tests\Unit\Game;

use App\Game\LuckyDrawGame;
use App\Game\State;
use App\Tests\Unit\FakePlayer;
use PHPUnit\Framework\TestCase;

class LuckyDrawGameTest extends TestCase
{
    public function testEmptyRound(): void
    {
        $game = new LuckyDrawGame();
        $game->makeTurn();
        $this->assertFalse($game->isFinished());
    }

    public function testLetterGuessSuccessfull(): void
    {
        $game = new LuckyDrawGame(State::fromWord('hi'));
        $game->addPlayer(new FakePlayer());
        $state = $game->makeTurn();
        $this->assertSame(['h', '_'], $state->getMaskedWord());
    }

    public function testGameIsFinished(): void
    {
        $game = new LuckyDrawGame(State::fromWord('h'));
        $game->addPlayer(new FakePlayer());
        $state = $game->makeTurn();
        $this->assertTrue($state->isFinished());
    }
}
