<?php
namespace AppBundle\Service;

class Algorithm
{

    private $results = array();
    const MAX_NUMBER = 99999;

    public function __construct()
    {
        $this->results[0] = 0;
        $this->results[1] = 1;
    }

    public function calculate($number)
    {
        if (!$this->isValidNumber($number)) {
            return false;
        }
        for ($i = 1; $i < ($number / 2); $i++) {
            $this->results[$i * 2] = $this->results[$i];
            $this->results[$i * 2 + 1] = $this->results[$i] + $this->results[$i + 1];
        }
        return max($this->results);
    }

    private function isValidNumber($number)
    {
        if (is_int($number) && $number > 0 && $number <= self::MAX_NUMBER) {
            return true;
        }
        return false;
    }
}