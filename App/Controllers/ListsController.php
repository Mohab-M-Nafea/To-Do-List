<?php

class ListsController
{
    /**
     * get all lists for current user and tasks for current list
     * @param $listId id for list to get all task for specific list or get last list if no id pass
     */
    public function index($listId = '')
    {
        $lists = new ToDoLists();
        $data['lists'] = $lists->getAllLists();

        // check if user have at least one list
        if (!empty($data['lists'])) {
            $currentList = $listId === '' ? $lists->getLastList() : $lists->getList($listId);

            // check if current list is exist to get tasks of it
            if(isset($currentList['list_id'])){
                $data['currentList'] = $currentList;

                $task = new Tasks();
                $data['tasks'] = $task->getAllTasks($currentList['list_id']);
            } else{
                View::load("error", ['pageName' => 'Error', "nav" => ['login', 'sign up']]);
            }

            $data['pageName'] = $currentList['list_title'];
        } else{
            $data['pageName'] = 'To Do List';
        }

        View::load('List' . DS . "list", $data);
    }

    /**
     * add new list to database when requset method post send
     */
    public function add()
    {
        if (isset($_POST["add_list"])) {
            $listTitle = filter_var($_POST["list_title"], FILTER_SANITIZE_STRING);

            $lists = new ToDoLists();
            $lists->addNewList($listTitle);

            $this->index();
        } else{
            $this->index();
        }
    }

    /**
     * delete list from database if list is exist
     * @param $listId id of list need to delete it
     */
    public function delete($listId)
    {
        $list = new ToDoLists();
        
        if($list->deleteList($listId)){
            $this->index();
        } else{
            View::load('error', ['pageName' => 'Error', "nav" => ['login', 'sign up']]);
        }
    }
}
