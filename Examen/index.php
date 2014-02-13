<?php

/**
 * EXAMEN SERVERSIDE WEBSCRIPTEN
 * @author glenn.latomme
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

$genre_id = isset($_GET['genre']) ? $_GET['genre'] : -1; // Password
$stmt = null;
$fetch = null;
/**
 * Load twig
 * ----------------------------------------------------------------
 */

require_once __DIR__ . '/includes/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, array('debug' => true));

/**
 * Get data
 * ----------------------------------------------------------------
 */

if ($genre_id != -1){

    if(array_key_exists($genre_id,$genres)){
        $stmt = $db->prepare('SELECT movies.*, users.username, genres.title as genre FROM movies INNER JOIN users on movies.user_id = users.id INNER JOIN genres on movies.genre_id=genres.id WHERE genres.id = ? ORDER BY movies.title ASC');
        $stmt->execute(array($genre_id));
    } else {
        header('location:index.php');
        exit();
    }

} else {
    $stmt = $db->prepare('SELECT movies.*, users.username, genres.title as genre FROM movies INNER JOIN users on movies.user_id = users.id INNER JOIN genres on movies.genre_id=genres.id ORDER BY movies.title ASC');
    $stmt->execute();
}

if($stmt != null) {
    $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //  var_dump($fetch);
}

/**
 * Load and render template
 * ----------------------------------------------------------------
 */

$tpl = $twig->loadTemplate('index.tpl');
echo $tpl->render(array(
    'movies' => $fetch,
    'user' => $user,
    'genres' => $genres
));