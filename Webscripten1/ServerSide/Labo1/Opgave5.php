<?php
/**
 * User: Glenn
 * Date: 29/09/13
 */

date_default_timezone_set('Europe/Brussels');

$date = mktime('11', '45', '00', '12', '26', '1983');

echo $date . PHP_EOL;
echo date('F', $date) . PHP_EOL;
echo date('l', $date) . PHP_EOL;
echo date('D', $date) . PHP_EOL;
echo date('dmY', $date) . PHP_EOL;
echo date('ymd', $date) . PHP_EOL;
echo date('g:i A', $date) . PHP_EOL;
echo date('t', $date) . PHP_EOL;
echo date('j F Y', $date) . PHP_EOL;
echo date('W', $date) . PHP_EOL;