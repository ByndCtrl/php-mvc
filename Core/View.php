<?php

declare(strict_types=1);

namespace Core;

/**
 * Class View
 * @package Core
 */
class View
{
    /**
     * @param string $view
     * @param array $data
     * @param array $errors
     *
     * @return void
     */
    public function render(string $view, array $data = [], array $errors = []): void
    {
        ob_start();

        extract($data);

        if (isset($errors) && $errors != null)
        {
            extract($errors);
        }

        try
        {
            require APP_ROOT . "Views/$view.view.php";
        }
        catch (\Exception $exception)
        {
            require APP_ROOT . "Views/Pages/404.view.php";
        }

        echo ob_get_clean();
    }
}
