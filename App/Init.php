<?php

declare(strict_types=1);

define('DS', DIRECTORY_SEPARATOR);

// /var/www/html/php-mvc/
define('BASE_ROOT', dirname(__FILE__, 2) . DS);

// /var/www/html/php-mvc/App/
define('APP_ROOT', dirname(__FILE__, 1) . DS);

// /var/www/html/php-mvc/Core/
define('CORE_ROOT', dirname(__FILE__, 2) . DS . 'Core' . DS);

// http://localhost/php-mvc/
define('URL_ROOT', 'http://localhost/php-mvc/');

define('SITE_NAME', 'php-mvc');

mb_internal_encoding("UTF-8");

error_reporting(E_ALL);
ini_set('display_errors', '1');

set_include_path(APP_ROOT);
set_include_path(CORE_ROOT);

spl_autoload_register(function (string $class)
{
    $file = BASE_ROOT . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file))
    {
        require $file;
    }
});
