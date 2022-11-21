<?php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\Game\GameInterface;
use App\Domain\Game\GameInteractor;
use App\Domain\UseCase\Turn\TurnRequestModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    private GameInterface $game;

    public function __construct(private GameInteractor $interactor)
    {
    }

    #[Route('/turn', name: 'game_turn')]
    public function makeTurn(Request $request): JsonResponse
    {

        $viewModel = $this->interactor->turn(
            new TurnRequestModel($request)
        );

        return $viewModel->getResponse();

        $this->game->addPlayer(
            function () use ($request) {
                return $request->get('letter');
            },
            'Online'
        );

        $state = $this->game->makeTurn();
        $this->interactor->store($state);

        return new JsonResponse($state);
    }
}
