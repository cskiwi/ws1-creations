<?php

// Bootstrap
require __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';

// Dummy Data
require __DIR__ . DIRECTORY_SEPARATOR . 'data.php';

$app->error(function (\Exception $e, $code) {
    if ($code == 404) {
        return '404 - Not Found! // ' . $e->getMessage();
    } else {
        return 'Shenanigans! Something went horribly wrong // ' . $e->getMessage();
    }
});

// Basic Routing
$app->get('/', function(Silex\Application $app) {
    return $app->redirect($app['request']->getBaseUrl() . '/blogposts');
});

// All URLs starting with /tweets should be handled by the TweetsController
$app->mount('/blogposts', new cskiwi\Provider\Controller\BlogsController($blogposts, $comments, $authors));
$app->mount('/authors', new cskiwi\Provider\Controller\AuthorsController($authors, $blogposts));