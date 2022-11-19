<?php

declare(strict_types=1);

namespace App\Domain\Game;

use App\Infrastructure\Model\StateModel;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use JsonSerializable;

class State implements JsonSerializable
{
    private const MASKED_SYMBOL = '_';

    #[Pure]
    public static function fromModel(StateModel $model): State
    {
        return new self(
            str_split($model->getSecret()),
            str_split($model->getMasked())
        );
    }

    #[Pure]
    public static function fromWord(string $word): State
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
        foreach ($this->secretArray as $secretLetter) {
            if ($secretLetter === $letter) {
                $this->masked_array[$i] = $letter;
            }
            $i++;
        }
    }

    #[Pure]
    private function getMaskedWord(string $separator = ''): string
    {
        return implode($separator, $this->getMaskedArray());
    }

    public function getMaskedArray(): array
    {
        return $this->masked_array;
    }

    #[Pure] public function isFinished(): bool
    {
        return $this->getMaskedArray() === $this->getSecretArray();
    }

    private function __construct(
        private array $secretArray,
        private array $masked_array = []
    )
    {
    }

    private function getSecretArray(): array
    {
        return $this->secretArray;
    }

    private function getSecretWord(): string
    {
        return implode(' ', $this->getSecretArray());
    }

    #[ArrayShape(['masked_word' => "string"])]
    public function jsonSerialize(): array
    {
        return [
            'masked_word' => $this->getMaskedWord(' ')
        ];
    }

    #[ArrayShape(['masked' => "string", 'secret' => "string"])]
    public function dump(): array
    {
        return [
            'masked' => $this->getMaskedWord(),
            'secret' => $this->getSecretWord()
        ];
    }
}
