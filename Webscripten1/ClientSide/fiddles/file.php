<?php
/**
 * User: Glenn Latomme
 * Date: 17/12/13
 */

if(isset($_GET['input']))
{
    $string = $_GET['input'];
    echo strtolower($string);
}
?>