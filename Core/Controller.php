<?php

declare(strict_types=1);

namespace Core;

use Core\Util\Session;

/**
 * Class Controller
 * @package Core
 */
abstract class Controller
{
    protected ?Session $session = null;

    public function __construct()
    {
        $this->session = new Session();
    }

    /**
     * @param string $location
     */
    protected function redirect(string $location)
    {
        $location = strtolower($location);

        header('Location: ' . URL_ROOT . $location);
        exit;
    }
}
