<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 12/16/13
 * Time: 5:22 PM
 */
// header('Content-type: application/json');


require_once 'includes/config.php';
require_once 'includes/datalayer.php';
require_once 'includes/functions.php';


if (isset($_GET['id'])) {
    if (isset($_GET['delete'])){
        deleteContact($_GET['id']);
    } else{
        http_response_code(404);
    }
    exit(0);
}