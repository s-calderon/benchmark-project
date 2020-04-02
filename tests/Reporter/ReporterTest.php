<?php

namespace Tests\Reporter;

use Benchmarker\Reporter\Reporter;
use PHPUnit\Framework\TestCase;

class ReporterTest extends TestCase
{
    protected $results = [];

    public function setUp() : void
    {
        $a = new \Benchmarker\Benchmark\Result('test_add1ToIntTestVariable', 1000);
        $b = new \Benchmarker\Benchmark\Result('test_add2ToIntTestVariable', 1000);

        $this->results = [$a, $b];
    }

    /**
     * @test
     */
    public function it_takes_results_and_generates_report_to_screen()
    {
        $reporter = new Reporter($this->results);

        $regex = '/(Name)(.+)(Time)(.+)(Iterations)(.+)\n';
        $regex .= '(test_add1ToIntTestVariable)(.+)\n';
        $regex .= '(test_add2ToIntTestVariable)(.+)/s';

        $this->expectOutputRegex($regex);
        $reporter->generateReport();
    }
}
