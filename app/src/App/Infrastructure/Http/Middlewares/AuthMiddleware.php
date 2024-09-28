<?php

namespace App\Infrastructure\Http\Middlewares;

use Framework\Middleware;
use Framework\Request;
use Framework\Exceptions\UnauthorizedException;

class AuthMiddleware extends Middleware
{
    public function handle(Request $request): Request
    {
        $uri = strtok($request->uri, '?');
        $isLoginOrRegisterRoute = $uri === '/login' || $uri === '/register';
        
        if (!is_array($request->session) || !array_key_exists('logado', $request->session)) {
            if (!$isLoginOrRegisterRoute) {
                throw new UnauthorizedException();
            }
        }

        return parent::handle($request);
    }
}