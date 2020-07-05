<?php

declare(strict_types=1);

namespace Core;

/**
 * Class Route
 * @package Core
 */
class Route
{
    /**
     * @var array|array[]
     */
    public array $routes = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * Route constructor.
     */
    public function __construct()
    {
        $this->addRoute('GET', '/', 'PagesController@index');
        $this->addRoute('GET', 'about', 'PagesController@about');
        $this->addRoute('GET', '404', 'PagesController@notFound');
    }

    /**
     * @param string $method
     * @param string $url
     * @param string $controller
     *
     * @return void
     */
    private function addRoute(string $method = 'GET', string $url = '/', string $controller = 'PagesController'): void
    {
        $this->routes[$method][$url] = $controller;
    }
}
