<?php

namespace Tests\AppBundle\Service;

use AppBundle\Service\Algorithm;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AlgorithmTest extends WebTestCase
{
    /** @var  Algorithm */
    protected $algorithm;

    /** @var int */
    protected $algorithmMaxNumber;

    public function setUp()
    {
        //start the symfony kernel
        $kernel = static::createKernel();
        $kernel->boot();

        //get the DI container
        $container = $kernel->getContainer();

        $this->algorithm = $container->get('app_algorithm');
        $this->algorithmMaxNumber = (int)$container->getParameter('algorithm_max_number');
    }

    /**
     * @dataProvider dataCalculateProvider
     */
    public function testCalculate($number, $expectedResult)
    {
        $result = $this->algorithm->calculate($number);
        $this->assertTrue($result === $expectedResult);
    }

    /**
     * Data provider for calculate tests.
     *
     * Param 1: number [Length sequence of numbers]
     * Param 2: expected result
     */
    public function dataCalculateProvider()
    {
        return array(
            array(0, false),
            array(1, 1),
            array(2, 1),
            array(5, 3),
            array(10, 4),
            array(11, 5)
        );
    }


    /**
     * @dataProvider dataIsValidNumberProvider
     */
    public function testIsValidNumber($number, $expectedResult)
    {
        $result = $this->algorithm->isValidNumber($number);
        $this->assertTrue($result === $expectedResult);
    }

    /**
     * Data provider for isValidNumber tests.
     *
     * Param 1: number [Length sequence of numbers]
     * Param 2: expected result
     */
    public function dataIsValidNumberProvider()
    {
        return array(
            array(-1, false),
            array(0, false),
            array(1, true),
            array(2, true),
            array(3, true),
        );
    }

    public function testIsValidNumberMax()
    {
        $result = $this->algorithm->isValidNumber($this->algorithmMaxNumber);
        $this->assertTrue($result === true);

        $result = $this->algorithm->isValidNumber($this->algorithmMaxNumber + 1);
        $this->assertTrue($result === false);
    }
}