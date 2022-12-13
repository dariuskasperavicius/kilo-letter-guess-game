<?php

declare(strict_types=1);

namespace App\Command;

use App\Game\LuckyDrawGame;
use App\Service\PlayerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class AutoplayCommand extends Command
{
    private const CLI_PLAYER = 'cli';

    protected function configure()
    {
        $this->setName('game:autoplay');
        $this->addArgument('players', InputArgument::IS_ARRAY);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');

        $registry = new PlayerRegistry();
        $game = new LuckyDrawGame();
        $players = $input->getArgument('players');
        foreach ($players as $player) {
            if ($player === self::CLI_PLAYER) {
                $game->addPlayer(
                    static function () use ($input, $output, $helper) {
                        $question = new Question("Please enter your letter:\n");
                        return $helper->ask($input, $output, $question);
                    },
                    $player
                );
             } else {
                $game->addPlayer($registry->get($player), $player);
            }
        }

        $game->autoplay();
        $output->writeln(sprintf('Winner is %s', $game->getWinner()));

        return 0;
    }
}