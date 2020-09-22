<?php

namespace LUIS\Tests;

use LUIS\LuisClient;
use LUIS\Models\App;

class FeatureTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LuisClient
     */
    public $luisClient;

    /**
     * @var string
     */
    public $appId;

    public function setUp()
    {
        parent::setUp();

        $primaryKey = getenv('LUIS_PRIMARY_KEY');
        $location = getenv('LUIS_LOCATION');
        $appId = getenv('LUIS_APP_ID');

        $this->luisClient = new LuisClient($primaryKey, $location);
        $this->appId = $appId;
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

    public function testCreateUpdateDeleteIntent()
    {
        $intentId = $this->luisClient->app($this->appId)->createIntent('test');
        $this->assertNotNull($intentId);

        $response = $this->luisClient->app($this->appId)->updateIntent($intentId, 'newname');
        $this->assertNotNull($response);

        $response = $this->luisClient->app($this->appId)->deleteIntent($intentId);
        $this->assertNotNull($response);
    }

    public function testCreateUpdateDeleteEntity()
    {
        $entityId = $this->luisClient->app($this->appId)->createEntity('test');
        $this->assertNotNull($entityId);

        $response = $this->luisClient->app($this->appId)->updateEntity($entityId, 'newname');
        $this->assertNotNull($response);

        $response = $this->luisClient->app($this->appId)->deleteEntity($entityId);
        $this->assertNotNull($response);
    }
}
