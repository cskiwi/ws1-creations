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

            $output .= '<li> <a href="' . $app['request']->getBaseUrl(). '/authors/' . $app->escape($id) . '">' .$author['firstname'] .' '. $author['lastname'] . '</a></li>';
			// $output .= '<li><a href="' . $app['request']->getBaseUrl(). '/authors/' . $app->escape($id) . '">&para;</a> ' . $app->escape($blogposts['content']) . '<br />&mdash; by ' . $app->escape($this->authors[$blogposts['author_id']]['firstname'])  .' <i>' . $app->escape($blogposts['date']) . '</i></li>';
		}
		$output .= '</ul>';
		return $output;
	}


	public function detail(Application $app, $id) {
		if (!isset($this->authors[$id])) {
			$app->abort(404, "blogposts $id does not exist");
		}
        $author = $this->authors[$id];
		$output = '<blockquote><p>' . $app->escape($author['firstname']) . ' ' . $app->escape($author['lastname']) . '</br >Email: <a href="mailto:'.$app->escape($author['email']).'">' . $app->escape($author['email']) . '</a></br >Website: <a href="'.$app->escape($author['website']).'">' . $app->escape($author['website']) . '</a></br >Location: ' . $app->escape($author['location']) .   '</p></blockquote>';

        $output .= '<p><a href="' . $app['request']->getBaseUrl(). '/blogposts">&larr; Back to overview</a></p>';
		return $output;
	}

}