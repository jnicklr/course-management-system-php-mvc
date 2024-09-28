<?php

namespace Framework\Responses;

use Framework\IActionResult;
use Framework\Response;

class RedirectResult implements IActionResult
{
    private int $_code;
    private string $_uri;
    private array $_headers;
    private Response $_response;

    public function __construct($uri, $headers = [])
    {
        $this->_code = 302;
        $this->_uri = $uri;
        $this->_headers = $headers;
        $this->_response = new Response();
    }

    public function redirect(string $uri)
    {
        $this->_code = 302;
        $this->_response->redirect($uri);
        return $this;
    }

    public function toResponse(): Response
    {
        $this->_response->redirect($this->_uri);
        $this->_response->setStatusCode($this->_code);
        
        if (!empty($this->_headers)){
            foreach($this->_headers as $header){
                $this->_response->addHeader($header);
            }
        }
        var_dump($this->_response);
        return $this->_response;
    }
}