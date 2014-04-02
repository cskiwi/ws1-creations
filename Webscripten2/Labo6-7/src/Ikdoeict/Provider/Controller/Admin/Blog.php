<?php

namespace Ikdoeict\Provider\Controller\Admin;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;
use Symfony\Component\Validator\Constraints as Assert;

class Blog implements ControllerProviderInterface {

    public function connect(Application $app) {

        // Create new ControllerCollection
        $controllers = $app['controllers_factory'];

        // Overview of blogposts
        $controllers
            ->get('/', array($this, 'overview'))
            ->before(array($this, 'checkLogin'))
            ->bind('admin.blog.overview');

        // Insert new blogpost
        $controllers
            ->match('/new/', array($this, 'add'))
            ->method('GET|POST')
            ->before(array($this, 'checkLogin'))
            ->bind('admin.blog.add');

        // Update a blogpost
        $controllers
            ->match('/{blogpostId}/', array($this, 'edit'))
            ->assert('blogpostId', '\d+')
            ->method('GET|POST')
            ->before(array($this, 'checkLogin'))
            ->bind('admin.blog.edit');

        // Delete a blogpost
        $controllers
            ->post('/{blogpostId}/delete/', array($this, 'delete'))
            ->assert('blogpostId', '\d+')
            ->before(array($this, 'checkLogin'))
            ->bind('admin.blog.delete');

        // Delete a comment
        $controllers
            ->post('/{commentId}/delete/', array($this, 'deleteComment'))
            ->assert('commentId', '\d+')
            ->before(array($this, 'checkLogin'))
            ->bind('admin.comment.delete');
        return $controllers;

    }

    public function overview(Application $app) {
        // @TODO
        // + Fetch all blogposts by logged in user
        // + Render template with the blogposts

        $user = $app['session']->get('user');
        $blogs = $app['db.blog']->findAllByAuthor($user['id']);

        return $app['twig']->render('admin/blog/overview.twig', array(
            'user' => $user,
            'blogposts' => $blogs
        ));

    }


    public function edit(Application $app, $blogpostId) {
        // @TODO
        // + Fetch blogpost with given $blogPostId and logged in user Id
        // + Redirect to overview if it does not exist
        // + Build the form with the blogpost data as default values
        // + If the form was submitted:
        //     - Update data into DB if the form is valid
        //     + If the update succeeded: redirect to overview
        // + Render the template with the form
        $blog = $app['db.blog']->find($blogpostId);
        $user = $app['session']->get('user');
        if($blog) {
            if ($blog['author_id'] == $user['id']){
                $comments = $app['db.blog']->findComments($blogpostId);

                $addBlogpostForm = $app['form.factory']->createNamed('addBlogpostform', 'form', $blog)
                    ->add('title', 'text', array(
                        'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5))),
                        'label' => 'The Title'
                    ))
                    ->add('content', 'textarea', array(
                        'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 20))),
                        'label' => 'The Content'
                    ));


                if ($app['request']->getMethod() == 'POST'){
                    $addBlogpostForm->bind($app['request']);

                    if($addBlogpostForm->isValid()){
                        $data = $addBlogpostForm->getData();
                        // var_dump($data); var_dump($user);die();

                        // inject extra fields needed for database
                        $app['db.blog']->update(
                            array(
                                'id' => $data['id']
                            ),
                            array(
                                'title' => $data['title'],
                                'content' => $data['content']
                            ));

                        return $app->redirect($app['url_generator']->generate('admin.blog.overview'));
                    }
                }
            }


            return $app['twig']->render('admin/blog/edit.twig', array(
                'user' => $user,
                'addBlogpostform' => $addBlogpostForm->createView(),
                'blog' => $blog,
                'comments' => $comments
            ));
        }
        return $app->redirect($app['url_generator']->generate('admin.blog.overview'));

    }

    public function delete(Application $app, $blogpostId) {
        // @TODO:
        // + Fetch blogpost with given $blogPostId and logged in user Id
        // + Redirect to overview if it does not exist
        // + Delete the blogpost
        $blog = $app['db.blog']->find($blogpostId);
        if($blog){
            if ($blog['author_id'] ==  $app['session']->get('user')['id']){
                $app['db.blog']->delete(array('id' => $blog['id']));
            }
        }
        // Redirect to overview
        return $app->redirect($app['url_generator']->generate('admin.blog.overview'));

    }
    public function deleteComment(Application $app, $blogpostId) {

    }

    public function add(Application $app) {
        //
        // + Build the form
        // + If the form was submitted:
        //     + Insert data into DB if the form is valid
        //     + If the insertion succeeded: redirect to overview
        // + Render the template with the form

        $addBlogpostForm = $app['form.factory']->createNamed('addBlogpostform', 'form')
            ->add('title', 'text', array(
                'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5))),
                'label' => 'The Title'
            ))
            ->add('content', 'textarea', array(
                'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 20))),
                'label' => 'The Content'
            ));


        if ($app['request']->getMethod() == 'POST'){
            $addBlogpostForm->bind($app['request']);

            if($addBlogpostForm->isValid()){
                $data = $addBlogpostForm->getData();

                // inject extra fields needed for database
                $data['author_id'] = $app['session']->get('user')['id'];
                $data['date'] = date('Y-m-d');
                $data['numcomments'] = 0;

                $app['db.blog']->insert($data);
                return $app->redirect($app['url_generator']->generate('admin.blog.overview'));
            }
        }

        return $app['twig']->render('admin/blog/add.twig',array(
            'user' => $app['session']->get('user'),
            'addBlogpostform' => $addBlogpostForm->createView()
        ));

    }

    public function checkLogin(\Symfony\Component\HttpFoundation\Request $request, Application $app) {

        // @TODO: remove this little snippet once we've actually built in authentication
        $app['session']->set('user', array(
            'id' => 1,
            'firstname' => 'Bramus'
        ));

        if (!$app['session']->get('user')) {
            return $app->redirect($app['url_generator']->generate('admin.auth.login'));
        }
    }

}