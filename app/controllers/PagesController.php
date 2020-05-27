<?php

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

        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = 
        [
            'title' => 'about',
        ];

        $this->view('pages/about', $data);
    }
}