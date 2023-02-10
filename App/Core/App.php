<?php

class App
{
    protected $controller = 'HomeController';
    protected $action = 'index';
    protected $params = [];

    public function __construct()
    {
        $this->prepareUrl();
        $this->render();
    }

    /**
     * URL parsing to get the required controller
     */

    private function prepareUrl()
    {
        $url = $_SERVER["QUERY_STRING"];

        if (!empty($url)) {
            $url = trim($url, "/");
            $url = explode('/', $url);

            // define Controller
            $this->controller = isset($url[0]) ? ucwords($url[0]) . 'Controller' : $this->controller;

            // define Method
            $this->action = isset($url[1]) ? $url[1] : $this->action;

            // define Parameters
            unset($url[0], $url[1]);
            $this->params = !empty($url) ? $url : $this->params;
        }
    }

    /**
     * load required controller and method
     */
    private function render()
    {
        if (class_exists($this->controller)) {
            $controller = new $this->controller;

            if (method_exists($controller, $this->action)) {

                // call controller function
                call_user_func_array([$controller, $this->action], $this->params);
            } else {
                View::load('error', ['pageName' => 'Error', "nav" => ['login', 'sign up']]);
            }
        } else {
            View::load('error', ['pageName' => 'Error', "nav" => ['login', 'sign up']]);
        }
    }
}
