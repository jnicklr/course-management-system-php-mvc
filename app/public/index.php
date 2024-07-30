<?php

require '../vendor/autoload.php';

use Framework\Dispatcher;
use Framework\Request;

$router = require __DIR__ . "/../config/routes.php";

$container = require __DIR__ . "/../config/services.php";

$dispatcher = new Dispatcher($router, $container);

$request = Request::createFromGlobals();

$response = $dispatcher->handle($request);

$response->send();