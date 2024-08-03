<?php

require '../vendor/autoload.php';

use Framework\Dispatcher;
use Framework\Request;

$router = require __DIR__ . "/../config/routes.php";

$container = require __DIR__ . "/../config/services.php";

$dispatcher = new Dispatcher($router, $container);

session_start();

$request = Request::createFromGlobals();

// $uri = strtok($request->uri, '?');
// $isLoginOrRegisterRoute = $uri === '/login' || $uri === '/register';

// if (!array_key_exists('logado', $request->session) && !$isLoginOrRegisterRoute){
//     header('Location: /login');
//     return;
// }

// if (array_key_exists('logado', $request->session) && $request->session['logado'] == true && $isLoginOrRegisterRoute){
//     header('Location: /');
//     return;
// }

$response = $dispatcher->handle($request);

$response->send();