<?php

declare(strict_types=1);

namespace App\Domain\Player;

use App\Domain\Game\State;
use Exception;

class DrunkPlayer implements PlayerInterface
{
    public function __invoke(State $state): string
    {
        static $previousLetter;

        do {
            $az = "abcdefghijklmnopqrstuvwxyz";
            try {
                $int = random_int(0, strlen($az) - 1);
            } catch (Exception) {
                $int = 0;
            }
            $letter = $az[$int];
        } while ($previousLetter === $letter);

        $previousLetter = $letter;

        return $letter;
    }
}
