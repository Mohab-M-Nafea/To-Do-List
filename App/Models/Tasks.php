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
        $q      = "SELECT * FROM 
                        $this->table 
                    WHERE 
                        list_id = :id;";

        $stmt   = $this->conn->prepare($q);
        $stmt->bindParam(":id", $listID);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function addNewTask($taskName, $listID)
    {
        $q      = "INSERT INTO 
                        $this->table (
                            task_name, 
                            list_id) 
                        VALUE(
                            ?, 
                            ?);";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([$taskName, $listID]);

        return $stmt;
    }

    public function getTaskState($taskID)
    {
        $q      = "SELECT 
                        completion_status 
                    FROM 
                        $this->table 
                    WHERE task_id = :id;";

        $stmt   = $this->conn->prepare($q);
        $stmt->bindParam(":id", $taskID);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function updateTaskState($taskID, $state)
    {
        $q      = "UPDATE 
                        $this->table 
                    SET 
                        completion_status = ? 
                    WHERE 
                        task_id = ?;";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([$state, $taskID]);

        return $stmt;
    }

    public function deleteTask($taskID)
    {
        $q      = "DELETE FROM 
                        $this->table 
                    WHERE 
                        task_id = :id;";

        $stmt   = $this->conn->prepare($q);
        $stmt->bindParam(":id", $taskID);
        $stmt->execute();

        return $stmt;
    }

    public function updateTaskdescription($taskID, $description)
    {
        $q      = "UPDATE 
                        $this->table 
                    SET 
                        task_description = ? 
                    WHERE 
                        task_id = ?;";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([$description, $taskID]);

        return $stmt;
    }
}
