<?php

namespace Goodjun\LUIS\Exceptions;

use \Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class LuisResponseException extends Exception
{
    /**
     * LuisResponseException constructor.
     * @param string $message
     * @param int $code
     * @param null $previous
     */
    public function __construct($message = "", $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Create exception
     *
     * @param RequestInterface $request
     * @param ResponseInterface|null $response
     * @param Exception $previous
     * @return LuisResponseException
     */
    public static function create(RequestInterface $request, ResponseInterface $response = null, Exception $previous)
    {
        if (!$response) {
            return new self($previous->getMessage(), $previous->getCode(), $previous);
        }

        $responseJson = json_decode($response->getBody()->getContents());

        if (json_last_error() !== JSON_ERROR_NONE) {
            return new self($previous->getMessage(), $previous->getCode(), $previous);
        }

        if (!property_exists($responseJson, 'error') ||
            !property_exists($responseJson->error, 'code') ||
            !property_exists($responseJson->error, 'message'))
        {
            return new self($previous->getMessage(), $previous->getCode(), $previous);
        }

        return new self($responseJson->error->message, $responseJson->error->code, $previous);
    }
}