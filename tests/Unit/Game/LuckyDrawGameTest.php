<?php

declare(strict_types=1);

namespace App\Tests\Unit\Game;

use App\Domain\Game\LuckyDrawGame;
use App\Domain\Game\State;
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
        $game->addPlayer(new FakePlayer(), 'fake');
        $state = $game->makeTurn();
        $this->assertSame(['h', '_'], $state->getMaskedArray());
    }

    public function testGameIsFinished(): void
    {
        $game = new LuckyDrawGame(State::fromWord('h'));
        $game->addPlayer(
            function() {
                return 'h';
            },
            'hi'
        );
        $state = $game->makeTurn();
        $this->assertTrue($state->isFinished());
    }


    public function testTwoPlayerGame(): void
    {
        $game = new LuckyDrawGame(State::fromWord('hi'));
        $game->addPlayer(
            function() {
                return 'h';
            },
            'foo'
        );

        $game->addPlayer(
            function() {
                return 'i';
            },
            'boo'
        );

        $state = $game->makeTurn();
        $this->assertTrue($state->isFinished());
    }

    public function testGameEndsAfterSecondGuess(): void
    {
        $game = new LuckyDrawGame(State::fromWord('hi'));
        $game->addPlayer(
            function() {
                return 'h';
            },
            'first'
        );

        $game->addPlayer(
            function() {
                return 'i';
            },
            'second'
        );

        $game->addPlayer(
            function() {
                return 'x';
            },
            'third'
        );

        $game->makeTurn();
        $this->assertSame('second', $game->getWinner());
    }

}
