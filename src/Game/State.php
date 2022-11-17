<?php

declare(strict_types=1);

namespace App\Game;

class State
{
    public function __construct(
        private array $secret,
        private array $masked_word
    )
    {
    }


}
