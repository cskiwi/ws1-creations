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

$title = isset($_POST['title']) ? $_POST['title'] : ''; // title
$year = isset($_POST['year']) ? intval($_POST['year']) : 0; // year
$genre_id = isset($_POST['genre_id']) ? intval($_POST['genre_id']) : 0; // genre_id
$basePath = __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'covers'; // C:\wamp\www\vn.an\labo03\images
$baseUrl = 'avatars'; // images
/**
 * Load twig
 * ----------------------------------------------------------------
 */

require_once __DIR__ . '/includes/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, array('debug' => true));

if(isset($_SESSION['username']) == false)
    header('location: login.php');

if (isset($_POST['moduleAction']) && ($_POST['moduleAction'] == 'add')) {

    if(trim($title) == ''){
        array_push($formErrors, 'No title is defined');
    }
    if($year < 1900){
        array_push($formErrors, 'No correct year is defined');
    }
    if($genre_id < 1){
        array_push($formErrors, 'No genre is defined');
    }
    if ($_FILES['coverphoto']['size'] <= 0) {
        array_push($formErrors, 'No cover is defined');
    }

    // form is correct: fetch username out of database
    if (sizeof($formErrors) == 0) {

        $extention = (new SplFileInfo($_FILES['coverphoto']['name']))->getExtension();
        if (!in_array($extention, array('jpg', 'png', 'gif'))) {
            array_push($formErrors, 'Invalid extension. Only .jpg, .png or .gif allowed');
        }
        if (sizeof($formErrors) == 0) {

            // build & execute prepared statement
            $stmt = $db->prepare('INSERT INTO movies (title, year, user_id, genre_id, cover_extension, added_on) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute(array($title, $year,$_SESSION['userID'], $genre_id, $extention, (new DateTime())->format('Y-m-d H:i:s')));
            $id = $db->lastInsertId();

            // the query succeeded, redirect to this very same page
            if ($id !== 0) {
                if(!file_exists($basePath .DIRECTORY_SEPARATOR .$_FILES['coverphoto']['name'])) {
                    move_uploaded_file($_FILES['coverphoto']['tmp_name'], $basePath .DIRECTORY_SEPARATOR . $id . '.' . $extention) or die($formErrors[] = 'Error saving file');
                }
                header('location: index.php');
                exit();
            }

            // the query failed
            else {
                $formErrors[] = 'Error while inserting the item. Please retry.';
            }

        }

    }
}
/**
 * Load and render template
 * ----------------------------------------------------------------
 */

$tpl = $twig->loadTemplate('add.twig');
echo $tpl->render(array(
    'user' => $user,
    'errors' => $formErrors,
    'title' => $title,
    'year' => $year,
    'genre_selected' => $genre_id,
    'genres' => $genres

));