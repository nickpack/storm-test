<?php
/**
 * Created by PhpStorm.
 * User: nickp666
 * Date: 07/04/15
 * Time: 20:36
 */

namespace vendor;

class Router {

    protected $_controller = 'ErrorController';
    protected $_action = 'fourohfour';

    public function __construct()
    {
        if (!$_SERVER['REQUEST_URI']) {
            $this->setController('index')
                 ->setAction('index');
        } else {
            $request_parts = explode('/', $_SERVER['REQUEST_URI']);

            array_shift($request_parts);

            $this->setController($request_parts[0])
                 ->setAction($request_parts[1]);
        }
    }

    public function getController()
    {
        return $this->_controller;
    }

    public function setController($controller)
    {
        $this->_controller = sprintf('%sController', ucfirst($controller));

        return $this;
    }

    public function getAction()
    {
        return $this->_action;
    }

    public function setAction($action)
    {
        $this->_action = $action;

        return $this;
    }

    public function route()
    {
        $controller_name = sprintf('\app\controllers\%s', $this->getController());

        try {

            // Eurrrgh, PHP is still a bit flaky on the autoloading side
            if (!class_exists($controller_name)) {
                $controller = new \app\controllers\ErrorController();
                $controller->fivehundred('Controller does not exist');
            }

            $action = $this->getAction();
            $controller = new $controller_name;

            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                $controller = new \app\controllers\ErrorController();
                $controller->fivehundred('Controller action does not exist');
            }

        } catch (\LogicException $e) {
            $controller = new \app\controllers\ErrorController();
            $controller->fivehundred('Controller does not exist');
        }
    }
}