<?php

namespace ApiClient;

use ApiClient\Exceptions\RequestExceptions;

class Request implements iRequest
{

    private $header;
    private $body;
    private $url;
    private $method;

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function addHeader(string $header): void
    {
        $this->header[] = $header;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    public function execute() : iResponse
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $this->method,
            CURLOPT_HTTPHEADER => $this->header
        ));

        if($this->body != ""){
            curl_setopt($curl, CURLOPT_POSTFIELDS, $this->body);
        }

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);

        if(($httpcode == 200) && !$error){
            return new Response($response);
        } else {
            if($error){
                throw new RequestExceptions($error, $httpcode);
            } else {
                $decode = json_decode($response);
                if(isset($decode->success)) {
                    $response = new Response($response);
                    throw new RequestExceptions($response->getErrorMessages(), $httpcode);
                }
                else
                    throw new RequestExceptions('', $httpcode);
            }
        }

    }


}
