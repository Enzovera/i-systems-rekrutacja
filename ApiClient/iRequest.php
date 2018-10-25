<?php

namespace ApiClient;

interface iRequest
{
    public function setUrl(string $url): void;

    public function addHeader(string $header): void;

    public function setBody(string $body): void;

    public function setMethod(string $method): void;

    public function execute(): iResponse;
}