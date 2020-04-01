<?php

namespace Benchmarker\Comparator;

use Benchmarker\Benchmark\Result;

class CompareTotal implements CompareResult
{
    public function compare(Result $a, Result $b)
    {
        if ($a->getTotalTime() == $b->getTotalTime()) {
            return 0;
        }

        return ($a->getTotalTime() < $b->getTotalTime()) ? -1 : 1;
    }
}
