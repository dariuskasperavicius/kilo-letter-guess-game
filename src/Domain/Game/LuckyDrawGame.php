<?php

declare(strict_types=1);

namespace App\Domain\Game;

use App\Domain\Player\PlayerInterface;
use JetBrains\PhpStorm\Pure;

class LuckyDrawGame implements GameInterface
{
    private array $players = [];
    private ?State $state;
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

    #[Pure] public function isFinished(): bool
    {
        return $this->state->isFinished();
    }

    public function getWinner(): ?string
    {
        return $this->winner;
    }

    private function setWinner(string $winner): void
    {
        $this->winner = $winner;
    }
}