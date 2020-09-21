<?php

namespace LUIS;

use GuzzleHttp\Client;
use \Exception;

abstract class LuisAbstract
{
    /**
     * Luis API Version
     */
    const API_VERSION = 'v2.0';

    /**
     * @var string Luis base uri
     */
    CONST API_URI = 'api.cognitive.microsoft.com';

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
    protected function request($method, $object, $data = null)
    {
        $requestUrl = $this->generateRequestUrl() . $object;

        $options['headers'] = [
            'Ocp-Apim-Subscription-Key' => $this->primaryKey,
            'Content-Type' => 'application/json',
        ];

        $options['json'] = $data;

        $httpClient = new Client();

        try {
            $response = $httpClient->request($method, $requestUrl, $options);
            return json_decode($response->getBody()->getContents());
        } catch (Exception $exception) {
            throw(new Exception($exception->getMessage()));
        }
    }

    /**
     * Generate request url
     *
     * @return string
     */
    protected function generateRequestUrl()
    {
        $scheme = 'https://';
        $endpointUri = $this->location . '.' . self::API_URI;
        $apiPath = '/luis/api/' . self::API_VERSION . '/';

        return $scheme . $endpointUri . $apiPath;
    }
}