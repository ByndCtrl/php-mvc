<?php

use Core\Controller;

class PagesController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {    
        $data = 
        [
            'title' => 'Home'
        ];

        $this->view('Pages/index', $data);
    }

    public function about()
    {
        $data = 
        [
            'title' => 'About',
        ];

        $this->view('Pages/about', $data);
    }
}
