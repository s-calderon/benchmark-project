<?php

namespace Benchmarker\Comparator;

use Benchmarker\Benchmark\Result;

class CompareAverage implements CompareResult
{
    public function compare(Result $a, Result $b)
    {
        if ($a-getAverage() == $b->getAverage()) {
            return 0;
        }

        return ($a->getAverage() < $b->getAverage()) ? -1 : 1;
    }
}
