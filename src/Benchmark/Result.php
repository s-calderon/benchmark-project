<?php

namespace Benchmarker\Benchmark;

class Result
{
    /**
     * @var float[]
     */
    private $times = [];

    /**
     * @var int
     */
    private $totalTime = 0;

    /**
     * @var string
     */
    private $name = "";

    private $min = 50.0;

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
    
            $time = microtime(true) - $start;

            $this->times[] = $time;

            if ($time < $this->min) {
                $this->min = $time;
            }

            $this->totalTime += $time;
        }
    }
    
    public function getTimes(){
        return $this->times;
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

    /**
     * Gets funtion name of results.
     * 
     * @return string 
     */
    public function getName(){
        return $this->name;
    }

    public function getMin(){
        return $this->min;
    }
}