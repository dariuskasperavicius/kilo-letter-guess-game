<?php

declare(strict_types=1);

namespace App\Player;

use App\Game\State;

class SoberPlayer implements PlayerInterface
{
    public function __invoke(State $state): string
    {
        static $previousLetter;
        $guessedLetters = $state->getMaskedWord();

        do {
            $az = "abcdefghijklmnopqrstuvwxyz";
            $int = random_int(0, strlen($az) - 1);
            $letter = $az[$int];
        } while ($previousLetter === $letter && in_array($letter, $guessedLetters, true));

        $previousLetter = $letter;

        return $letter;
    }
}
