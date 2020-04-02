<?php

namespace Benchmarker\Comparator;

use Benchmarker\Benchmark\Result;

class CompareMax implements CompareResult
{
    public function compare(Result $a, Result $b)
    {
        if ($a-getMax() == $b->getMax()) {
            return 0;
        }

        return ($a->getMax() > $b->getMax()) ? -1 : 1;
    }
}
