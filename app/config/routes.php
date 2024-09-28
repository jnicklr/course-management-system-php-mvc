<?php

use Framework\Router;
use App\Infrastructure\Http\Controllers\Home;
use App\Infrastructure\Http\Controllers\UserController;

$router = new Router();

$router->get('/home', Home::class, 'index');

$router->get('/login', UserController::class, 'signInView');
$router->post('/login', UserController::class, 'login');

$router->get('/register', UserController::class, 'signUpView');
$router->post('/register', UserController::class, 'register');

return $router;