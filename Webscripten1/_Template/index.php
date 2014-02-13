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
	 * Load twig
	 * ----------------------------------------------------------------
	 */
	
		require_once __DIR__ . '/includes/Twig/Autoloader.php';
		Twig_Autoloader::register();
		$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
		$twig = new Twig_Environment($loader, array('debug' => true));

	// DO WORK HERE !!!!

	/**
	 * Load and render template
	 * ----------------------------------------------------------------
	 */

		$tpl = $twig->loadTemplate('templatenaam.twig');
		echo $tpl->render(array(
			'PHP_SELF' => $_SERVER['PHP_SELF'],
		));