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

        $this->assertEquals(array_sum($result->getTimes()), $result->getTotalTime());
    }

    /**
     * @test
     */
    public function it_stores_function_name(){
        $result = new Result('test_add1ToIntTestVariable', 1);

        $this->assertEquals('test_add1ToIntTestVariable', $result->getName());
    }

    /**
     * @test
     */
    public function it_stores_min_execution_time_of_running_function_by_specified_iterations(){
        $result = new Result('test_add1ToIntTestVariable', 2);

        $this->assertSame(min($result->getTimes()), $result->getMin());
    }

    /**
     * @test
     */
    public function it_stores_max_execution_time_of_running_function_by_specified_iterations(){
        $result = new Result('test_add1ToIntTestVariable', 2);

        $this->assertSame(max($result->getTimes()), $result->getMax());
    }
}