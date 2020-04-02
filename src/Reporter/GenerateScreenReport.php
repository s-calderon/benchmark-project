<?php

namespace Benchmarker\Reporter;

class GenerateScreenReport implements GenerateReport
{
    public function generate(array $results)
    {
        // print header
        foreach ($results[0]->asArray() as $key => $value) {
            if ($key == 'Name') {
                echo sprintf('%-40s', $key);
            } elseif ($key == 'Iterations') {
                echo sprintf(' %-12s', $key);
            } else {
                echo sprintf(' %-12s', $key);
            }
        }
        echo "\n";

        // print results
        foreach ($results as $result) {
            foreach ($result->asArray() as $key => $value) {
                if ($key == 'Name') {
                    echo sprintf('%-40s', $value);
                } elseif ($key == 'Iterations') {
                    echo sprintf(' %-12d', $value);
                } else {
                    echo sprintf(' %-12f', $value);
                }
            }
            echo "\n";
        }
    }
}
