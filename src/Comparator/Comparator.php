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
     * @var string
     */
    private $comparatorStrategy;

    public function __construct(string $strategy = 'total')
    {
        $this->comparatorStrategy = $strategy;
    }

    /**
     * Set comparing strategy for Comparator.
     *
     * @param string $strategy
     * @return CompareResult
     */
    private function getStrategy()
    {
        switch ($this->comparatorStrategy) {
            case 'min':
                return new CompareMin();
            case 'max':
                return new CompareMax();
            case 'avg':
                return new CompareAverage();
            case 'total':
            default:
                return new CompareTotal();
                break;
        }
    }

    /**
     * Reverses reverse value.
     *
     * @return void
     */
    public function reverse()
    {
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
        return $this->reverse * $this->getStrategy()->compare($a, $b);
    }
}
