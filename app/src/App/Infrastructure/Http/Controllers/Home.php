<?php

namespace App\Infrastructure\Http\Controllers;

use Framework\Controller;
use Framework\Response;

class Home extends Controller
{
    public function index(): Response
    {
        return $this->view('index');
    }
}