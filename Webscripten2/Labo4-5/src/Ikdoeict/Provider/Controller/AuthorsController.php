<?php

namespace Ikdoeict\Provider\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;

class AuthorsController implements ControllerProviderInterface {

	protected $blogposts, $authors;

	function __construct() {

	}

	public function connect(Application $app) {

		//@note $app['controllers_factory'] is a factory that returns a new instance of ControllerCollection when used.
		//@see http://silex.sensiolabs.org/doc/organizing_controllers.html
		$controllers = $app['controllers_factory'];

		// Bind sub-routes
		$controllers->get('/', array($this, 'overview'));
		$controllers->get('/{authorId}/', array($this, 'detail'))->assert('$authorId', '\d+');
		$controllers->get('/{authorId}/blogposts/', array($this, 'posts'))->assert('$authorId', '\d+');

		return $controllers;

	}

	public function overview(Application $app) {

        $authors = $app['db.authors']->findAll();

		return $app['twig']->render('author/overview.twig', array('authors' => $authors));
	}


	public function detail(Application $app, $authorId) {
        $author = $app['db.authors']->find($authorId);
        return $app['twig']->render('author/detail.twig', array('author' => $author));

    }

    public function posts(Application $app, $authorId) {
        $blogposts = $app['db.blogposts']->findByAuthor($authorId);
        return $app['twig']->render('author/blogposts.twig', array('blogposts' => $blogposts));

    }
}