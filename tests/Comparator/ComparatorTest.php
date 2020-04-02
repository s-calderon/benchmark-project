<?php

namespace Tests;

use Benchmarker\Comparator\Comparator;
use PHPUnit\Framework\TestCase;

class ComparatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider argumentProvider
     */
    public function it_outputs_correct_values_on_compare($strategy, $a, $b, $expected)
    {
        $comparator = new Comparator($strategy);

        $this->assertSame($expected, $comparator->compare($a, $b));
    }

    /**
     * @test
     * @dataProvider argumentProvider
     */
    public function it_outputs_correct_values_on_compare_when_reversed($strategy, $a, $b, $expected)
    {
        $comparator = new Comparator($strategy);

        $comparator->reverse();

        $this->assertSame(-$expected, $comparator->compare($a, $b));
    }

    public function argumentProvider()
    {
        $a = $this->createStub(\Benchmarker\Benchmark\Result::class);
        $a->method('getTotalTime')->willReturn(1);
        $a->method('getMin')->willReturn(.125);
        $a->method('getMax')->willReturn(.5);
        $a->method('getAverage')->willReturn(.125);

        $b = $this->createStub(\Benchmarker\Benchmark\Result::class);
        $b->method('getTotalTime')->willReturn(2);
        $b->method('getMin')->willReturn(.25);
        $b->method('getMax')->willReturn(.25);
        $b->method('getAverage')->willReturn(.25);

        return[
            "first total < second total" => ['total', $a, $b, -1],
            "first total > second total" => ['total', $b, $a, 1],
            "first total = second total" => ['total', $a, $a, 0],
            "first min < second min" => ['min', $a, $b, -1],
            "first min > second min" => ['min', $b, $a, 1],
            "first min = second min" => ['min', $a, $a, 0],
            "first max > second max" => ['max', $a, $b, -1],
            "first max < second max" => ['max', $b, $a, 1],
            "first max = second max" => ['max', $a, $a, 0],
            "first avg < second avg" => ['avg', $a, $b, -1],
            "first avg > second avg" => ['avg', $b, $a, 1],
            "first avg = second avg" => ['avg', $a, $a, 0]
        ];
    }
}
