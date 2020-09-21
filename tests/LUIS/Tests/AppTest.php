<?php

namespace LUIS\Tests;

use LUIS\LuisClient;
use LUIS\Models\App;

class AppTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LuisClient
     */
    public $luisClient;

    public function setUp()
    {
        parent::setUp();

        $primaryKey = getenv('LUIS_PRIMARY_KEY');
        $location = getenv('LUIS_LOCATION');

        $this->luisClient = new LuisClient($primaryKey, $location);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->luisClient);
    }

    public function testCreateUpdateDeleteApp()
    {
        $app = (new App())->setName('test')->setDescription('newdescription');
        $appId = $this->luisClient->createApp($app);
        $this->assertNotNull($appId);

        $response = $this->luisClient->app($appId)->update('newname', 'newdescription');
        $this->assertNotNull($response);

        $response = $this->luisClient->app($appId)->delete();
        $this->assertNotNull($response);
    }
}
