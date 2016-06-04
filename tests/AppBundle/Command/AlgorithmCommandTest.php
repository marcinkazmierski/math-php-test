<?php

namespace Tests\AppBundle\Command;

use AppBundle\Command\AlgorithmCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

class AlgorithmCommandTest extends WebTestCase
{
    /** @var  Command */
    protected $command;

    public function setUp()
    {
        //start the symfony kernel
        $kernel = static::createKernel();
        $kernel->boot();

        $application = new Application($kernel);
        $application->add(new AlgorithmCommand());

        $this->command = $application->find('app:algorithm:run');
    }

    public function testRunCommand()
    {
        $commandTester = new CommandTester($this->command);
        $command = $this->command->getName();

        $commandTester->execute(array('command' => $command, 'number' => 5));
        $output = $commandTester->getDisplay();
        $this->assertRegExp('/: 3/', $output); // input: 5, output: 3
    }
}