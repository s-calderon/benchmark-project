<?php

namespace Benchmarker\Benchmark;

class Benchmark
{
    /**
     * @var callable[]
     */
    private $functions = [];

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
}
