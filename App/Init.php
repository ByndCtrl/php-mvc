<?php

// /var/www/html/php-mvc/
define('BASE_ROOT', dirname(__FILE__, 2) . '/');

// /var/www/html/php-mvc/App
define('APP_ROOT', dirname(__FILE__, 1) . '/');

// http://localhost/php-mvc
define('URL_ROOT', 'http://localhost/php-mvc/');

define('SITE_NAME', 'PHP-MVC');

mb_internal_encoding("UTF-8");

error_reporting(E_ALL);
ini_set('display_errors', 1);

spl_autoload_register(function ($class) 
{
    $file = BASE_ROOT . str_replace('\\', '/', $class) .'.php';

    if (file_exists($file)) 
    {
        require $file;
    }
});