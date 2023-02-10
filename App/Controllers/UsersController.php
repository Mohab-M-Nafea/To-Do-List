<?php

class UsersController
{
    public function login()
    {
        $user = new Users();

        if (!isset($_SESSION["username"])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST["login"])) {
                    $userName = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
                    $userName = filter_var($userName, FILTER_SANITIZE_EMAIL);
                    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

                    $currentUser = $user->getUser($userName, $password);

                    if (!empty($currentUser)) {
                        $_SESSION["username"] = $currentUser['user_name'];
                        
                    } else{
                        $err_message = 'User name or Password is uncorrect';
                        View:: load('User' . DS . 'login', ['pageName' => 'login', "nav" => ['sign up'], 'err' => $err_message]);
                    }
                }
            } else {
                View::load('User' . DS . 'login', ['pageName' => 'login', "nav" => ['sign up']]);
            }
        }

        redirect('lists/index');
    }

    public function signup()
    {
        $user = new Users();

        if (!isset($_SESSION["username"])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST["signup"])) {
                    $firstName = filter_var($_POST["firstname"], FILTER_SANITIZE_STRING);
                    $lastName = filter_var($_POST["lastname"], FILTER_SANITIZE_STRING);
                    $userName = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
                    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
                    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
                    $confirmPassword = filter_var($_POST["password-confirm"], FILTER_SANITIZE_STRING);

                    if(count($user->getUsename($userName)) > 0){
                        $err_message = 'User name already exist';
                        View::load('User' . DS . 'signup', ['pageName' => 'sign up', "nav" => ['login'], 'err' => $err_message]);
                    }

                    if (count($user->getEmail($email)) > 0) {
                        $err_message = 'Email already exist';
                        View::load('User' . DS . 'signup', ['pageName' => 'sign up', "nav" => ['login'], 'err' => $err_message]);
                    }

                    if ($password === $confirmPassword) {
                        $user->addNewUser($firstName, $lastName, $userName, $email, $password);
                    } else{
                        $err_message = 'Password and confirm Password not the same';
                        View::load('User' . DS . 'signup', ['pageName' => 'sign up', "nav" => ['login'], 'err' => $err_message]);
                    }
                }
            } else {
                View::load('User' . DS .'signup', ['pageName' => 'sign up', "nav" => ['login']]);
            }
        }
        redirect('lists/index');
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        redirect();
    }
}
