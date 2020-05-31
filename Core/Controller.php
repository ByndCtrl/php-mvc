<?php

namespace Core;

abstract class Controller 
{
    public function model($model)
    {
        require '../App/Models/' . $model . '.php';
    }

    public function view($view)
    {
        if(file_exists('../App/Views/' . $view . '.view.php'))
        {
            require_once '../App/Views/' . $view . '.view.php';
        }
        else
        {
            die('No view found.');
        }
    }
}
