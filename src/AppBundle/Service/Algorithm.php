<?php
namespace AppBundle\Service;

class Algorithm
{
    /** @var array */
    private $results = array();

    /** @var int */
    private $maxNumber = 0;

    public function __construct($maxNumber)
    {
        $this->results[0] = 0;
        $this->results[1] = 1;
        $this->maxNumber = (int)$maxNumber;
    }

    /**
     * Calculate function.
     */
    public function calculate($number)
    {
        if (!$this->isValidNumber($number)) {
            return false;
        }
        for ($i = 1; $i < ($number / 2); $i++) {
            if (!isset($this->results[$i * 2])) {
                $this->results[$i * 2] = $this->results[$i];
            }

            if (!isset($this->results[$i * 2 + 1])) {
                $this->results[$i * 2 + 1] = $this->results[$i] + $this->results[$i + 1];
            }
        }
        $results = array_slice($this->results, 0, $number + 1);
        return max($results);
    }

    /**
     * Validation function.
     */
    public function isValidNumber($number)
    {
        if (is_int($number) && $number >= 1 && $number <= $this->maxNumber) {
            return true;
        }
        return false;
    }
}