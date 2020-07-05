<?php

declare(strict_types=1);

namespace Core;

/**
 * Class Request
 * @package Core
 */
class Request
{
    /**
     * @var string|null
     */
    private ?string $url = null;
    /**
     * @var string|null
     */
    private ?string $requestMethod = null;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->url = $this->parseUrl();
        $this->requestMethod = $this->getRequestMethod();
    }

    /**
     * @return string
     */
    private function parseUrl(): string
    {
        if (isset($_GET['url']))
        {
            return $_GET['url'];
        }
        else
        {
            return '/';
        }
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getRequestMethod(): string
    {
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        return $this->requestMethod;
    }
}
