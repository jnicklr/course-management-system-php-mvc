<?php

namespace Framework;

use Framework\Router;
use Framework\Response;
use Framework\TemplateViewer;

class Dispatcher
{
    public function __construct(private Router $router, private Container $container)
    {

    }

    public function handle(Request $request): Response
    {
        $route = $this->router->match($request->uri, $request->method);

        $controller = $this->container->build($route['controller']);

        $controller->setViewer($this->container->build(TemplateViewer::class));
        $controller->setResponse($this->container->build(Response::class));

        $controller_handler = new ControllerRequestHandler($controller, $route['action']);

        return $controller_handler->handle($request);
    }
}