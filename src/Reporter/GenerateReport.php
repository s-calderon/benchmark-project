<?php

namespace Benchmarker\Reporter;

interface GenerateReport
{
    /**
     * 
     * @param Benchmarker\Benchmark\Result[] $results 
     * @return mixed 
     */
    public function generate(array $results);
}