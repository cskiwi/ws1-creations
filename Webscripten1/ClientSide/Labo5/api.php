<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 12/16/13
 * Time: 5:22 PM
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . 'datalayer.php';

showError("got in api");

if (isset($_GET['id'])) {
    if (isset($_GET['action'])){
        if($_GET['action'] == "delete") {

            // deleteContact($_GET['id']);
        }
        if($_GET['action'] == edit) {

        }
    } else{
        http_response_code(404);
    }
    exit(0);
}