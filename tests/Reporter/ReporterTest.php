<?php

namespace Tests\Reporter;

use Benchmarker\Reporter\Reporter;
use PHPUnit\Framework\TestCase;

class ReporterTest extends TestCase
{
    protected $results = [];

    public function setUp() : void
    {
        $a = $this->createStub(\Benchmarker\Benchmark\Result::class);
        $a->method('getTotalTime')->willReturn(3);
        $a->method('getMin')->willReturn(.125);
        $a->method('getMax')->willReturn(.5);
        $a->method('getAverage')->willReturn(.125);
        $a->method('asArray')->willReturn([
            'Name' => 'stubA',
            'Time' => 3,
            'Iterations' => 1000
        ]);

        $b = $this->createStub(\Benchmarker\Benchmark\Result::class);
        $b->method('getTotalTime')->willReturn(2);
        $b->method('getMin')->willReturn(.25);
        $b->method('getMax')->willReturn(.25);
        $b->method('getAverage')->willReturn(.25);
        $b->method('asArray')->willReturn([
            'Name' => 'stubB',
            'Time' => 2,
            'Iterations' => 1000
        ]);

        $this->results = [$a, $b];
    }

    /**
     * @test
     */
    public function it_takes_results_and_generates_report_to_screen()
    {
        $reporter = new Reporter($this->results);

        $regex = '/(Name)(.+)(Time)(.+)(Iterations)(.+)\n';
        $regex .= '(stubA)(.+)';
        $regex .= '(stubB)(.+)';
        $regex .= '/s';

        $this->expectOutputRegex($regex);
        $reporter->generateReport();
    }

    /**
     * @test
     */
    public function it_takes_comparator_to_order_results()
    {
        $comparator = new \Benchmarker\Comparator\Comparator('total');

        $reporter = new Reporter($this->results, $comparator);

        $regex = '/(Name)(.+)(Time)(.+)(Iterations)(.+)\n';
        $regex .= '(stubB)(.+)';
        $regex .= '(stubA)(.+)';
        $regex .= '/s';

        $this->expectOutputRegex($regex);
        $reporter->generateReport();
    }
}
