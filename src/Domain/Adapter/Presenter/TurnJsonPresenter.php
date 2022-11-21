<?php

declare(strict_types=1);

namespace App\Domain\Adapter\Presenter;

use App\Domain\Adapter\ViewModel\JsonResourceViewModel;
use App\Domain\Exception\LetterExistsException;
use App\Domain\Interfaces\ViewModelInterface;
use App\Domain\UseCase\Turn\TurnOutputPortInterface;
use App\Domain\UseCase\Turn\TurnResponseModel;
use Symfony\Component\HttpFoundation\JsonResponse;

class TurnJsonPresenter implements TurnOutputPortInterface
{
    public function turnWasMade(TurnResponseModel $model): ViewModelInterface
    {
        return new JsonResourceViewModel(new JsonResponse($model->getState()));
    }

    public function letterExists(LetterExistsException $exception): ViewModelInterface
    {
        return new JsonResourceViewModel(new JsonResponse(['error' => sprintf('Letter %s exists', $exception->getLetter())]));
    }
}
