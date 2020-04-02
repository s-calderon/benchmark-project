<?php

namespace Benchmarker\Reporter;

class GenerateScreenReport implements GenerateReport
{
    public function generate(array $results){
        echo sprintf("%-40s %-12s %-12s\n", 'Function', 'Time', 'Executions');

        foreach ($results as $result) {
            echo sprintf("%-40s", $result->getName());
            echo sprintf(" %-12f", $result->getTotalTime());
            echo sprintf(" %-12d", $result->getIterations());
            echo "\n";
        }
    }
}
