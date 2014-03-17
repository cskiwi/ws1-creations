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
        $this->comments = $data2;
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
        foreach ($this->blogs as $blog_id => $blog) {
            $author = $this->authors[$blog['author_id']];
            $output .= '<article><h2> <a href="'. $blog_id .'">'. $app->escape($blog['title']) .'</a></h2> by <a href="'.$app['request']->getBaseUrl(). '/authors/'. $app->escape($blog['author_id']) .'">' . $app->escape($author['firstname']) . ' ' . $app->escape($author['lastname']) . '</a> on ' . $app->escape($blog['date']) . $blog['content'] .'</article>';
            // $output .= '<li><a href="' . $app['request']->getBaseUrl(). '/authors/' . $app->escape($id) . '">&para;</a> ' . $blogposts['content'] . '<br />&mdash; by ' . $app->escape($author['firstname'])  .' <i>' . $app->escape($blogposts['date']) . '</i></li>';
        }
        $output .= '</ul>';
        return $output;
    }


    public function detail(Application $app, $id) {
        if (!isset($this->blogs[$id])) {
            $app->abort(404, "blogposts $id does not exist");
        }
        $blog = $this->blogs[$id];
        $author = $this->authors[$blog['author_id']];
        $output = '<article><h2>'. $app->escape($blog['title']) .'</h2> by <a href="'.$app['request']->getBaseUrl(). '/authors/'. $app->escape($blog['author_id']).'">' .$app->escape($author['firstname']) . ' ' .$app->escape($author['lastname']) . '</a> on ' . $app->escape($blog['date']) . $blog['content'] .'</article>';
        $output .= '<h3>Comments</h3><ul>';
        foreach ($this->comments as $comment) {
            if ($app->escape($comment['blogpost_id']) == $id) {
                $output .= '<li>by ' . $app->escape($comment['author']) . '</a> on ' . $app->escape($comment['date']) . $comment['content'] .'</li>';
            }
            // $output .= '<li><a href="' . $app['request']->getBaseUrl(). '/authors/' . $app->escape($id) . '">&para;</a> ' . $blogposts['content'] . '<br />&mdash; by ' . $app->escape($author['firstname'])  .' <i>' . $app->escape($blogposts['date']) . '</i></li>';
        }
        $output .= '</ul><a href="' . $app['request']->getBaseUrl(). '/blogposts">&larr; Back to overview</a></p>';
//        $output = '<p>On ' . $blogposts['date'] . ' ' . $app->escape($author['firstname']) . ' ' . $app->escape($author['lastname']) .' bloged:</p><blockquote>' . $blogposts['content'] . '</blockquote><p><a href="' . $app['request']->getBaseUrl(). '/blogs">&larr; Back to overview</a></p>';
        return $output;
    }

}