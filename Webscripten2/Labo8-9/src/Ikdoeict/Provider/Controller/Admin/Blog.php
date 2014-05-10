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

        return $controllers;

    }

    public function overview(Application $app) {

        // Get blogposts
        $blogposts = $app['db.blog']->findAllForAuthor($app['session']->get('user')['id']);

        // Render template
        return $app['twig']->render('admin/blog/overview.twig', array(
            'user' => $app['session']->get('user'),
            'blogposts' => $blogposts,
            'feedback' => $app['request']->get('feedback')
        ));

    }


    public function edit(Application $app, $blogpostId) {
        // Fetch blogpost with given $blogPostId and logged in user Id
        $blogpost = $app['db.blog']->findForAuthor($blogpostId, $app['session']->get('user')['id']);

        // Redirect to overview if it does not exist
        if ($blogpost === false) {
            return $app->redirect($app['url_generator']->generate('admin.blog.overview'));
        }
        $images = @scandir('files/'. $blogpostId);
        unset($images[0]); unset($images[1]);

        if(empty($images)) {
            $images = array(); // empty fix
        }

        // Build the form with the blogpost data as default values
        $editform = $app['form.factory']
            ->createNamed('editform', 'form', $blogpost)
            ->add('title', 'text', array(
                'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5))),
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
            ->add('content', 'textarea', array(
                'constraints' => array(new Assert\NotBlank()),
                'attr' => array(
                    'class' => 'form-control',
                    'rows' => 10
                )
            ))
            ->add('images', 'file', array(
                'attr' => array(
                    'class' => 'form-control',
                    'multiple' => 'multiple',
                    'accept' => 'image/*'
                )
            ))
            ->add('delete', 'choice', array(
                'choices' => $images,
                'multiple' => true,
                'expanded' => true
            ));

        // Form was submitted: process it
        if ('POST' == $app['request']->getMethod()) {
            $editform->bind($app['request']);

            // Form is valid
            if ($editform->isValid()) {

                $data = $editform->getData();
                $files = $app['request']->files->get($editform->getName());
                unset ($data['images']);

                foreach ($files['images'] as $image){
                    // Uploaded file must be `.jpg`!
                    if (isset($image) && ('.jpg' == substr($image->getClientOriginalName(), -4))) {
                        // Move it to its new location
                        $image->move($app['cms.base_path'] . $blogpostId, time().'-'. $image->getClientOriginalName());
                    } else {
                        $editform->get('images')->addError(new \Symfony\Component\Form\FormError('Only .jpg allowed'));
                    }
                }

                if(!empty($data['delete'])) {
                    foreach ($data['delete'] as $picture) {
                        unlink('files/' . $blogpostId . '/' . $images[$picture]);
                    }
                }
                unset($data['photo']);
                unset($data['delete']);

                // Update data in DB
                $app['db.blog']->update($data, array('id' => $blogpostId));

                // Redirect to overview
                return $app->redirect($app['url_generator']->generate('admin.blog.overview') . '?feedback=edited');
            }
        }


        // Render the template with the form
        return $app['twig']->render('admin/blog/edit.twig', array(
            'user' => $app['session']->get('user'),
            'blogpost' => $blogpost,
            'editform' => $editform->createView(),
        ));

    }


    public function delete(Application $app, $blogpostId) {

        // Fetch blogpost with given $blogPostId and logged in user Id
        $blogpost = $app['db.blog']->findForAuthor($blogpostId, $app['session']->get('user')['id']);

        // Redirect to overview if it does not exist
        if ($blogpost === false) {
            return $app->redirect($app['url_generator']->generate('admin.blog.overview'));
        }

        // Delete the blogpost
        $app['db.blog']->delete(array('id' => $blogpostId));

        // Redirect to overview
        return $app->redirect($app['url_generator']->generate('admin.blog.overview') . '?feedback=deleted');

    }

    public function add(Application $app) {

        // Build the form
        $addform = $app['form.factory']
            ->createNamed('addform', 'form')
            ->add('title', 'text', array(
                'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5))),
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
            ->add('content', 'textarea', array(
                'constraints' => array(new Assert\NotBlank()),
                'attr' => array(
                    'class' => 'form-control',
                    'rows' => 10
                )
            ))
            ->add('images', 'file', array(
                'attr' => array(
                    'class' => 'form-control',
                    'multiple' => 'multiple',
                    'accept' => 'image/*'
                )
            ));
        // Form was submitted: process it
        if ('POST' == $app['request']->getMethod()) {

            // error
            $addform->bind($app['request']);

            // Form is valid
            if ($addform->isValid()) {

                // Extract data from form
                $data= $addform->getData();

                // Inject extra fields into data
                $data['author_id'] = $app['session']->get('user')['id'];
                $data['date'] = (new \DateTime('now', new \DateTimeZone('UTC')))->format('Y-m-d H:i:s');
                $data['numcomments']= 0;

                $files = $app['request']->files->get($addform->getName());
                unset ($data['images']);
                $app['db.blog']->insert($data);

                $id = $app['db.blog']->lastID();


                foreach ($files['images'] as $image){
                    // Uploaded file must be `.jpg`!
                    if (isset($image) && ('.jpg' == substr($image->getClientOriginalName(), -4))) {
                        // Move it to its new location
                        $image->move($app['cms.base_path'] . $id, time().'-'. $image->getClientOriginalName());
                    } else {
                        $addform->get('images')->addError(new \Symfony\Component\Form\FormError('Only .jpg allowed'));
                    }
                }

                // Redirect to overview
                return $app->redirect($app['url_generator']->generate('admin.blog.overview') . '?feedback=added');

            }

        }

        // Render the template with the form
        return $app['twig']->render('admin/blog/add.twig', array(
            'user' => $app['session']->get('user'),
            'addform' => $addform->createView()
        ));

    }

    public function checkLogin(\Symfony\Component\HttpFoundation\Request $request, Application $app) {
        if (!$app['session']->get('user')) {
            return $app->redirect($app['url_generator']->generate('admin.auth.login'));
        }
    }

}