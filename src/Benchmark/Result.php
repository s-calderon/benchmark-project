<?php

namespace Benchmarker\Benchmark;

class Result
{
    /**
     * @var int
     */
    private $totalTime = 0;

    /**
     * Run function by specified iterations and record result.
     * 
     * @param callable $function 
     * @param int $iterations 
     * @return void 
     */
    public function __construct(callable $function, int $iterations)
    {
        for ($i=0; $i < $iterations; $i++) { 
            $start = microtime(true);
            $function();
            $end = microtime(true);

            $this->totalTime += $end - $start;
        }
        
    }

    /**
     * Get total time it took for function to run by set iterations.
     * @return int 
     */
    public function getTotalTime()
    {
        return $this->totalTime;
    }
}