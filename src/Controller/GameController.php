<?php

declare(strict_types=1);

namespace App\Controller;

use App\Game\LuckyDrawGame;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{


    public function __construct(private LuckyDrawGame $game)
    {
    }

    #[Route('/turn', name: 'game_turn')]
    public function makeTurn(Request $request)
    {
        $this->game->addPlayer(
            function () use ($request) {
                return $request->get('letter');
            },
            'Online'
        );

        $state = $this->game->makeTurn();
        return new JsonResponse($state);
    }
}
