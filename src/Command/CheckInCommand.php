<?php

namespace App\Command;

use App\Entity\StarshipStatusEnum;
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
    name: 'app:ship:check-in',
    description: 'Check and update starship ',
)]
class CheckInCommand extends Command
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

        $io->comment("Checking in starship {$ship->getName()}");
        $ship->checkIn();

        $this->em->flush();
        $io->success("Starship checked in {$ship->getName()} ");
        return Command::SUCCESS;
    }
}
