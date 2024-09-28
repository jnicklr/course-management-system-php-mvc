<?php

namespace Framework\Responses;

use Framework\IActionResult;
use Framework\Response;
use Framework\TemplateViewer;

class ViewResult implements IActionResult
{
    private int $_code;
    private string $_template;
    private array $_data;
    private array $_headers;
    private Response $_response;
    private TemplateViewer $_viewser;

    public function __construct($template, $data = [], $headers = [])
    {
        $this->_code = 200;
        $this->_template = $template;
        $this->_data = $data;
        $this->_headers = $headers;
        $this->_response = new Response();
        $this->_viewser = new TemplateViewer();
    }

    public function toResponse(): Response
    {
        $body = $this->_viewser->render($this->_template, $this->_data);
        $this->_response->setBody($body);
        $this->_response->setStatusCode($this->_code);
        
        if (!empty($this->_headers)){
            foreach($this->_headers as $header){
                $this->_response->addHeader($header);
            }
        }

        return $this->_response;
    }
}