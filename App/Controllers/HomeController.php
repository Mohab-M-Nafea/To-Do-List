<?php

class HomeController{

    public function index(){
        View::load('index', ["pageName" => 'To Do List', "nav" => ['login', 'sign up']]);
    }
}