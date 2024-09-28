<?php

namespace Framework\Exceptions;

use Exception;

class ValidationException extends Exception
{
    protected $errors;

    public function __construct(
        array $errors, 
        string $message = "There was a failure in the validation of the data.",
        int $code = 0,
        Exception $previous= null)
    {
        $this->errors = $errors;
        parent::__construct($message, $code, $previous);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}