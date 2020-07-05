<?php

require_once '../App/Init.php';

use Core\Request;
use Core\Route;
use Core\Router;

$request = new Request();
$route = new Route();
$router = new Router($route, $request);

$router->direct($request->getRequestMethod(), $request->getUrl());
