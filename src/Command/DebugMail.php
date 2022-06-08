<?php

namespace App\Admin\Command;

use App\Entity\Utilisateur;
use App\Admin\Manager\EmailingManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DebugMailConfirmOrderCommand extends Command
{
    /***********************
     * Specials methods
     **********************/
    public function __construct(
        private EntityManagerInterface $manager,
        private EmailingManager $emailing
    ) {
        parent::__construct();
    }

    /***********************
     * Methods
     **********************/
    protected function configure()
    {
        $this
            ->setName('debug:mail:contact')
            ->setDescription('.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $entity = $this->manager->getRepository(Utilisateur::class)->find(1);
        $entity->getEmail();
        $subject = 'Test Contact';
        $message = 'Test Message';
        $this->emailing->sendMailContact($entity, $subject, $message);
        return self::SUCCESS;
    }
}
