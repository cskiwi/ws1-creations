<?php

// includes & requires
require_once __DIR__ . '/includes/Twig/Autoloader.php';
Twig_Autoloader::register();

// Twig Bootstrap
$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, array(
    'cache' => __DIR__ . '/cache',
    'auto_reload' => true // set to false on production
));

// get folders
$page = isset($_GET['page']) ? $_GET['page'] : '';
$basePath = __DIR__ ; // . DIRECTORY_SEPARATOR .  'ws1-creations';
$dirs = array();
$files = array();


$page == ''?: $basePath .= DIRECTORY_SEPARATOR . $page;
$di = new DirectoryIterator($basePath);


foreach ($di as $d){
    if(!$d->isDot()){
        if ($d->isDir()){
            array_push($dirs, '' . $d);
        }
        if ($d->isFile()){
            array_push($files, array('name' => '' . $d, 'location' => ''. $page . DIRECTORY_SEPARATOR .  $d));
        }
    }
}





// load template
$tpl = $twig->loadTemplate('dir.twig');

// render template with our data
echo $tpl->render(array(
    'dirs' => $dirs,
    'files' => $files
));


// EOF