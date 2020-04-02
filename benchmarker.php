<?php

use Benchmarker\Benchmark\Benchmark;
use Benchmarker\Comparator\Comparator;
use Benchmarker\Reporter\Reporter;
use Garden\Cli\Cli;

// Require composer's autoloader.
require_once 'vendor/autoload.php';

// Define the cli options.
$cli = new Cli();

// Description of app
$cli->description('Benchmark the performance of given PHP functions and generate a report comparing the performance.');

// Functions file argument
$cli->opt('file:f', 'REQUIRED: The path to file that contains functions to benchmark.', true, 'string');

// Iterations argument
$cli->opt('iterations:i', 'REQUIRED: The number of iterations to run each function.', true, 'integer');

// Format argument
$cli->opt('format:fmt', "The output format of results. 
                        Default = 'screen'
                        ---
                        Available formats: 'screen', 'csv'", false, 'string');

// Sort/Comparators argument
$cli->opt('sort:s', "The sorting method(s) to apply to performance results.
                    Will apply sort in order from first to last.
                    ---
                    Available methods: 'total', 'min', 'max', 'avg'
                    Optionally append ':desc' to change order. Default order is ascending.
                    ---
                    Ex: --sort=\"avg:asc,total:desc,max:asc\"
                    Will sort by average ascending, then total descending, then max ascending.
                    ", false, 'string');

// Parse and return cli args.
$args = $cli->parse($argv, true);

// Include php file that contains functions to benchmark
include_once $args['file'];

// Function to filter out any user defined functions not to benchmark
function isForBenchmark($name)
{
    if (strpos($name, 'bm_') !== false) {
        return true;
    } else {
        return false;
    }
}

// Get names of functions to benchmark
$bm_functions = array_filter(get_defined_functions()['user'], 'isForBenchmark');

// Add each function to benchmark
$benchmark = new Benchmark();
foreach ($bm_functions as $bm_function) {
    $benchmark->add($bm_function);
}

// Set # of executions to run for each function
$benchmark->setIterations($args['iterations']);

// Run benchmark
$benchmark->run();

// Get results
$results = $benchmark->getResults();

// Create Comparators
$comparators = [];
foreach (explode(',', $args['sort']) as $sort) {
    $comparatorArgs = explode(':', $sort); // 0 == name, 1 == asc/desc
    $comparator = new Comparator($comparatorArgs[0]);
    if (isset($comparatorArgs[1]) && $comparatorArgs[1] == 'desc') {
        $comparator->reverse();
    }
    $comparators[] = $comparator;
}

// Create report using results and comparators
$reporter = new Reporter($results, $comparators);

// Set format if specified
if (isset($args['format']) && $args['format'] !== '') {
    $reporter->setFormat($args['format']);
}

// Generate report
$reporter->generateReport();
