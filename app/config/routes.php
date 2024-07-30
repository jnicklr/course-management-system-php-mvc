<?php

use Framework\Router;
use App\Infrastructure\Http\Controllers\Home;

$router = new Router();
$router->get('/home', Home::class, 'index');

return $router;