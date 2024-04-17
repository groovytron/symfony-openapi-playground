<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/** @phan-suppress PhanUnreferencedClass */
#[AsCommand(name: 'app:create-user')]
class CreateUserCommand extends Command
{
    public function __construct(private EntityManagerInterface $entityManager, private UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeLn('User sucessfully created.');

        $user = new User();

        $user->setUsername($input->getArgument('username'));
        $user->setPassword($this->passwordHasher->hashPassword($user, $input->getArgument('password')));
        $user->setRoles(['ROLE_ADMIN']);

        $this->entityManager->persist($user);

        $this->entityManager->flush();

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this
            // the command description shown when running "php bin/console list"
            ->setDescription('Creates a new admin user.')
            // the command help shown when running the command with the "--help" option
            ->setHelp('This command allows you to create a user...')
            ->addArgument('username', InputArgument::REQUIRED, 'User\'s name ')
            ->addArgument('password', InputArgument::REQUIRED, 'User password')
        ;
    }
}
