<?php

namespace Benchmarker\Benchmark;

class Result
{
    /**
     * @var int
     */
    private $totalTime = 0;

    /**
     * @var string
     */
    private $name = "";

    /**
     * Record function name and result of running function by specified iterations.
     * 
     * @param callable $function 
     * @param int $iterations 
     * @return void 
     */
    public function __construct(callable $function, int $iterations)
    {
        $this->name = $function;

        for ($i=0; $i < $iterations; $i++) { 
            $start = microtime(true);
            $function();
            $end = microtime(true);

            $this->totalTime += $end - $start;
        }
        
    }

    /**
     * Get total time it took for function to run by set iterations.
     * 
     * @return int 
     */
    public function getTotalTime()
    {
        return $this->totalTime;
    }

    public function getName(){
        return $this->name;
    }
}