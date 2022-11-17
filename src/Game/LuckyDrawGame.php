<?php

declare(strict_types=1);

namespace App\Game;

use App\Player\PlayerInterface;

class LuckyDrawGame
{
    private array $players;
    private ?State $state = null;

    public function __construct(State $state = null)
    {
        $this->state = $state ?? new State();
    }


    public function addPlayer(PlayerInterface $player)
    {
        $this->players[] = $player;
    }

    public function makeTurn()
    {

    }

    public function isFinished()
    {
        
    }
}
