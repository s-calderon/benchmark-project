<?php

namespace Benchmarker\Benchmark;

class Benchmark
{
    /**
     * @var callable[]
     */
    private $functions = [];

    /**
     * @var int
     */
    private $iterations = 1;

    /**
     * Adds callable function to set of functions to be benchmarked.
     *
     * @param callable $function
     * @return void
     */
    public function add(callable $function)
    {
        if (!in_array($function, $this->functions)) {
            $this->functions[] = $function;
        }
    }

    /**
     * Returns set of functions to be benchmarked.
     *
     * @return callable[]
     */
    public function getFunctions()
    {
        return $this->functions;
    }
    
    /**
     * Sets number of iterations to run functions.
     * 
     * @param int $iterations 
     * @return $this 
     */
    public function setIterations(int $iterations)
    {
        $this->iterations = $iterations;

        return $this;
    }

    /**
     * Executes functions in set.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->functions as $function) {
            for ($i=0; $i < $this->iterations; $i++) { 
                $function();
            }
        }
    }
}
