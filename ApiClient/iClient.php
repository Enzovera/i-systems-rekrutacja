<?php

namespace ApiClient;

interface iClient
{
    public function authorize(string $login, string $password): void;

    public function request(string $url, string $method, array $body = []): iResponse;

    public function get(string $url): iResponse;

    public function post(string $url, array $body): iResponse;

    public function getHeaders(): array;

    public function handleException(RequestExceptions $exception): void;
}