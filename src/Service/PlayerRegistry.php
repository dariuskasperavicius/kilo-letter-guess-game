<?php

declare(strict_types=1);

namespace App\Service;

class PlayerRegistry
{
    public function __construct(private array $players)
    {
        $this->players = [

        ];
    }

    public function getAll()
    {
        return $this->players;
    }

    public function get(string $playerName)
    {
        return $this->players[$playerName];
    }
}
