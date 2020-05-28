<?php

abstract class Controller 
{
    public function model($model)
    {
        require '..app/models/' . $model . '.php';
    }

    public function view($view)
    {
        if(file_exists('../app/views/' . $view . '.view.php'))
        {
            require_once '../app/views/' . $view . '.view.php';
        }
        else
        {
            die('No view found.');
        }
    }
}
