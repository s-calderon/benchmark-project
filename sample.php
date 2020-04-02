<?php
/**
 * Wrap functions to be benchmarked in a function using a name starting with 'bm_'.
 * Benchmarker will automatically collect these functions and add to benchmark.
 */

function bm_echo3Tests()
{
    echo 'TestTestTest';
}


$bm_array = [9, 8, 7, 6, 5, 4, 3, 2, 1];
$bm_inorder_array = array_reverse($bm_array);

function bm_sortArray()
{
    sort($GLOBALS['bm_array']);
}

function bm_sortInOrderArray()
{
    sort($GLOBALS['bm_inorder_array']);
}

function bm_foreachLoop()
{
    foreach ($GLOBALS['bm_array'] as $element) {
    }
}

function bm_forLoop()
{
    for ($i = 0; $i < count($GLOBALS['bm_array']); $i++) {
    }
}
