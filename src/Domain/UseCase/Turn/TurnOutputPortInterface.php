<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Turn;

use App\Domain\Exception\LetterExistsException;
use App\Domain\Interfaces\ViewModelInterface;

interface TurnOutputPortInterface
{
    public function turnWasMade(TurnResponseModel $model): ViewModelInterface;

    public function letterExists(LetterExistsException $exception): ViewModelInterface;
}
