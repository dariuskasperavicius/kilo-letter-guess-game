<?php

declare(strict_types=1);

namespace App\Command;

use App\Game\LuckyDrawGame;
use App\Service\PlayerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AutoplayCommand extends Command
{
    protected function configure()
    {
        $this->setName('game:autoplay');
        $this->addArgument('players', InputArgument::IS_ARRAY);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $registry = new PlayerRegistry();
        $game = new LuckyDrawGame();
        $players = $input->getArgument('players');
        foreach ($players as $player) {
            $game->addPlayer($registry->get($player), $player);
        }

        $game->autoplay();
        $output->writeln(sprintf('Winner is %s', $game->getWinner()));

        return 0;
    }
}
