<?php

namespace Framework;

use Framework\Middleware;
use Framework\Request;

class MiddlewareManager
{
    private array $_middlewares = [];

    public function __construct(array $middlewares)
    {
        $this->_middlewares = $middlewares;
    }

    public function execute(Request $request): Request
    {
        if (empty($this->_middlewares)) {
            return $request;
        }

        $middleware = array_reduce(
            array_reverse($this->_middlewares), 
            function(?Middleware $next, Middleware $current){
                $current->setNext($next);
                return $current;
        }, null);

        if ($middleware){
            return $middleware->handle($request);
        }

        return $request;
    }
}