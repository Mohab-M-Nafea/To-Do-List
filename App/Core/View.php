<?php

class View
{

    public static function load($viewName, $viewData = [])
    {
        $file = VIEWS . $viewName . '.php';

        if (!file_exists($file)) {
            $file = VIEWS . 'error.php';
        }
        
        extract($viewData);
        session_abort();

        ob_start();
        require($file);
        ob_flush();
        exit();
    }
}
