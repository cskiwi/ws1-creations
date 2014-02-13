<?php

/**
 * Includes
 * ----------------------------------------------------------------
 */

// config & functions

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

// Connect to the database
$config = new \Doctrine\DBAL\Configuration();
$connectionParams = array(
    'dbname' => 'todo',
    'user' => 'root',
    'password' => 'Azerty123',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
    'charset' => 'utf8'
);
$db = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);

// Test connection
try {
    $db->connect();
} catch (\PDOException $e) {
    exit('Could not connect to database:<br /><code>' . $e->getMessage() . '</code>');
}


/**
 * Initial Values
 * ----------------------------------------------------------------
 */


$priorities = array('low','normal','high'); // The possible priorities of a todo
$formErrors = array(); // The encountered form errors

$what = isset($_POST['what']) ? $_POST['what'] : ''; // The todo that was sent in via the form
$priority = isset($_POST['priority']) ? $_POST['priority'] : 'low'; // The priority that was sent in via the form


/**
 * Handle action 'add' (user pressed add button)
 * ----------------------------------------------------------------
 */
/*
if (isset($_POST['moduleAction']) && ($_POST['moduleAction'] == 'add')) {


    // Check form: what not filled in
    if (trim($what) === '') {
        $formErrors[] = 'Please enter a name/description for your todo';
    }

    // Check form: priority not a correct value
    if (!in_array($priority, $priorities)) {
        $formErrors[] = 'Invalid priority selected';
    }

    // form is correct: insert values into database
    if (sizeof($formErrors) == 0) {

        // build & execute prepared statement
        $stmt = $db->prepare('INSERT INTO todolist (what, user_id, priority, added_on) VALUES (?, ?, ?, ?)');
        $stmt->execute(array($what, $_SESSION['user']['id'], $priority, (new DateTime())->format('Y-m-d H:i:s')));

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
*/

/**
 * No action to handle: show our page itself
 * ----------------------------------------------------------------
 */

// Get all todo items from databases
$stmt = $db->executeQuery('SELECT * FROM todolist WHERE user_id = ? ORDER BY priority, what DESC', array(1, $_SESSION['user']['id']));
$items = $stmt->fetchAll();

/**
 * Load and render template
 * ----------------------------------------------------------------
 */

$tpl = $twig->loadTemplate('browse.twig');
echo $tpl->render(array(
    'action' => $_SERVER['PHP_SELF'],
    'what' => $what,
    'priorities' => $priorities,
    'priority' => $priority,
    'items' => $items,
    'formErrors' => $formErrors,
    'user' => $_SESSION['user']
));


// EOF