<?php

namespace Benchmarker\Reporter;

class GenerateCsvReport implements GenerateReport
{
    public function generate(array $results)
    {
        // print header
        foreach ($results[0]->asArray() as $key => $value) {
            if ($key !== "Name") {
                $data .= ",";
            }
            $data .= "$value";
        }
        echo "\n";

        // print results
        foreach ($results as $result) {
            foreach ($result->asArray() as $key => $value) {
                if ($key !== "Name") {
                    $data .= ",";
                }
                $data .= "$value";
            }
            echo "\n";
        }

        file_put_contents('results.csv', data);
    }
}
