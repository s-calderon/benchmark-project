<?php

namespace Tests\Reporter;

use Benchmarker\Reporter\Reporter;
use PHPUnit\Framework\TestCase;

class ReporterTest extends TestCase
{
    protected $stubResults = [];

    public function setUp() : void
    {
        $a = $this->createStub(\Benchmarker\Benchmark\Result::class);
        $a->method('getName')->willReturn('aStubFunction');
        $a->method('getIterations')->willReturn(1000);
        $a->method('getTotalTime')->willReturn(1);
        $a->method('getMin')->willReturn(.125);
        $a->method('getMax')->willReturn(.5);
        $a->method('getAverage')->willReturn(.125);

        $b = $this->createStub(\Benchmarker\Benchmark\Result::class);
        $b->method('getName')->willReturn('bStubFunction');
        $b->method('getIterations')->willReturn(1000);
        $b->method('getTotalTime')->willReturn(2);
        $b->method('getMin')->willReturn(.25);
        $b->method('getMax')->willReturn(.25);
        $b->method('getAverage')->willReturn(.25);

        $this->stubResults = [$a, $b];
    }

    /**
     * @test
     */
    public function it_takes_results_and_generates_report_to_screen()
    {
        $reporter = new Reporter($this->stubResults);

        $expectedOutput = sprintf("%-40s %-12s %-12s\n", 'Function', 'Time', 'Executions');

        $expectedOutput .= sprintf('%-40s', 'aStubFunction');
        $expectedOutput .= sprintf(' %-12f', 1);
        $expectedOutput .= sprintf(' %-12d', 1000);
        $expectedOutput .= "\n";

        $expectedOutput .= sprintf('%-40s', 'bStubFunction');
        $expectedOutput .= sprintf(' %-12f', 2);
        $expectedOutput .= sprintf(' %-12d', 1000);
        $expectedOutput .= "\n";

        $this->expectOutputString($expectedOutput);
        $reporter->generateReport();
    }
}
