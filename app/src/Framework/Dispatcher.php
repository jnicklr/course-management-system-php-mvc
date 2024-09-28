<?php

namespace Framework;

use Framework\Router;
use Framework\Response;
use Framework\TemplateViewer;
use Framework\Responses\NotFoundResult;

class Dispatcher
{
    public function __construct(private Router $router, private Container $container, private array $middlewares)
    {

    }

    public function handle(Request $request): Response
    {
        $route = $this->router->match($request->uri, $request->method);

        if (!$route){
            return (new NotFoundResult([], 'Page not found'))->toResponse();
        }
        
        $controller = $this->container->build($route['controller']);

        $controller->setViewer($this->container->build(TemplateViewer::class));
        $controller->setResponse($this->container->build(Response::class));

        $controller_handler = new ControllerRequestHandler($controller, $route['action'], $this->middlewares);

        return $controller_handler->handle($request);
    }
}