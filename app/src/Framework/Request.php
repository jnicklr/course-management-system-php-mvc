<?php

namespace Framework;

class Request
{
    public function __construct(
        public string $uri,
        public string $method,
        public array $get,
        public array $post,
        public array $files,
        public array $cookies,
        public array $server
    ){}

    public static function createFromGlobals()
    {
        return new static(
            $_SERVER["REDIRECT_URL"],
            $_SERVER["REQUEST_METHOD"],
            $_GET,
            $_POST,
            $_FILES,
            $_COOKIE,
            $_SERVER
        );
    }
}