<?php

session_start();
// session_set_cookie_params(['cookie_lifetime' => 7689600]);

class Users extends DB
{
    private $table = 'users';
    private $conn;

    public function __construct()
    {
        $this->conn = $this->connect();
    }

    public function addNewUser($firstName, $lastName, $userName, $email, $password)
    {
        $q = "INSERT INTO $this->table (
                                        first_name,
                                        last_name,
                                        user_name,
                                        email,
                                        pass) 
                                        VALUE(
                                             '$firstName',
                                             '$lastName',
                                             '$userName',
                                             '$email',
                                             SHA1('$password'));";
        $this->conn->exec($q);

        $_SESSION["username"] = $userName;
    }

    public function getUser($userName, $password)
    {
        $q = "SELECT first_name, user_name FROM $this->table WHERE (user_name = '$userName' OR email = '$userName') AND pass = SHA1('$password')";
        return $this->conn->query($q)->fetch();
    }

    public function getUserID()
    {
        $userName = $_SESSION["username"];
        $q = "SELECT user_id as id FROM $this->table WHERE user_name = '$userName' ;";
        return $this->conn->query($q)->fetch()['id'];
    }

    public function getUsename($usename)
    {
        $q = "SELECT user_name FROM $this->table WHERE user_name = '$usename' ;";
        return $this->conn->query($q)->fetchAll();
    }

    public function getEmail($email)
    {
        $q = "SELECT email FROM $this->table WHERE email = '$email' ;";
        return $this->conn->query($q)->fetchAll();
    }
}
