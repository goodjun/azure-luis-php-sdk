<?php

namespace Goodjun\LUIS;

use Goodjun\LUIS\Models\App;
use \Exception;

class LuisClient extends LuisAbstract
{
    /**
     * LuisClient constructor.
     * @param $primaryKey
     * @param $location
     */
    public function __construct($primaryKey, $location)
    {
        $this->primaryKey = $primaryKey;
        $this->location = $location;
    }

    /**
     * App class
     *
     * @param $appId
     * @return LuisAppClient
     */
    public function app($appId)
    {
        return new LuisAppClient($this->primaryKey, $this->location, $appId);
    }

    /**
     * Get Apps
     *
     * @return mixed
     * @throws Exception
     */
    public function getApps()
    {
        return $this->request('GET', 'apps');
    }

    /**
     * Create app
     *
     * @param App $app
     * @return mixed
     * @throws Exception
     */
    public function createApp(App $app)
    {
        return $this->request('POST', 'apps', $app->toArray());
    }

    /**
     * Get Cultures
     *
     * @return mixed
     * @throws Exception
     */
    public function getCultures()
    {
        return $this->request('GET', 'apps/cultures');
    }
}
