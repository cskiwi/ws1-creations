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
$formErrors = array(); // The encountered form errors
$contact = array();
$basePath = __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'avatars'; // C:\wamp\www\vn.an\labo03\images
$baseUrl = 'avatars'; // images
$images = array(); // An array which will hold all our images
$di = new DirectoryIterator($basePath);
$msgGeneral = '';
$continue = true;

/**
 * Handle action
 * ----------------------------------------------------------------
 */
if (isset($_POST['btnOk']) && $_POST['btnOk'] == 'Toevoegen'){
    if (isset($_POST['name']) && $_POST['name'] != ''){
        $contact['name'] = $_POST['name'];
    } else {
        $formErrors[] = 'Please enter a correct name';
    }

    if (isset($_POST['email']) && $_POST['email'] != ''){
        $contact['email'] = $_POST['email'];

    } else {
        $formErrors[] = 'Please enter a correct e-mail';
    }

    if (isset($_POST['role']) && $_POST['role'] != ''){
        $contact['role'] = $_POST['role'];

    } else {
        $formErrors[] = 'Please select a correct role';
    }

    if (isset($_POST['comments']) && $_POST['comments'] != ''){
        $contact['comments'] = $_POST['comments'];
    } else {
        $contact['comments'] = '';
    }

    $stmt = $db->prepare('SELECT sortorder FROM contacts ORDER BY sortorder DESC LIMIT 1');
    $stmt->execute();
    $contact['sortorder'] = $stmt->fetch()['sortorder'] +1 ;

    var_dump($contact);

    if ($formErrors == array()){
        $stmt = $db->prepare('INSERT INTO contacts (name, email, role, comments, sortorder) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute(array($contact['name'], $contact['email'], $contact['role'], $contact['comments'], $contact['sortorder']));

        $id = $db->lastInsertId();
        // check if an image is attached
        if ($_FILES['picture']['size'] <= 0) {
            $continue = false;
        }

        if ($continue) {
            $extention = (new SplFileInfo($_FILES['picture']['name']))->getExtension();
            if (!in_array($extention, array('jpg'))) {
                exit('<p>Invalid extension. Only .jpg allowed</p>');
            }
            if(!file_exists($basePath .DIRECTORY_SEPARATOR .$_FILES['picture']['name'])) {
                move_uploaded_file($_FILES['picture']['tmp_name'], $basePath .DIRECTORY_SEPARATOR .'avatar_' . $id . '.' . $extention) or die($formErrors[] = 'Error saving file');
            }

            echo ($_FILES['picture']['tmp_name']);
        }

        // the query succeeded, redirect to this very same page
        if ($id !== 0) {
            header('location: index.php');
            exit();
        }
    }
    // var_dump($contact);
    // var_dump($_POST);


}

/**
 * No action to handle: show our page itself
 * ----------------------------------------------------------------
 */
$tpl = $twig->loadTemplate('add.tpl');
echo $tpl->render(array(
    'errors' => $formErrors,
    'contact' => $contact
));