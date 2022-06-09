<?php


namespace App\Command;


use App\Services\AleatoireService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PersonneCommand extends Command
{
    protected static $defaultName = 'app:create-pers';
    private $service ;
    private $em;

    public function __construct( AleatoireService $service, EntityManagerInterface $em)
    {
        $this->service=$service;
        $this->em=$em;
        parent::__construct();

    }

    protected function configure()
    {
        $this
            ->setName('app:create-pers')

            ->addArgument('sec', InputArgument::REQUIRED, 'seconds.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('done');
        // $output->writeln('sec: '.$inpuclqqt->getArgument('sec'));
        $this->service-> remplirRandom($this->em,$input->getArgument('sec'));
    }
}