<?php


namespace ApiClient\Resource;
use ApiClient\iClient;
use ApiClient\iResponse;

abstract class Resource
{
    protected $client;

    public function __construct(iClient $client)
    {
        $this->client = $client;
    }

    protected function getResource() : iResponse
    {
        return $this->client->get(static::URL);
    }

    protected function postResource(array $body = [], string $additional_path = "") : iResponse
    {
        return $this->client->post(static::URL.$additional_path, $body, ['Content-Type' => 'application/json']);
    }

}