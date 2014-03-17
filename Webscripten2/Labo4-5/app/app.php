<?php

// Bootstrap
require __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';


$app->error(function (\Exception $e, $code) {
	if ($code == 404) {
		return '404 - Not Found! // ' . $e->getMessage();
	} else {
		return 'Shenanigans! Something went horribly wrong // ' . $e->getMessage();
	}
});

$app->get('/', function(Silex\Application $app) {
	return $app->redirect($app['request']->getBaseUrl() . '/blogposts');
});

// Mount our ControllerProviders
$app->mount('/blogposts', new Ikdoeict\Provider\Controller\BlogController());
$app->mount('/authors', new Ikdoeict\Provider\Controller\AuthorsController());