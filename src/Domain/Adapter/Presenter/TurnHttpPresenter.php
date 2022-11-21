<?php

declare(strict_types=1);

namespace App\Domain\Adapter\Presenter;

use App\Domain\Adapter\ViewModel\HttpResourceViewModel;
use App\Domain\Exception\LetterExistsException;
use App\Domain\Interfaces\ViewModelInterface;
use App\Domain\UseCase\Turn\TurnOutputPortInterface;
use App\Domain\UseCase\Turn\TurnResponseModel;
use Symfony\Component\HttpFoundation\Response;

class TurnHttpPresenter implements TurnOutputPortInterface
{
    public function turnWasMade(TurnResponseModel $model): ViewModelInterface
    {
        return new HttpResourceViewModel(new Response($model->getState()->getMaskedWord()));
    }

    public function letterExists(LetterExistsException $exception): ViewModelInterface
    {
        return new HttpResourceViewModel(new Response($exception->getMessage()));
    }
}
