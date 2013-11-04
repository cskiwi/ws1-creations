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

$username = isset($_POST['username']) ? $_POST['username'] : (isset($_COOKIE['username']) ? $_COOKIE['username'] : ''); // Username
$password = isset($_POST['password']) ? $_POST['password'] : ''; // Password

/**
 * Handle action 'login' (user pressed add button)
 * ----------------------------------------------------------------
 */
if(isset($_SESSION['userID']))
    header('location: browse.php');


if (isset($_POST['moduleAction']) && ($_POST['moduleAction'] == 'login')) {

    if(trim($username) == ''){
        array_push($formErrors, 'No username is defined');
    }
    if(trim($password) == ''){
        array_push($formErrors, 'No password is defined');
    }

    echo 'test';

    // form is correct: fetch username out of database
    if (sizeof($formErrors) == 0) {
        $stmt = $db->prepare('SELECT * FROM users WHERE username = ? LIMIT 1');
        $stmt->execute(array($username));
        $items = $stmt->fetch(PDO::FETCH_ASSOC);

        if($items != array()){
            if(crypt($password, $items['Password']) == $items['Password']) {
                $_SESSION['userID'] = $items['ID'];

                setcookie('username', $items['Username'], time() + 24*60*60*7);

                header('location:browse.php');
            } else {
                array_push($formErrors, 'Wrong password');
            }
        } else {
            array_push($formErrors, 'Wrong username');

        }

    }
}

/**
 * Load and render template
 * ----------------------------------------------------------------
 */


$tpl = $twig->loadTemplate('login.twig');
echo $tpl->render(array(
    'action' => $_SERVER['PHP_SELF'],
    'formErrors' => $formErrors,
    'username' => $username
));
