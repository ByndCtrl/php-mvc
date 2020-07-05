<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use Core\View;

/**
 * Class PagesController
 */
class PagesController extends Controller
{
    private ?View $view = null;

    public function __construct()
    {
        parent::__construct();
        $this->view = new View();
    }

    public function index()
    {
        $data =
            [
                'title' => 'Home'
            ];

        $this->view->render('Pages/Index', $data);
    }

    public function about()
    {
        $data =
            [
                'title' => 'About'
            ];

        $this->view->render('Pages/About', $data);
    }

    public function notFound()
    {
        $data = [
            'title' => '404'
        ];

        $this->view->render('Pages/404', $data);
    }
}
