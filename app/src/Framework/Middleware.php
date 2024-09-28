<?php

namespace Framework;

use Framework\Request;

class Middleware
{
    protected ?Middleware $_next;

    public function setNext(?Middleware $next): void
    {
        $this->_next = $next;
    }

    public function handle(Request $request): Request
    {
        if (!is_null($this->_next)){
            return $this->_next->handle($request);
        }
        return $request;
    }
}