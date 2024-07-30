<?php

namespace App\Infrastructure\Controller;

use Framework\Controller;
use Framework\Response;

class Home extends Controller
{
    public function index(): Response
    {
        return $this->view('index');
    }
}