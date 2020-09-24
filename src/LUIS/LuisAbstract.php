<?php

namespace Goodjun\LUIS;

use Goodjun\LUIS\Exceptions\LuisResponseException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

abstract class LuisAbstract
{
    /**
     * Luis API Version
     */
    const API_VERSION = 'v2.0';

    /**
     * @var string Luis base uri
     */
    const API_URI = 'api.cognitive.microsoft.com';

    /**
     * @var string Luis API primary key
     */
    protected $primaryKey;

    /**
     * @var string Luis API location
     */
    protected $location;

    /*
     * Http request
     */
    protected function request($method, $object, $data = null, $apiType = 'api')
    {
        $requestUrl = $this->generateRequestUrl($apiType) . $object;

        $options['headers'] = [
            'Ocp-Apim-Subscription-Key' => $this->primaryKey,
            'Content-Type' => 'application/json',
        ];

        $options['json'] = $data;

        $httpClient = new Client();

        try {
            $response = $httpClient->request($method, $requestUrl, $options);
            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            throw LuisResponseException::create($e->getRequest(), $e->getResponse(), $e);
        }
    }

    /**
     * Generate request url
     *
     * @param string $apiType
     * @return string
     */
    protected function generateRequestUrl($apiType = 'api')
    {
        $scheme = 'https://';
        $endpointUri = $this->location . '.' . self::API_URI;
        $apiPath = '/luis/' . $apiType . '/' . self::API_VERSION . '/';

        return $scheme . $endpointUri . $apiPath;
    }
}