<?php

namespace Benchmarker\Comparator;

use Benchmarker\Benchmark\Result;

class Comparator {

    private function getComparable(Result $result){
        return $result->getTotalTime();
    }
    
    public function compare(Result $a, Result $b) {
        $comparableA = $this->getComparable($a);
        $comparableB = $this->getComparable($b);
        
        if($comparableA == $comparableB)
        {
            return 0;
        }

        return ($comparableA < $comparableB) ? -1 : 1;
    }
}