<?php

namespace cskiwi\Provider\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;

class AccountController implements ControllerProviderInterface {
    protected $accounts;
    function __construct($data) {
        $this->accounts = $data;
    }

    public function connect(Application $app) {
        //@note $app['controllers_factory'] is a factory that returns a new instance of ControllerCollection when used.
        //@see http://silex.sensiolabs.org/doc/organizing_controllers.html
        $controllers = $app['controllers_factory'];

        $controllers->get('/login', array($this, 'login'));
        $controllers->get('/logout', array($this, 'logout'));

        return $controllers;

    }

    public function login(Application $app) {
        return $output = 'logging in ...';
    }


    public function logout(Application $app) {
        return $output = 'logging out ...';
    }

}