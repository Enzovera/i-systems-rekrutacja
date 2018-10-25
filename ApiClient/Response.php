<?php


namespace ApiClient;


class Response implements iResponse
{

    private $data;
    private $success;
    private $error;

    public function __construct(string $json)
    {
        $response = json_decode($json);
        $this->data = $response->data;
        $this->success = $response->success;
        $this->error = $response->error;
    }

    public function getData() : ?object
    {
        return $this->data;
    }

    public function isSuccess() : bool
    {
        return $this->success;
    }

    public function getErrorMessages() : ?string
    {
        return implode(". ", $this->error->messages);
    }
}