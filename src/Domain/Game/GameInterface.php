<?php

namespace App\Domain\Game;

use App\Domain\Player\PlayerInterface;

interface GameInterface
{
    public function addPlayer(PlayerInterface|callable $player, $nick): void;

    public function makeTurn(): State;

    public function isFinished(): bool;

    public function getWinner(): ?string;
}