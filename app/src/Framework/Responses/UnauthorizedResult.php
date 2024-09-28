<?php

namespace Framework\Responses;

use Framework\IActionResult;
use Framework\Response;

class UnauthorizedResult implements IActionResult
{
    private int $_code;
    private array $_data;
    private string $_message;
    private array $_headers;
    private Response $_response;

    public function __construct($data, $message, $headers = [])
    {
        $this->_code = 403;
        $this->_data = $data;
        $this->_message = $message;
        $this->_headers = $headers;
        $this->_response = new Response();
    }

    private function formatResponse(): string
    {
        $response = [
            'status' => $this->_code
        ];
        if (!empty($this->_data)) {
            $response['data'] = $this->_data;
        }
        if (!empty($this->_message)) {
            $response['message'] = $this->_message; 
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