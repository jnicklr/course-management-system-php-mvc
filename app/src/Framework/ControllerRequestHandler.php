<?php

namespace Framework;

use Framework\Response;

class ControllerRequestHandler implements RequestHandlerInterface
{
    public function __construct(private Controller $controller, private string $action)
    {
    }

    public function handle(Request $request): Response
    {
        $this->controller->setRequest($request);

        return ($this->controller)->{$this->action}();
    }
}