<?php

namespace Framework;

use Framework\Response;

use Framework\Middleware;
use Framework\MiddlewareManager;
use Framework\Exceptions\UnauthorizedException;

class ControllerRequestHandler implements RequestHandlerInterface
{
    public function __construct(private Controller $_controller, private string $_action, private array $_middlewares)
    {
    }

    public function handle(Request $request): Response
    {
        try {
            $manager = new MiddlewareManager($this->_middlewares);
            $request = $manager->execute($request);
            $this->_controller->setRequest($request);
            return ($this->_controller)->{$this->_action}();
        } catch (UnauthorizedException $e){
            return $e->unauthorized();
        }
    }
}