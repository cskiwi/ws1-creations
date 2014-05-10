<?php

// Bootstrap
require __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';

// Mount our Controllers
$app->mount('/admin/', new Ikdoeict\Provider\Controller\Admin());

// routing
$app->error(function (\Exception $e, $code) {
	if ($code == 404) {
		return '404 - Not Found! // ' . $e->getMessage();
	} else {
		return 'Shenanigans! Something went horribly wrong // ' . $e->getMessage();
	}
});

$app->get('/', function(Silex\Application $app) {
    return $app->redirect($app['url_generator']->generate('admin.blog.overview'));
});


