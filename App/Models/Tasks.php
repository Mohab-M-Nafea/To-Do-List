<?php

class Tasks extends DB
{
    private $table = 'tasks';
    private $conn;

    public function __construct()
    {
        $this->conn = $this->connect();
    }

    public function getAllTasks($listID)
    {
        $q = "SELECT * FROM $this->table WHERE list_id = $listID";
        return $this->conn->query($q)->fetchAll();
    }

    public function addNewTask($taskName, $listID)
    {
        $q = "INSERT INTO $this->table (task_name, list_id) VALUE('$taskName', $listID);";
        $this->conn->exec($q);
    }

    public function getTaskState($taskID)
    {
        $q = "SELECT completion_status FROM $this->table WHERE task_id = $taskID";
        return $this->conn->query($q)->fetch();
    }

    public function updateTaskState($taskID, $state)
    {
        $q = "UPDATE $this->table SET completion_status = $state WHERE task_id = $taskID";
        $this->conn->exec($q);
    }

    public function deleteTask($taskID)
    {
        $q = "DELETE FROM $this->table WHERE task_id = $taskID";
        return $this->conn->exec($q);
    }

    public function updateTaskdescription($taskID, $description)
    {
        $q = "UPDATE $this->table SET task_description = '$description' WHERE task_id = $taskID";
        $this->conn->exec($q);
    }
}
