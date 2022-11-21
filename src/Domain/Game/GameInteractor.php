<?php

declare(strict_types=1);

namespace App\Domain\Game;

use App\Domain\Exception\LetterExistsException;
use App\Domain\Interfaces\ViewModelInterface;
use App\Domain\UseCase\Turn\TurnOutputPortInterface;
use App\Domain\UseCase\Turn\TurnRequestModel;
use App\Domain\UseCase\Turn\TurnResponseModel;
use App\Infrastructure\Model\StateModel;
use App\Infrastructure\Repository\StateRepositoryInterface;

final class GameInteractor
{
    public function __construct(private TurnOutputPortInterface $output, private StateRepositoryInterface $repository)
    {
    }

    public function turn(TurnRequestModel $requestModel): ViewModelInterface
    {
        $game = $this->produce();
        try {
            if ($requestModel->hasLetter()) {
                $game->addPlayer(function () use ($requestModel) {
                    return $requestModel->getLetter();
                },
                    'clean_player'
                );
            }
            $state = $game->makeTurn();
        } catch (LetterExistsException $exception) {
            return $this->output->letterExists($exception);
        }
        $this->store($state);
        return $this->output->turnWasMade(new TurnResponseModel($state));
    }

    public function produce(): GameInterface
    {
        $state = $this->repository->find('lucky_draw');
        if ($state !== null) {
            return new LuckyDrawGame(State::fromModel($state));
        }

        return new LuckyDrawGame();
    }

    public function store(State $state)
    {
        return $this->repository->save(new StateModel($state->dump()));
    }
}
