<?php
/**
 * User: Glenn
 * Date: 29/09/13
 */

function generateFib($size){
    $fib = array(0, 1);
    for ($i = 0; $i < $size-2; $i++)
        array_push($fib, array_sum(array_slice($fib, $i, 2)));
    return $fib;
}

$values = $argc == 1 ? getInput('How many val?') : $argv[1];

echo implode(',', generateFib($values));


// Course code
function getInput($question = '') {
    if (!function_exists('readline')) {
        echo $question . ' ';
        return stream_get_line(STDIN, 1024, PHP_EOL);
    } else {
        return readline($question . ' ');
    }
}