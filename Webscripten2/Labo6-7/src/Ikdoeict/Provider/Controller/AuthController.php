<?php

namespace Ikdoeict\Provider\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;
use Symfony\Component\Validator\Constraints as Assert;

class AuthController implements ControllerProviderInterface {

	public function connect(Application $app) {
		$controllers = $app['controllers_factory'];

		$controllers->get('/', function(Application $app) {
			return $app->redirect($app['url_generator']->generate('admin.auth.login'));
		});

		$controllers->match('/login/', array($this, 'login'))->method('GET|POST')->bind('admin.auth.login');

		$controllers->get('/logout/', array($this, 'logout'))->assert('id', '\d+')->bind('admin.auth.logout');

		return $controllers;
	}

	public function login(Application $app) {

		// Already logged in
		if ($app['session']->get('user')) {
			return $app->redirect($app['url_generator']->generate('admin.index'));
		}

		// Create Form
		$loginform = $app['form.factory']->createNamed('loginform')
			->add('username', 'text', array(
				'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5)))
			))
			->add('password', 'password', array(
				'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5)))
			));

		// Form was submitted: process it
		if ('POST' == $app['request']->getMethod()) {
			$loginform->bind($app['request']);

			if ($loginform->isValid()) {
				$data = $loginform->getData();

                $user = $app['db.authors']->getAuthor($data['username']);
                // var_dump($user); die();
                if(crypt($data['password'], $user['password']) == $user['password']) {
					$app['session']->set('user', array(
						'id' => $user['id'],
						'firstname' => $user['firstname']
					));

					return $app->redirect($app['url_generator']->generate('admin.index'));

				} else {
					$loginform->get('password')->addError(new \Symfony\Component\Form\FormError('Invalid password'));
				}
			}
		}

		return $app['twig']->render('auth/login.twig', array('loginform' => $loginform->createView()));
	}


	public function logout(Application $app) {
		$app['session']->remove('user');
		return $app->redirect($app['url_generator']->generate('admin.auth.login') . '?loggedout');
	}

}