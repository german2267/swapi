<?php

namespace App\Classes;

use Illuminate\Http\Response as Responder;

class Response
{
    private $payload;

    private $code;

    private $error;

    private $response;

    public function __construct($payload, $code = 200, $error = '')
    {
        $this->payload = $payload;
        $this->code = $code;
        $this->error = $error;

        $this->setResponse();
    }

    public function setResponse()
    {
        $this->response = [
            'data' => $this->payload,
            'codigo' => $this->code,
            'error' => $this->error,
        ];
    }

    public function getResponse()
    {
        return new Responder($this->response, $this->code);
    }

}
