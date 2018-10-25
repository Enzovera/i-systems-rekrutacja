<?php

namespace ApiClient;

interface iResponse
{
    public function getData(): ?object;

    public function isSuccess(): bool;

    public function getErrorMessages(): ?string;
}