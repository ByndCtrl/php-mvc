<?php

declare(strict_types=1);

namespace Core;

use \Exception;

/**
 * Class Router
 * @package Core
 */
class Router
{
    /**
     * @var Request|null
     */
    private ?Request $request = null;
    /**
     * @var Route|null
     */
    private ?Route $route = null;

    /**
     * Router constructor.
     * @param Route $route
     * @param Request $request
     */
    public function __construct(Route $route, Request $request)
    {
        $this->request = $request;
        $this->route = $route;
    }

    /**
     * @param string $requestMethod
     * @param string $url
     *
     * @return Controller|void|null
     * @throws Exception
     */
    public function direct(string $requestMethod, string $url)
    {
        if (array_key_exists($url, $this->route->routes[$requestMethod]))
        {
            $this->dispatch(...explode('@', $this->route->routes[$requestMethod][$url]));
        }
        else
        {
            $this->dispatch(...explode('@', $this->route->routes[$requestMethod]['404']));
        }
    }

    /**
     * @param string $controller
     * @param string $action
     *
     * @return void
     * @throws Exception
     */
    public function dispatch(string $controller, string $action): void
    {
        $controller = '\App\Controllers\\' . $controller;

        if (!class_exists($controller))
        {
            throw new Exception("{$controller} does not exist.");
        }

        $controller = new $controller();

        if (!method_exists($controller, $action))
        {
            throw new Exception("{$controller} does not respond to {$action} action.");
        }

        $controller->$action();
    }
}
