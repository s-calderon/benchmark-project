<?php

namespace Benchmarker\Reporter;

class Reporter
{
    /**
     * @var \Benchmarker\Benchmark\Result[]
     */
    private $results = [];

    public function __construct(array $results)
    {
        $this->results = $results;
    }

    public function generateReport()
    {
        echo sprintf("%-40s %-12s %-12s\n", 'Function', 'Time', 'Executions');

        foreach ($this->results as $result) {
            echo sprintf("%-40s", $result->getName());
            echo sprintf(" %-12f", $result->getTotalTime());
            echo sprintf(" %-12d", $result->getIterations());
            echo "\n";
        }
    }
}
