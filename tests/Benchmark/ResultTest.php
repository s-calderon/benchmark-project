<?php

namespace Tests\Benchmark;

use Benchmarker\Benchmark\Result;
use PHPUnit\Framework\TestCase;

class ResultTest extends TestCase
{
    /**
     * @test
     */
    public function it_stores_total_execution_time_of_running_function_by_specified_iterations(){
        $iterations = 3;

        $result = new Result('test_add1ToIntTestVariable', 3);

        $this->assertGreaterThan(0, $result->getTotalTime());
    }

    /**
     * @test
     */
    public function it_stores_function_name(){
        $result = new Result('test_add1ToIntTestVariable', 1);

        $this->assertEquals('test_add1ToIntTestVariable', $result->getName());
    }
}