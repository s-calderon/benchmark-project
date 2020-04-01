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
    public function it_outputs_correct_values_on_compare($a, $b, $expected){
        $comparator = new Comparator();

        $this->assertSame($expected, $comparator->compare($a, $b));
    }

    public function argumentProvider(){
        $a = $this->createStub(\Benchmarker\Benchmark\Result::class);
        $a->method('getTotalTime')->willReturn(1);
        $this->resultA = $a;

        $b = $this->createStub(\Benchmarker\Benchmark\Result::class);
        $b->method('getTotalTime')->willReturn(2);
        $this->resultB = $b;

        return[
            [$a, $b, -1],
            [$b, $a, 1],
            [$a, $a, 0]
        ];
    }
}