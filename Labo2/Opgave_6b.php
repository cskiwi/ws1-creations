<?php
/**
 * User: Glenn
 * Date: 30/09/13
 */


?><!DOCTYPE html>
<html>
<head>
    <title>Thanks form</title>
</head>
<body>

<?php

// Name completed
echo '<p>You\'ve send your form with the following details attached:</p>';
if (isset($_GET['name'])){
    foreach ($_GET as $key => $value) {
        if ($key == "name")
            echo 'Name: ' . htmlentities($value). '<br />';

        // check if gets has products
        if (strpos($key, 'Product') !== false){
            // get product nr
            $prodNr = substr($key, 7);
            // check if is numeric
            if(is_numeric($prodNr))
                echo 'Product '. $prodNr .': ' . htmlentities($value). '<br />';
        }
    }
}

// Name not completed
else {
    echo '<p>Hello, stranger. <br />looks like you\'re on the wrong page</p>';
}

?>

<div id="debug">

<?php