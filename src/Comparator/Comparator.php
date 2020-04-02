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
     * 
     * @var CompareResult
     */
    private $compareStrategy;

    public function __construct(string $strategy = 'total')
    {
        $this->setStrategy($strategy);
    }

    /**
     * Set comparing strategy for Comparator.
     * 
     * @param string $strategy 
     * @return void 
     */
    private function setStrategy(string $strategy){
        switch ($strategy) {
            case 'min':
                $this->compareStrategy = new CompareMin();
            case 'max':
                $this->compareStrategy = new CompareMax();
            case 'total':
                $this->compareStrategy = new CompareTotal();
                break;
            default:
                break;
        }
    }

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
        return $this->reverse * $this->compareStrategy->compare($a, $b);

        $comparableA = $this->getComparable($a);
        $comparableB = $this->getComparable($b);
    }
}
