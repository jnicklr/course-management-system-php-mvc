<?php

namespace Framework;

use Framework\Response;

interface IActionResult
{
    public function toResponse(): Response;
}