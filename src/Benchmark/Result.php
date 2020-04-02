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

    /**
     * @var int
     */
    private $iterations = 1;

    /**
     * @var float
     */
    private $min = 5000.0;

    /**
     * @var float
     */
    private $max = -1.0;

    /**
     * Records function name, iterations and results of running function by specified iterations.
     * 
     * @param callable $function 
     * @param int $iterations 
     * @return void 
     */
    public function __construct(callable $function, int $iterations)
    {
        $this->name = $function;

        $this->iterations = $iterations;
        
        for ($i=0; $i < $iterations; $i++) { 
            ob_start();
            $start = microtime(true);
            $function();
            $time = microtime(true) - $start;
            ob_end_clean();

            $this->processTime($time);
        }

    }

    /**
     * Process new time.
     * 
     * @param float $time 
     * @return void 
     */
    private function processTime(float $time){
        $this->times[] = $time;

        if ($time < $this->min) {
            $this->min = $time;
        }

        if ($time > $this->max) {
            $this->max = $time;
        }

        $this->totalTime += $time;
    }
    
    /**
     * Returns an array of all the execution times.
     * 
     * @return float[] 
     */
    public function getTimes(){
        return $this->times;
    }

    /**
     * Gets funtion name of results.
     * 
     * @return string 
     */
    public function getName(){
        return $this->name;
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
     * Get total iterations run. 
     * 
     * @return int 
     */
    public function getIterations(){
        return $this->iterations;
    }

    /**
     * Gets smallest execution time.
     * 
     * @return float 
     */
    public function getMin(){
        return $this->min;
    }

    /**
     * Gets largest execution time.
     * 
     * @return float 
     */
    public function getMax(){
        return $this->max;
    }

    /**
     * Returns average execution time, total/iterations. 
     * 
     * @return float 
     */
    public function getAverage(){
        return $this->totalTime/$this->iterations;
    }

    /**
     * Returns Result as an associative array. 
     * 
     * @return array 
     */
    public function asArray(){
        $publicMethods = (new \ReflectionClass('\Benchmarker\Benchmark\Result'))->getMethods(\ReflectionMethod::IS_PUBLIC);
        $getterMethods = [];
        foreach ($publicMethods as $method) {
            $name = $method->name;

            if (strpos($name, 'get') === 0) {
                if ($name !== 'getTimes') {
                    $name = str_replace("Total", "", $name);
                    $getterMethods[substr($name, 3)] = call_user_func(array($this, $method->name)); 
                }
            }
        }

        return $getterMethods;
    }
}