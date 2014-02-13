<?php

/**
 * EXAMEN SERVERSIDE WEBSCRIPTEN
 * @author JE EIGEN NAAM <JE EMAIL>
 */

/**
 * Includes
 * ----------------------------------------------------------------
 */


// config & functions
require_once 'includes/config.php';
require_once 'includes/functions.php';


/**
 * Database Connection
 * ----------------------------------------------------------------
 */

require_once 'includes/connection.php'; // $db is database connection


/**
 * Initial Values
 * ----------------------------------------------------------------
 */
require_once 'includes/variables.php';
$formErrors = array(); // The encountered form errors

$username = isset($_POST['username']) ? $_POST['username'] : (isset($_COOKIE['username']) ? $_COOKIE['username'] : ''); // Username
$password = isset($_POST['password']) ? $_POST['password'] : ''; // Password

/**
 * Load twig
 * ----------------------------------------------------------------
 */

require_once __DIR__ . '/includes/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, array('debug' => true));


/**
 * Load and render template
 * ----------------------------------------------------------------
 */
if(isset($_SESSION['username'])){
    header('Location: index.php');
    exit();
}
if (isset($_POST['moduleAction']) && ($_POST['moduleAction'] == 'login')) {

    if(trim($username) == ''){
        array_push($formErrors, 'No username is defined');
    }
    if(trim($password) == ''){
        array_push($formErrors, 'No password is defined');
    }

    // form is correct: fetch username out of database
    if (sizeof($formErrors) == 0) {
        $stmt = $db->prepare('SELECT * FROM users WHERE username = ? LIMIT 1');
        $stmt->execute(array($username));
        $items = $stmt->fetch(PDO::FETCH_ASSOC);

        if($items != array()){
            // check password
            if(crypt($password, $items['password']) == $items['password']) {
                $_SESSION['username'] = $items['username'];
                $_SESSION['userID'] = $items['id'];

                setcookie('username', $items['username'], time() + 24*60*60*7);

                header('location:index.php');
            } else {
                array_push($formErrors, 'Wrong password');
            }
        } else {
            array_push($formErrors, 'Wrong username');

        }

    }
}

$tpl = $twig->loadTemplate('login.tpl');
echo $tpl->render(array(
    'user' =>  $user,
    'username' => $username,
    'errors' => $formErrors,
    'genres' => $genres
));