<?php

namespace App\Command;

use App\Repository\StarshipRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:ship:remove',
    description: 'Delete a starship',
)]
class ShipRemoveCommand extends Command
{
    public function __construct(
        private StarshipRepository     $starshipRepository,
        private EntityManagerInterface $em,
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('slug', InputArgument::REQUIRED, 'The starship slug');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $slug = $input->getArgument('slug');
        $ship = $this->starshipRepository->findOneBy([
            'slug' => $slug,
        ]);

        if (!$ship) {
            $io->error("Starship not found");
            return Command::FAILURE;
        }

        $io->comment("Removing starship {$ship->getName()}");

        $this->em->remove($ship);
        $this->em->flush();

        $io->success("Starship removed {$ship->getName()}");

        return Command::SUCCESS;
    }
}
