<?php
/**
 * User: Glenn
 * Date: 29/09/13
 */


function dump($title, $array) {
    echo '---=[ ' . $title . ' ]=---'. PHP_EOL;
    var_dump($array);
}

$array1 = array();
$array2 = array();
$array3 = array();

// Array 1
for ($i = 1; $i < 7; $i++)
    array_push($array1, $i);

// Array 2
for ($i = 0; $i < 6; $i++)
    array_push($array2, $i%2 ? 'Odd' : 'Even');

// Array 3
for ($i=97; $i <= 122; $i++)
    array_push($array3, chr($i));

dump('Simple for lus creation', $array1);
dump('Checking if odd or even', $array2);
dump('Inserting char', $array3);

echo implode(',', $array3);
