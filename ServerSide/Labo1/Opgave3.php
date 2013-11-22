<?php
/**
 * User: Glenn
 * Date: 29/09/13
 */

function dump($title, $array) {
    echo '---=[ ' . $title . ' ]=---'. PHP_EOL;
    var_dump($array);
}

dump('Size van $_SERVER', sizeof($_SERVER));
dump('First element of $_server', array_shift($_SERVER));
dump('Size of $_SERVER', sizeof($_SERVER));
dump('Keys of $_Server', array_keys($_SERVER));
dump('Existence of PHP_SELF',in_array('PHP_SELF', $_SERVER) );
asort($_SERVER);
dump('Sorted $_SERVER', $_SERVER);
dump('Reverse sorted $_SERVER', array_reverse($_SERVER));