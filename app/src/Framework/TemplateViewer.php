<?php

namespace Framework;

class TemplateViewer
{
    public function render($view, $data = []): string
    {   
        extract($data);
        ob_start();
        $path = "/../App/Infrastructure/Views/{$view}.php";
        require_once __DIR__ . $path;
        return ob_get_clean();
    }
}