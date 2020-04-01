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

        $b = $this->createStub(\Benchmarker\Benchmark\Result::class);
        $b->method('getTotalTime')->willReturn(2);
        $b->method('getMin')->willReturn(.25);

        return[
            ['total', $a, $b, -1],
            ['total', $b, $a, 1],
            ['total', $a, $a, 0],
            ['min', $a, $b, -1],
            ['min', $b, $a, 1],
            ['min', $a, $a, 0]
        ];
    }
}
