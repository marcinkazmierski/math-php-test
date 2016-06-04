<?php

namespace AppBundle\Command;

use AppBundle\Service\Algorithm;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class AlgorithmCommand extends ContainerAwareCommand
{
    /** @var  Algorithm */
    protected $algorithm;

    protected function configure()
    {
        $this
            ->setName('app:algorithm:run')
            ->setDescription('Manually algorithm runner.')
            ->setHelp($this->getCommandHelp())
            ->addArgument('number', InputArgument::REQUIRED, 'Integer number - length sequence of numbers');
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
        $this->algorithm = $this->getContainer()->get('app_algorithm');
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if ($input->getArgument('number') !== null) {
            return true;
        }

        $question = new Question(' > <info>Length sequence of numbers</info>: ');
        $question->setValidator(function ($answer) {
            if (empty($answer)) {
                throw new \RuntimeException('The number cannot be empty');
            }
            return $answer;
        });

        $question->setMaxAttempts(5);
        $console = $this->getHelper('question');
        $number = $console->ask($input, $output, $question);
        $input->setArgument('number', $number);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $startTime = microtime(true);

        $number = (int)$input->getArgument('number');

        $result = $this->algorithm->calculate($number);

        if ($result !== false) {
            $output->writeln(sprintf('[INFO] Max value in sequence of numbers is: %d', $result));
        } else {
            $output->writeln(sprintf('[ERROR] Invalid data'));
        }

        if ($output->isVerbose()) { // if set -v parameters in command query
            $finishTime = microtime(true);
            $elapsedTime = $finishTime - $startTime;
            $output->writeln(sprintf('[INFO] Execution time: %.2f ms', $elapsedTime * 1000));
        }
    }
}