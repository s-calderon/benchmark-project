<?php

// Variables for use with testing function
$intTestVariable = 0;

// Reset testVariable
function testVariableReset()
{
    $GLOBALS['intTestVariable'] = 0;
}

// Functions to be passed for tests
function test_add1ToIntTestVariable()
{
    $GLOBALS['intTestVariable'] += 1;
}

function test_add2ToIntTestVariable()
{
    $GLOBALS['intTestVariable'] += 2;
}
