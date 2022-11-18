<?php

declare(strict_types=1);

namespace App\Game;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use JsonSerializable;

class State implements JsonSerializable
{
    private const MASKED_SYMBOL = '_';

    #[Pure] public static function fromWord(string $word): State
    {
        $secret = str_split($word);

        return new self(
            $secret,
            array_fill(0, count($secret), self::MASKED_SYMBOL)
        );
    }

    public function addLetter(string $letter): void
    {
        $i = 0;
        foreach ($this->secret as $secretLetter) {
            if ($secretLetter === $letter) {
                $this->masked_array[$i] = $letter;
            }
            $i++;
        }
    }

    #[Pure]
    private function getMaskedWord(): string
    {
        return implode(' ', $this->getMaskedArray());
    }

    public function getMaskedArray(): array
    {
        return $this->masked_array;
    }

    #[Pure] public function isFinished(): bool
    {
        return $this->getMaskedArray() === $this->getSecret();
    }

    private function __construct(
        private array $secret,
        private array $masked_array = []
    )
    {
    }

    private function getSecret(): array
    {
        return $this->secret;
    }

    #[Pure]
    #[ArrayShape(['masked_word' => "string"])]
    public function jsonSerialize(): array
    {
        return [
            'masked_word' => $this->getMaskedWord()
        ];
    }
}
