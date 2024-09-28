<?php

namespace Framework\Exceptions;

use Framework\Response;
use Exception;

class EntityNotFoundException extends Exception
{
    protected $errors;

    public function __construct(
        string $message = "The object was not found.",
        int $code = 403,
        Exception $previous= null)
    {
        parent::__construct($message, $code, $previous);
    }
}