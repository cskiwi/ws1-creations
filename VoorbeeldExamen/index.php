<?php

/**
 * Includes
 * ----------------------------------------------------------------
 */


// config & functions
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once __DIR__ . '/includes/Twig/Autoloader.php';

// Twig Bootstrap
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, array(
    'cache' => __DIR__ . '/cache',
    'auto_reload' => true // set to false on production
));

/**
 * Database Connection
 * ----------------------------------------------------------------
 */

$db = getDatabase();

/**
 * Initial Values
 * ----------------------------------------------------------------
 */
// Get all todo items from databases
$stmt = $db->prepare('SELECT * FROM contacts ORDER BY sortorder ASC');
$stmt->execute();

$concats = $stmt->fetchAll(PDO::FETCH_ASSOC);
/**
 * No action to handle: show our page itself
 * ----------------------------------------------------------------
 */
$tpl = $twig->loadTemplate('index.twig');
echo $tpl->render(array(
    'contacts' => $concats,
));