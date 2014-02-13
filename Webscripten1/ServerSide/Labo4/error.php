<?php
/**
 * User: Glenn
 * Date: 14/10/13
 */

$errorType = isset($_GET['type'])? $_GET['type'] : '';
$errorMsg = isset($_GET['detail'])? $_GET['detail'] : 'No additional info is added to this error';

switch($errorType) {
    case 'connect':
        echo 'there was an error of the type connect encounterd';
        break;
    case 'db':
        echo 'there was an error of the type db encounterd';
        break;
    case 'fetch':
        echo 'there was an error of the type fetch encounterd';
        break;
    default:
        echo 'there was an error of unknown type, please try again some time later';
        break;
}