<?php

/**
 * Includes
 * ----------------------------------------------------------------
 */

// config & functions
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/vendor/autoload.php';

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader);


/**
 * Session Control: Only allow logged in users to this site
 * ----------------------------------------------------------------
 */

// start session
session_start();

// user is already logged in, redirect to index
if (!isset($_SESSION['user'])) {
    header('location: login.php');
    exit();
}


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
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0; // The passed in id of the todo

/**
 * Handle action 'edit' (user pressed edit button)
 * ----------------------------------------------------------------
 */

if (isset($_POST['moduleAction']) && ($_POST['moduleAction'] == 'delete')) {

    // get the id
    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

    // check if item exists (use the id from the $_POST array!)

    $item = $db->fetchAssoc('SELECT *  FROM todolist WHERE id = ? AND user_id = ?', array($id, $_SESSION['user']['id']));

    if ($item == null) {
        header('location: browse.php');

        exit();
    }

    // form is correct: update values into database
    if (sizeof($formErrors) == 0) {
        try {
            $db->delete('todolist', array('id' => $id));

            // the query failed
        } catch (Exception $e) {
            $formErrors[] = 'Error while deleting the item. Please retry.';
        }

    }

}

/**
 * No action to handle: show delete page
 * ----------------------------------------------------------------
 */

// Check if the passed in id (in $_GET) exists as a todoitem
$item = $db->fetchAssoc('SELECT * FROM todolist WHERE id = ? AND user_id = ?', array($id, $_SESSION['user']['id']));
if ($item == null) {
    header('location: browse.php');
    exit();
}

/**
 * Load and render template
 * ----------------------------------------------------------------
 */

$tpl = $twig->loadTemplate('delete.twig');
echo $tpl->render(array(
    'action' => $_SERVER['PHP_SELF'] . '?id=' . htmlentities(urlencode($id)),
    'item' => $item,
    'formErrors' => $formErrors,
    'user' => $_SESSION['user']
));


// EOF