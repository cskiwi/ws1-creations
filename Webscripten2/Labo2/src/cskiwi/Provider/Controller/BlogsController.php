<?php

namespace cskiwi\Provider\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;

class BlogsController implements ControllerProviderInterface {

    protected $blogs;
    protected $comments;
    protected $authors;

	function __construct($data, $data2, $data3) {
        $this->blogs = $data;
        $this->comment = $data2;
        $this->authors = $data3;
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
		foreach ($this->blogs as $id => $blog) {
            $output .= '<li><a href="' . $app['request']->getBaseUrl(). '/authors/' . $app->escape($id) . '">&para;</a> ' . $blog['content'] . '<br />&mdash; by ' . $app->escape($this->authors[$blog['author_id']]['firstname'])  .' <i>' . $app->escape($blog['date']) . '</i></li>';
		}
		$output .= '</ul>';
		return $output;
	}


	public function detail(Application $app, $id) {
		if (!isset($this->blogs[$id])) {
			$app->abort(404, "blog $id does not exist");
		}
        $blog = $this->blogs[$id];
        $author = $this->authors[$blog['author_id']];
		$output = '<p>On ' . $blog['date'] . ' ' . $app->escape($author['firstname']) . ' ' . $app->escape($author['lastname']) .' bloged:</p><blockquote>' . $blog['content'] . '</blockquote><p><a href="' . $app['request']->getBaseUrl(). '/blogs">&larr; Back to overview</a></p>';
		return $output;
	}

}