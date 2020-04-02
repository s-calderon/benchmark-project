<?php

namespace Benchmarker\Reporter;

class Reporter
{
    /**
     * @var \Benchmarker\Benchmark\Result[]
     */
    private $results = [];

    /**
     * @var string 
     */
    private $format = 'screen';

    public function __construct(array $results)
    {
        $this->results = $results;
    }

    /**
     * Get generate strategy for set format.
     * 
     * @return GenerateReport
     */
    private function getGenerateStrategy(){
        switch ($this->format) {
            case 'screen':
            default:
                return new GenerateScreenReport();
                break;
        }
    }

    /**
     * Generates report using set format.
     * 
     * @return void 
     */
    public function generateReport()
    {
        $this->getGenerateStrategy()->generate($this->results);
    }
}
