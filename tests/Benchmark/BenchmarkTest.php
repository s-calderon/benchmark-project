<?php

namespace Tests\Benchmark;

use Benchmarker\Benchmark\Benchmark;
use PHPUnit\Framework\TestCase;

class BenchmarkTest extends TestCase
{
    public function setUp() : void
    {
        testVariableReset();
    }

    /**
     * @test
     */
    public function it_accepts_a_function_to_be_benchmarked()
    {
        $bm = new Benchmark();
        
        $bm->add('test_add1ToIntTestVariable');

        $this->assertCount(1, $bm->getFunctions());
    }

    /**
     * @test
     */
    public function it_does_not_add_the_same_function_more_than_once_to_set(){
        $bm = new Benchmark();

        $bm->add('test_add1ToIntTestVariable');
        
        $this->assertCount(1, $bm->getFunctions());

        $bm->add('test_add1ToIntTestVariable');
        
        $this->assertCount(1, $bm->getFunctions());
    }

    /**
     * @test
     */
    public function it_executes_function_on_run(){
        $bm = new Benchmark();

        $bm->add('test_add2ToIntTestVariable');

        $bm->run();

        $this->assertSame(2, $GLOBALS['intTestVariable']);
    }

    /**
     * @test
     */
    public function it_executes_function_by_set_iterations(){
        $bm = new Benchmark();

        $bm->add('test_add1ToIntTestVariable');

        $bm->setIterations(5)->run();

        $this->assertSame(5, $GLOBALS['intTestVariable']);
    }

    /**
     * @test
     */
    public function it_executes_all_functions_by_set_iterations(){
        $bm = new Benchmark();

        $bm->add('test_add1ToIntTestVariable');
        $bm->add('test_add2ToIntTestVariable');

        $bm->setIterations(5)->run();

        $this->assertSame(15, $GLOBALS['intTestVariable']);
    }
}
