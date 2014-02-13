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


$priorities = array('low','normal','high'); // The possible priorities of a todo
$formErrors = array(); // The encountered form errors

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0; // The passed in id of the todo

$what = isset($_POST['what']) ? $_POST['what'] : ''; // The todo that was sent in via the form
$priority = isset($_POST['priority']) ? $_POST['priority'] : 'low'; // The priority that was sent in via the form


/**
 * Handle action 'edit' (user pressed edit button)
 * ----------------------------------------------------------------
 */

if (isset($_POST['moduleAction']) && ($_POST['moduleAction'] == 'edit')) {

    // get the id
    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

    $item = $db->fetchAssoc('SELECT * FROM todolist WHERE id = ? AND user_id = ?', array($id, $_SESSION['user']['id']));
    if ($item == null) {
        header('location: browse.php');
        exit();
    }

    // Check form: what not filled in
    if (trim($what) == '') {
        $formErrors[] = 'Please enter a name/description for your todo';
    }

    // Check form: priority not a correct value
    if (!in_array($priority, $priorities)) {
        $formErrors[] = 'Invalid priority selected';
    }

    // form is correct: update values into database
    if (sizeof($formErrors) == 0) {
        try { $db->update('todolist', array(
            'what' => $what,
            'priority' => $priority,
            'added_on' => (new DateTime())->format('Y-m-d H:i:s')
        ), array('id' => $id));
            header('location: browse.php');
            exit();

            // the query failed
        }catch (Exception $e) {
            $formErrors[] = 'Error while updating the item. Please retry.';
        }

    }

}


/**
 * No action to handle: show edit page
 * ----------------------------------------------------------------
 */

// Check if the passed in id (in $_GET) exists as a todoitem
$item = $db->fetchAssoc('SELECT * FROM todolist WHERE id = ? AND user_id = ?', array($id, $_SESSION['user']['id']));
if ($item == null) {
    header('location: browse.php');
    exit();
}

// If the form has not been sent, overwrite the $what and $priority parameters
if (!isset($_POST['moduleAction'])) {
    $what = $item['what'];
    $priority = $item['priority'];
}

/**
 * Load and render template
 * ----------------------------------------------------------------
 */

$tpl = $twig->loadTemplate('edit.twig');
echo $tpl->render(array(
    'action' => $_SERVER['PHP_SELF']. '?id=' . htmlentities(urlencode($id)),
    'what' => $what,
    'item' => $item,
    'priorities' => $priorities,
    'priority' => $priority,
    'formErrors' => $formErrors,
    'user' => $_SESSION['user']
));


// EOF