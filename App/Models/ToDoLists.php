<?php

class ToDoLists extends DB{
    private $table = 'todolist';
    private $user;
    private $conn;

    public function __construct()
    {
        $user = new Users();
        
        if(isset($_SESSION["username"])){
            $this->conn = $this->connect();
            $this->user = $user->getUserID();
        } else{
            redirect('Users' . DS . 'login');
            exit();
        }
    }

    public function addNewList($listTitle)
    {
        $q      = "INSERT INTO 
                        $this->table (
                        list_title, 
                        user_id) 
                    VALUE(
                        ?,
                        ?);";
        
        $stmt   = $this->conn->prepare($q);
        $stmt->execute([$listTitle, $this->user]);

        return $stmt;
    }

    public function checkTitle($title){
        $q      = "SELECT 
                        list_id 
                    FROM 
                        $this->table 
                    WHERE 
                        list_title = ? 
                    AND 
                        user_id = ?;";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([$title, $this->user]);

        return $stmt->fetch();
    }

    public function getAllLists()
    {
        $q      = "SELECT * FROM 
                        $this->table 
                    WHERE 
                        user_id = :id;";

        $stmt   = $this->conn->prepare($q);
        $stmt->bindParam(":id", $this->user);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getList($listID)
    {
        $q      = "SELECT 
                        list_id, 
                        list_title 
                    FROM 
                        $this->table 
                    WHERE 
                        list_id = ? 
                    AND 
                        user_id = ?;";
        
        $stmt   = $this->conn->prepare($q);
        $stmt->execute([$listID, $this->user]);

        return $stmt->fetch();
    }

    public function getLastList()
    {
        $q      = "SELECT 
                        list_id, 
                        list_title 
                    FROM 
                        $this->table 
                    WHERE 
                        user_id = :id 
                    ORDER BY 
                        list_id 
                    DESC LIMIT 1;";

        $stmt   = $this->conn->prepare($q);
        $stmt->bindParam(":id", $this->user);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function deleteList($listID)
    {
        $q      = "DELETE FROM 
                        $this->table 
                    WHERE 
                        list_id = :id;";

        $stmt   = $this->conn->prepare($q);
        $stmt->bindParam(":id", $listID);
        $stmt->execute();

        return $stmt;
    }
}