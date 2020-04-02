<?php

namespace Benchmarker\Reporter;

class GenerateCsvReport implements GenerateReport
{
    public function generate(array $results)
    {
        $output = '';
        // print header
        foreach ($results[0]->asArray() as $key => $value) {
            if ($key !== 'Name') {
                $output .= ',';
            }
            $output .= "$key";
        }
        $output .= "\n";

        // print results
        foreach ($results as $result) {
            foreach ($result->asArray() as $key => $value) {
                if ($key !== 'Name') {
                    $output .= ',';
                }
                $output .= "$value";
            }
            $output .= "\n";
        }

        file_put_contents('results.csv', $output);
    }
}
