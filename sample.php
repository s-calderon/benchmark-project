<?php
/**
 * Wrap functions to be benchmarked in a function using a name starting with 'bm_'.
 * Benchmarker will automatically collect these functions and add to benchmark.
 */

function bm_empty()
{
}

function bm_declaring9ElementArray()
{
    $array = [1, 2, 3, 4, 5, 6, 7, 8, 9];
}

function bm_sortArray()
{
    $array = [9, 8, 7, 6, 5, 4, 3, 2, 1];
    sort($array);
}

function bm_sortInOrderArray()
{
    $array = [1, 2, 3, 4, 5, 6, 7, 8, 9];
    sort($array);
}

function bm_foreachLoop()
{
    $array = [1, 2, 3, 4, 5, 6, 7, 8, 9];
    foreach ($array as $element) {
    }
}

function bm_forLoop()
{
    $array = [1, 2, 3, 4, 5, 6, 7, 8, 9];
    for ($i = 0; $i < count($array); $i++) {
    }
}
