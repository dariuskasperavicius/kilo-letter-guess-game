<?php

declare(strict_types=1);

namespace App\Service;

use App\Player\DrunkPlayer;
use App\Player\PlayerInterface;

class PlayerRegistry
{
    public function __construct(private array $players = [])
    {
        $this->players = [
            'drunk' => new DrunkPlayer()
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
