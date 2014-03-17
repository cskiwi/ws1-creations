<?php

namespace Ikdoeict\Provider\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;

class BlogController implements ControllerProviderInterface {

    protected $blogposts, $authors, $comments;

    function __construct() {
    }

    public function connect(Application $app) {

        //@note $app['controllers_factory'] is a factory that returns a new instance of ControllerCollection when used.
        //@see http://silex.sensiolabs.org/doc/organizing_controllers.html
        $controllers = $app['controllers_factory'];

        // Bind sub-routes
        $controllers->get('/', array($this, 'overview'));
        $controllers->get('/{blogpostId}/', array($this, 'detail'))->assert('blogpostId', '\d+');
        $controllers->get('/{blogpostId}/comments/', array($this, 'comments'))->assert('blogpostId', '\d+');

        return $controllers;

    }


    public function overview(Application $app) {

        $blogposts = $app['db.blogposts']->findAll();
        return $app['twig']->render('blogposts/overview.twig', array('blogposts' => $blogposts));
    }

    public function detail(Application $app, $blogpostId) {

        $blogpost = $app['db.blogposts']->find($blogpostId);
        return $app['twig']->render('blogposts/detail.twig', array('blogpost' => $blogpost));

    }

    public function comments(Application $app, $blogpostId) {
        $comments = $app['db.blogposts']->findComments($blogpostId);

        $blogpost = $app['db.blogposts']->find($blogpostId);

        return $app['twig']->render('blogposts/comments.twig', array('comments' => $comments, 'blogpost' => $blogpost));
    }



}