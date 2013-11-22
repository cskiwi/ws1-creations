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
    if (isset($_GET['name']))
        echo 'Name: ' . htmlentities($_GET['name']). '<br />';
    if (isset($_GET['email']))
        echo 'Email: ' . htmlentities($_GET['email']). '<br />';
    if (isset($_GET['profession']))
        echo 'Profession: ' . htmlentities($_GET['profession']). '<br />';
    if (isset($_GET['via']))
        echo 'Via: ' . htmlentities($_GET['via']). '<br />';
    if (isset($_GET['remark']))
        echo 'Remarks: <br /> ' . htmlentities($_GET['remark']). '<br /></p>';
}

// Name not completed
else {
    echo '<p>Hello, stranger. <br />looks like you\'re on the wrong page</p>';
}

?>

<div id="debug">

<?php