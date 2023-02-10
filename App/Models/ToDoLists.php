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

    public function getAllLists()
    {
        $q = "SELECT * FROM $this->table WHERE user_id = $this->user";
        return $this->conn->query($q)->fetchAll();
    }

    public function addNewList($listTitle)
    {
        $q = "INSERT INTO $this->table (list_title, user_id) VALUE('$listTitle', $this->user);";
        return $this->conn->exec($q);
    }

    public function getList($listID)
    {
        $q = "SELECT list_id, list_title FROM $this->table WHERE list_id = $listID AND user_id = $this->user";
        return $this->conn->query($q)->fetch();
    }

    public function getLastList()
    {
        $q = "SELECT list_id, list_title FROM $this->table WHERE user_id = $this->user ORDER BY list_id DESC LIMIT 1";
        return $this->conn->query($q)->fetch();
    }

    public function deleteList($listID)
    {
        $q = "DELETE FROM $this->table WHERE list_id = $listID";
        return $this->conn->exec($q);
    }
}