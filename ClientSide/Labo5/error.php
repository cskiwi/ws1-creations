<?php

	/**
	* Includes
	* ----------------------------------------------------------------
	*/

	// includes
	require_once __DIR__ . DIRECTORY_SEPARATOR . '_lib' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'template.php';

	// build template
	$tpl = new Template(__DIR__  . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'error.tpl');

	// display
	$tpl->display();

// EOF