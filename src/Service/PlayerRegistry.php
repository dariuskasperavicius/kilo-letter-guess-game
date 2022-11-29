<?php

declare(strict_types=1);

namespace App\Service;

use App\Player\DrunkPlayer;
use App\Player\PlayerInterface;
use App\Player\SoberPlayer;

class PlayerRegistry
{
    public function __construct(private array $players = [])
    {
        $this->players = [
            'drunk' => new DrunkPlayer(),
            'sober' => new SoberPlayer()
        ];
    }

    public function getAll(): array
    {
        return $this->players;
    }

    public function get(string $playerName): PlayerInterface
    {
        return $this->players[$playerName];
    }
}
