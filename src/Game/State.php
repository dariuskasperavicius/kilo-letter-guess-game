<?php

declare(strict_types=1);

namespace App\Game;

use JetBrains\PhpStorm\Pure;

class State
{
    private const MASKED_SYMBOL = '_';

    public function __construct(
        private array $secret,
        private array $masked_word = []
    )
    {
    }

    #[Pure] public static function fromWord(string $word): State
    {
        $secret = str_split($word);

        return new self(
            $secret,
            array_fill(0, count($secret), self::MASKED_SYMBOL)
        );
    }

    public function getMaskedWord(): array
    {
        return $this->masked_word;
    }

    public function isFinished(): bool
    {
        return $this->getMaskedWord() === $this->getSecret();
    }

    private function getSecret(): array
    {
        return $this->secret;
    }
}
