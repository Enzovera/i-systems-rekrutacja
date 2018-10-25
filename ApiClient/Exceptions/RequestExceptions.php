<?php

namespace ApiClient\Exceptions;

use Throwable;

class RequestExceptions extends \Exception
{
    function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        switch ($code) {
            case 0:
                $http_translated = 'Connection error.';
                break;
            case 400:
                $http_translated =  'Bad request.';
                break;
            case 401:
                $http_translated =  'Unauthorized.';
                break;
            case 404:
                $http_translated =  'Resource not find.';
                break;
            case 405:
                $http_translated =  'Method not allowed.';
                break;
            default:
                $http_translated =  "Request not successful, http code: $code";
        }
        parent::__construct($http_translated.' '.$message, $code, $previous);
    }

}