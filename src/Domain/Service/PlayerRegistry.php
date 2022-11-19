<?php

declare(strict_types=1);

namespace App\Domain\Service;

use App\Domain\Player\PlayerInterface;

class PlayerRegistry
{
    public function __construct(private array $players)
    {
        $this->players = [

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
