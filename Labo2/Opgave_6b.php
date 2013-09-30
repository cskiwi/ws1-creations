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
echo '<p>You\'ve send your form with the follwoing details attached:</p>';
if ($_GET['name']){
    foreach ($_GET as $key => $value) {
        if ($key == "name")
            echo 'Name: ' . htmlentities($value). '<br />';

        if (strpos($key, 'Product') !== FALSE)
            echo $key . ': ' . htmlentities($value). '<br />';
    }

}

// Name not completed
else {
    echo '<p>Hello, stranger. <br />looks like you\'re on the wrong page</p>';
}

?>

<div id="debug">

<?php