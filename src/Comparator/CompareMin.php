<?php

namespace Benchmarker\Comparator;

use Benchmarker\Benchmark\Result;

class CompareMin implements CompareResult
{
    public function compare(Result $a, Result $b)
    {
        if ($a->getMin() == $b->getMin()) {
            return 0;
        }

        return ($a->getMin() < $b->getMin()) ? -1 : 1;
    }
}
