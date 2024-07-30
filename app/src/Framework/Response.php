<?php

namespace Framework;

class Response
{
    private string $body;
    private array $headers = [];
    private int $status_code = 0;

    public function setStatusCode(int $status_code): void
    {
        $this->status_code = $status_code;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function addHeader(string $header): void
    {
        $this->headers[] = $header;
    }

    public function redirect(string $url): void
    {
        $this->addHeader("Location: $url");
    }

    public function send(): void
    {
        if ($this->status_code) {
        
            http_response_code($this->status_code);
        }

        foreach ($this->headers as $header) {

            header($header);
        }

        echo $this->body;
    }
}