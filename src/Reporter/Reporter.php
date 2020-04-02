<?php

namespace Benchmarker\Reporter;

use Benchmarker\Comparator\Comparator;

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

    public function __construct(array $results, Comparator $comparator = null)
    {
        $this->results = $results;

        if (!is_null($comparator)) {
            $this->applyComparator($comparator);
        }
    }

    /**
     * Sorts results by given Comparator
     * 
     * @param Comparator $comparator 
     * @return void 
     */
    private function applyComparator(Comparator $comparator)
    {
        usort($this->results, [$comparator, 'compare']);
    }

    /**
     * Get generate strategy for set format.
     *
     * @return GenerateReport
     */
    private function getGenerateStrategy()
    {
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
