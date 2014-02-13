<?php

/**
 * Includes
 * ----------------------------------------------------------------
 */

// config & functions
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once __DIR__ . '/includes/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader);

session_start();

/**
 * Database Connection
 * ----------------------------------------------------------------
 */

$db = getDatabase();


/**
 * Initial Values
 * ----------------------------------------------------------------
 */


$formErrors = array(); // The encountered form errors

$username = isset($_POST['username']) ? $_POST['username'] : ''; // Username
$password = isset($_POST['password']) ? $_POST['password'] : ''; // Password
$password2 = isset($_POST['password2']) ? $_POST['password2'] : ''; // Password

/**
 * Handle action 'login' (user pressed add button)
 * ----------------------------------------------------------------
 */
if(isset($_SESSION['userID']))
    header('location: logout.php');


if (isset($_POST['moduleAction']) && ($_POST['moduleAction'] == 'register')) {

    if(trim($username) == ''){
        array_push($formErrors, 'No username is defined');
    }
    if(trim($password) == ''){
        array_push($formErrors, 'No password is defined');
    }
    if(trim($password2) == ''){
        array_push($formErrors, 'no second password is defined');
    }
    if($password != $password2){
        array_push($formErrors, 'The passwords are not the same');
    }

    // form is correct: fetch username out of database
    if (sizeof($formErrors) == 0) {
        $stmt = $db->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        $stmt->execute(array($username, crypt($password)));

        // the query succeeded, redirect to this very same page
        if ($db->lastInsertId() !== 0) {
            header('location: browse.php');
            exit();
        }

        // the query failed
        else {
            $formErrors[] = 'Error while inserting the item. Please retry.';
        }


    }
}


/**
 * Load and render template
 * ----------------------------------------------------------------
 */

$tpl = $twig->loadTemplate('register.twig');
echo $tpl->render(array(
    'action' => $_SERVER['PHP_SELF'],
    'formErrors' => $formErrors,
    'username' => $username
));
