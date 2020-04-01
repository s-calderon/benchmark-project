<?php

namespace Tests\Benchmark;

use Benchmarker\Benchmark\Benchmark;
use PHPUnit\Framework\TestCase;

class BenchmarkTest extends TestCase
{
    /**
     * @test
     */
    public function it_accepts_a_function_to_be_benchmarked()
    {
        $bm = new Benchmark();
        
        $bm->add('test_add1ToIntTestVariable');

        $this->assertCount(1, $bm->getFunctions());
    }
}
