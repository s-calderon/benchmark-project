<?php

namespace Benchmarker\Reporter;

use Benchmarker\Benchmark\Result;
use Benchmarker\Comparator\Comparator;

class Reporter
{
    /**
     * @var \Benchmarker\Benchmark\Result[]
     */
    private $results = [];

    /**
     * @var \Benchmarker\Comparator\Comparator[]
     */
    private $comparators = [];

    /**
     * @var string
     */
    private $format = 'screen';

    /**
     * @param array $results
     * @param Benchmarker/Comparator/Comparator[] $comparators
     * @return void
     */
    public function __construct(array $results, array $comparators = [])
    {
        $this->results = $results;

        if (count($comparators) > 0) {
            $this->applyComparators($comparators);
        }
    }

    /**
     * Sorts results by given Comparators
     *
     * @param Benchmarker/Comparator/Comparator[] $comparators
     * @return void
     */
    private function applyComparators(array $comparators)
    {
        $this->comparators = $comparators;

        usort($this->results, [$this, 'comparatorsOutput']);
    }

    /**
     * Outputs comparision of chained comporators.
     *
     * @param \Benchmarker\Benchmark\Result $a
     * @param \Benchmarker\Benchmark\Result $b
     * @return int
     */
    private function comparatorsOutput(Result $a, Result $b)
    {
        $comparison = 0;

        foreach ($this->comparators as $comparator) {
            $comparison = $comparator->compare($a, $b);

            if ($comparison !== 0) {
                break;
            }
        }

        return $comparison;
    }

    /**
     * Sets format.
     *
     * @param string $format
     * @return void
     */
    public function setFormat(string $format)
    {
        $this->format = $format;
    }

    /**
     * Get generate strategy for set format.
     *
     * @return GenerateReport
     */
    private function getGenerateStrategy()
    {
        switch ($this->format) {
            case 'csv':
                return new GenerateCsvReport();
                break;
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
