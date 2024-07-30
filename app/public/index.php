<?php

require '../vendor/autoload.php';

use Framework\Router;
use Framework\Container;
use Framework\Controller;
use App\Infrastructure\Controller\Home;
use Framework\Dispatcher;
use Framework\Request;

$router = new Router();
$router->get('/home', Home::class, 'index');

$container = new Container();

$dispatcher = new Dispatcher($router, $container);

$request = Request::createFromGlobals();

$response = $dispatcher->handle($request);

$response->send();