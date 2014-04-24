<?php

namespace Ikdoeict\Provider\Controller\Admin;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;
use Symfony\Component\Validator\Constraints as Assert;

class Authentication implements ControllerProviderInterface {

	public function connect(Application $app) {

		// Create new ControllerCollection
		$controllers = $app['controllers_factory'];

		// Login
		$controllers
			->match('/login/', array($this, 'login'))
			->method('GET|POST')
			->bind('admin.auth.login');

		// Logout
		$controllers
			->get('/logout/', array($this, 'logout'))
			->bind('admin.auth.logout');

		// Redirect to login by default
		$controllers->get('/', function(Application $app) {
			return $app->redirect($app['url_generator']->generate('auth.login'));
		});

		return $controllers;

	}

	public function login(Application $app) {

		// Already logged in
		if ($app['session']->get('user')) {
			return $app->redirect($app['url_generator']->generate('admin.blog.overview'));
		}

		// Create Form
		$loginform = $app['form.factory']->createNamed('loginform')
			->add('email', 'email', array(
				'constraints' => array(new Assert\NotBlank(), new Assert\Email())
			))
			->add('password', 'password', array(
				'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5)))
			));

		// Form was submitted: process it
		if ('POST' == $app['request']->getMethod()) {
			$loginform->bind($app['request']);

			// Form is valid
			if ($loginform->isValid()) {

				$data = $loginform->getData();
				$user = $app['db.authors']->findAuthorByEmail($data['email']);

				// Password checks out
				if (crypt($data['password'], $user['password']) === $user['password'] ) {

					// Unset user password from record so that no-one can read the (encrypted) password from the session
					unset($user['password']);

					// Store user in session
					$app['session']->set('user', $user);

                    // Redirect to admin index
					return $app->redirect($app['url_generator']->generate('admin.index'));

				}

                // Password does not check out: add an error to the form
                else {

					$loginform->get('password')->addError(new \Symfony\Component\Form\FormError('Invalid credentials'));

				}
			}
		}

		return $app['twig']->render('admin/auth/login.twig', array('user' => null, 'loginform' => $loginform->createView()));
	}


	public function logout(Application $app) {
		$app['session']->remove('user');
		return $app->redirect($app['url_generator']->generate('admin.index'));
	}

}