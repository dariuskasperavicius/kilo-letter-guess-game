<?php

declare(strict_types=1);

namespace App\Controller;

use App\Game\GameInterface;
use App\Game\GameProducer;
use App\Player\PlayerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    private GameInterface $game;

    public function __construct(private GameProducer $gameEngine)
    {
        $this->game = $gameEngine->produce();
    }

    #[Route('/turn', name: 'game_turn')]
    public function makeTurn(Request $request): JsonResponse
    {
        $playerName = $request->get('name');

        $this->game->addPlayer(
            function () use ($request) {
                return $request->get('letter');
            },
            $playerName ?? PlayerInterface::PLAYER_HTTP_NAME
        );

        $state = $this->game->makeTurn();
        $this->gameEngine->store($state);

        return new JsonResponse($state);
    }
}
