<?php

namespace Benchmarker\Comparator;

use Benchmarker\Benchmark\Result;

interface CompareResult {
    public function compare(Result $a, Result $b);
}