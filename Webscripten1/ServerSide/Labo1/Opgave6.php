<?php
/**
 * User: Glenn
 * Date: 29/09/13
 */

// offset of 3 is used when no argument is givven
$offset = $argc != 1 ?  $argv[1] : '3';

while (!feof(STDIN)) {
    $chars = str_split(fgets(STDIN));
    $newChars = array();
    for ($i = 0; $i < sizeof($chars); $i++)
        array_push($newChars, chr(ord($chars[$i]) + $offset));

    echo implode($newChars);
}