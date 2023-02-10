<?php

class TasksController
{
    public function index($listId = '')
    {
        redirect("lists/index/$listId");
    }

    public function add($listId)
    {
        if (isset($_POST["add_task"])) {
            $taskName = filter_var($_POST["task_name"], FILTER_SANITIZE_STRING);

            $task = new Tasks();
            $task->addNewTask($taskName, $listId);
        }

        $this->index($listId);
    }

    public function state($listId, $taskId)
    {
        $task = new Tasks();
        $state = $task->getTaskState($taskId)['completion_status'];
        $task->updateTaskState($taskId, (int) !$state);

        $this->index($listId);
    }

    public function delete($listId, $taskId)
    {
        $task = new Tasks();
        $task->deleteTask($taskId);

        $this->index($listId);
    }

    public function description($listId, $taskId)
    {
        if (isset($_POST["add_description"])) {
            $description = filter_var($_POST["description"], FILTER_SANITIZE_STRING);
            
            $task = new Tasks();
            $task->updateTaskdescription($taskId, $description);
        }
        $this->index($listId);
    }
}
