<?php

declare(strict_types=1);

namespace App\Game;

use App\Player\PlayerInterface;
use JetBrains\PhpStorm\Pure;

class LuckyDrawGame
{
    private array $players = [];
    private State $state;

    public function __construct(State $state = null)
    {
        $words = ['telemetry', 'base', 'cool', 'best', 'mama'];
        shuffle($words);
        $secret = $words[0];

        $this->state = $state ?? State::fromWord($secret);
    }

    public function addPlayer(PlayerInterface $player)
    {
        $this->players[] = $player;
    }

    public function makeTurn()
    {
        foreach ($this->players as $player) {

        }
    }

    #[Pure] public function isFinished(): bool
    {
        return $this->state->isFinished();
    }
}
