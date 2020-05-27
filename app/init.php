<?php

require_once 'config/config.php';

mb_internal_encoding("UTF-8");

error_reporting(E_ALL);
ini_set('display_errors', 1);

spl_autoload_register(function($className)
{
    require_once 'core/' . $className . '.php';
});
