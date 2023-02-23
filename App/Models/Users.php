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
        $q      = "INSERT INTO 
                        $this->table (
                            first_name,
                            last_name,
                            user_name,
                            email,
                            pass) 
                    VALUE(
                        ?,
                        ?,
                        ?,
                        ?,
                        ?);";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([$firstName, $lastName, $userName, $email, sha1($password)]);

        $_SESSION["username"] = $userName;

        return $stmt;
    }

    public function getUser($userName, $password)
    {
        $q      = "SELECT 
                        first_name, 
                        user_name 
                    FROM 
                        $this->table 
                    WHERE 
                        (user_name = ? OR email = ?) 
                    AND pass = ?;";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([$userName, $userName, sha1($password)]);

        return $stmt->fetch();
    }

    public function getUserData($userName)
    {
        $q      = "SELECT * FROM 
                        $this->table 
                    WHERE 
                        user_name = :username ;";

        $stmt   = $this->conn->prepare($q);
        $stmt->bindParam(':username', $userName);
        $stmt->execute();

        return $stmt;
    }

    public function getUserID()
    {
        $userName = $_SESSION["username"];

        $q      = "SELECT 
                        user_id 
                    as 
                        id 
                    FROM 
                        $this->table 
                    WHERE 
                        user_name = :username ;";

        $stmt   = $this->conn->prepare($q);
        $stmt->bindParam(':username', $userName);
        $stmt->execute();

        return $stmt->fetch()['id'];
    }

    public function getUsename($usename)
    {
        $q      = "SELECT 
                        user_name 
                    FROM 
                        $this->table 
                    WHERE 
                        user_name = :username ;";

        $stmt   = $this->conn->prepare($q);
        $stmt->bindParam(':username', $usename);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function getEmail($email)
    {
        $q      = "SELECT 
                        email 
                    FROM 
                        $this->table 
                    WHERE 
                        email = :email ;";

        $stmt   = $this->conn->prepare($q);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function updateUserData($firstName, $lastName, $username, $email, $pass)
    {
        $q      = "UPDATE 
                        $this->table 
                    SET 
                        first_name = ?,
                        last_name = ?, 
                        user_name = ?,
                        email      = ?,
                        pass       = ?
                    WHERE 
                        user_id = ?;";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([$firstName, $lastName, $username, $email, $pass, $this->getUserID()]);

        return $stmt;
    }
}
