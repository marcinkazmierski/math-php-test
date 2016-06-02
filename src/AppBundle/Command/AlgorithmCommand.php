<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AlgorithmCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:algorithm:run')
            ->setDescription('Manually algorithm runner.')
            ->setHelp($this->getCommandHelp())
            ->addArgument('number', InputArgument::REQUIRED, 'Integer number');
    }

    private function getCommandHelp()
    {
        return <<<HELP
        The <info>%command.name%</info> command starts algorithm:
        <info>php %command.full_name%</info> <comment>integer</comment>
HELP;
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {

    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

    }
}