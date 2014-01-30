<?php
/**
 * User: Glenn Latomme
 * Date: 4/11/13
 */
session_start();
unset($_SESSION['username']);
unset($_SESSION['userID']);
header('location: login.php');
session_destroy();
