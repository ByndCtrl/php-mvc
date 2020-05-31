<?php

namespace Core;

abstract class Model
{
    protected $db = null;

    public function __construct()
    {
        $this->db = new Database();
    }
}