<?php

namespace App\Infrastructure\Exceptions;

use Framework\Exceptions\ValidationException;
use Framework\Exceptions\EntityNotFoundException;
use Framework\Exceptions\UnauthorizedException;
use Framework\Responses\BadRequestResult;
use Framework\Responses\NotFoundResult;
use Framework\Responses\UnauthorizedResult;

class ExceptionHandler
{
    public static function handle(\Throwable $e)
    {
        return match($e){
            $e instanceof ValidationException => new BadRequestResult(['errors' => $e->getErrors()], $e->getMessage()),
            $e instanceof EntityNotFoundException => new NotFoundResult([], $e->getMessage()),
            $e instanceof UnauthorizedException => new UnauthorizedResult([], $e->getMessage()),
            default => new BadRequestResult([], $e->getMessage())
        };
    }
}