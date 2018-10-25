<?php


namespace ApiClient;


class Client implements iClient
{

    private $headers;
    private $url_base;

    public function __construct(string $url_base)
    {
        $this->url_base = $url_base;
    }

    public function authorize(string $login, string $password): void
    {
        $auth_key = base64_encode("{$login}:{$password}");
        $this->headers['authorization'] = "Basic $auth_key";
    }

    public function request(string $url, string $method, array $body = [], array $headers = []): iResponse
    {
        $request = new Request();
        $request->setUrl("{$this->url_base}/{$url}");
        $request->setMethod($method);
        $request->setBody(json_encode($body));
        foreach ($this->headers as $field => $value) {
            $request->addHeader("{$field}: {$value}");
        }

        foreach ($headers as $field => $value) {
            $request->addHeader("{$field}: {$value}");
        }

        try {
            $result = $request->execute();
            return $result;
        } catch (RequestExceptions $exception) {
            $this->handleException($exception);
        }

    }

    public function get(string $url, array $headers = []): iResponse
    {
        return $this->request($url, "GET", [], $headers);
    }

    public function post(string $url, array $body, array $headers = []) : iResponse
    {
       return $this->request($url, "POST", $body, $headers);
    }

    public function getHeaders() : array
    {
        return $this->headers;
    }

    public function handleException(RequestExceptions $exception) : void
    {

    }
}