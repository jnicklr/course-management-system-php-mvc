<?php

namespace Framework\Exceptions;

use Framework\Response;
use Exception;

class UnauthorizedException extends Exception
{
    protected $errors;

    public function __construct(
        string $message = "The request made is unauthorized.",
        int $code = 403,
        Exception $previous= null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function unauthorized(): Response
    {
        $response = new Response();
        $response->setBody($this->message);
        $response->setStatusCode($this->code);
        $response->redirect('/login');
        return $response;
    }
}