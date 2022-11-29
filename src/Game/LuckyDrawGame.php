<?php

declare(strict_types=1);

namespace App\Game;

use App\Player\PlayerInterface;
use JetBrains\PhpStorm\Pure;

class LuckyDrawGame
{
    private array $players = [];
    private State $state;
    private ?string $winner = null;

    public function __construct(State $state = null)
    {
        $words = ['telemetry', 'base', 'cool', 'best', 'mama'];
        shuffle($words);
        $secret = $words[0];

        $this->state = $state ?? State::fromWord($secret);
    }

    public function addPlayer(PlayerInterface|callable $player, $nick): void
    {
        $this->players[$nick] = $player;
    }

    public function makeTurn(): State
    {
        /** @var PlayerInterface|callable $player */
        foreach ($this->players as $nickName => $player) {
            $this->state->addLetter($player($this->state));
            if ($this->state->isFinished()) {
                $this->setWinner($nickName);
                break;
            }
        }
        return $this->state;
    }

    public function autoplay(): void
    {
        do {
            $this->makeTurn();
        } while ($this->getWinner() === null);
    }
    
    #[Pure] public function isFinished(): bool
    {
        return $this->state->isFinished();
    }

    public function getWinner(): ?string
    {
        return $this->winner;
    }

    public function setWinner(?string $winner): LuckyDrawGame
    {
        $this->winner = $winner;
        return $this;
    }
}
