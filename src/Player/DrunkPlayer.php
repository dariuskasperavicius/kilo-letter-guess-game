<?php

declare(strict_types=1);

namespace App\Player;

use App\Game\State;

class DrunkPlayer implements PlayerInterface
{
    public function __invoke(State $state): string
    {
        static $previousLetter;

        do {
            $az = "abcdefghijklmnopqrstuvwxyz";
            $int = random_int(0, strlen($az) - 1);
            $letter = $az[$int];
        } while ($previousLetter === $letter);

        $previousLetter = $letter;

        return $letter;
    }
}
