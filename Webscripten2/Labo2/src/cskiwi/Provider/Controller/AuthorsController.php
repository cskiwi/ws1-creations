<?php

namespace cskiwi\Provider\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;

class AuthorsController implements ControllerProviderInterface {

    protected $authors;
    protected $blogs;

	function __construct($data, $data2) {
        $this->authors = $data;
        $this->blogs = $data2;
	}

	public function connect(Application $app) {

		//@note $app['controllers_factory'] is a factory that returns a new instance of ControllerCollection when used.
		//@see http://silex.sensiolabs.org/doc/organizing_controllers.html
		$controllers = $app['controllers_factory'];

		// Bind sub-routes
		$controllers->get('/', array($this, 'overview'));
		$controllers->get('/{id}/', array($this, 'detail'))->assert('id', '\d+');

		return $controllers;

	}

	public function overview(Application $app) {

		$output = '<ul>';
		foreach ($this->authors as $id => $author) {
			// $output .= '<li><a href="' . $app['request']->getBaseUrl(). '/authors/' . $app->escape($id) . '">&para;</a> ' . $app->escape($blog['content']) . '<br />&mdash; by ' . $app->escape($this->authors[$blog['author_id']]['firstname'])  .' <i>' . $app->escape($blog['date']) . '</i></li>';
		}
		$output .= '</ul>';
		return $output;
	}


	public function detail(Application $app, $id) {
		if (!isset($this->authors[$id])) {
			$app->abort(404, "blog $id does not exist");
		}
        $author = $this->authors[$id];
		$output = $app->escape($author['firstname']) . '</blockquote><p><a href="' . $app['request']->getBaseUrl(). '/authors">&larr; Back to overview</a></p>';
		return $output;
	}

}