<?php

namespace Framework\Responses;

use Framework\IActionResult;
use Framework\Response;

class CreatedResult implements IActionResult
{
    private int $_code;
    private array $_data;
    private string $_message;
    private array $_headers;
    private Response $_response;

    public function __construct($data, $message, $headers = [])
    {
        $this->_code = 201;
        $this->_data = $data;
        $this->_message = $message;
        $this->_headers = $headers;
        $this->_response = new Response();
    }

    private function formatResponse(): string
    {
        $response = [];
        if ($this->_data){
            $response['data'] = $this->_data;
        }
        if ($this->_message){
            $response['message'] = $this->_message; 
        }
        if ($this->_code){
            $response['status'] = $this->_code; 
        }
        return json_encode($response);
    }

    public function toResponse(): Response
    {
        $this->_response->setBody($this->formatResponse());

        $this->_response->setStatusCode($this->_code);
        
        if (!empty($this->_headers)){
            foreach($this->_headers as $header){
                $this->_response->addHeader($header);
            }
        }

        return $this->_response;
    }
}