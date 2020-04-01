<?php

namespace Benchmarker\Comparator;

use Benchmarker\Benchmark\Result;

class Comparator
{
    /**
     * @var int
     */
    private $reverse = 1;

    /**
     * Gets total execution time from Result to compare.
     *
     * @param Result $result
     * @return int
     */
    private function getComparable(Result $result)
    {
        return $result->getTotalTime();
    }

    /**
     * Reverses reverse value.
     * 
     * @return void 
     */
    public function reverse(){
        $this->reverse *= -1;
    }

    /**
     * Returns -1 if a < b, 1 if a > b, 0 if a == b
     *
     * @param Result $a
     * @param Result $b
     * @return int
     */
    public function compare(Result $a, Result $b)
    {
        $comparableA = $this->getComparable($a);
        $comparableB = $this->getComparable($b);

        if ($comparableA == $comparableB) {
            return 0;
        }

        $value = ($comparableA < $comparableB) ? -1 : 1;
        return $this->reverse * $value;
    }
}
