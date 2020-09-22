<?php

namespace LUIS\Tests;

use LUIS\LuisClient;
use LUIS\Models\App;
use LUIS\Models\Utterance;

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

    public function testGetApps()
    {
        $apps = $this->luisClient->getApps();
        $this->assertNotNull($apps);
    }

    public function testGetCultures()
    {
        $cultures = $this->luisClient->getCultures();
        $this->assertNotNull($cultures);
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
        $intentId = $this->luisClient->app($this->appId)->createIntent('first intent');
        $this->assertNotNull($intentId);

        $response = $this->luisClient->app($this->appId)->updateIntent($intentId, 'new intent');
        $this->assertNotNull($response);

        $response = $this->luisClient->app($this->appId)->deleteIntent($intentId);
        $this->assertNotNull($response);
    }

    public function testCreateUpdateDeleteEntity()
    {
        $entityId = $this->luisClient->app($this->appId)->createEntity('first entity');
        $this->assertNotNull($entityId);

        $response = $this->luisClient->app($this->appId)->updateEntity($entityId, 'new entity');
        $this->assertNotNull($response);

        $response = $this->luisClient->app($this->appId)->deleteEntity($entityId);
        $this->assertNotNull($response);
    }

    public function testCreateDeleteUtterance()
    {
        $entityName = 'test entity';
        $entityId = $this->luisClient->app($this->appId)->createEntity($entityName);

        $intentText = 'test intent';
        $intentId = $this->luisClient->app($this->appId)->createIntent($intentText);

        $utteranceText = 'my name is tom';
        $utterance = new Utterance();
        $utterance->setText($utteranceText)
            ->setIntentName($intentText)
            ->addEntityLabel($entityName, 0, 1);

        $utteranceId = $this->luisClient->app($this->appId)->addUtterance($utterance);
        $this->assertNotNull($utteranceId);

        $this->luisClient->app($this->appId)->deleteUtterance($utteranceId);
        $this->luisClient->app($this->appId)->deleteEntity($entityId);
        $this->luisClient->app($this->appId)->deleteIntent($intentId);
    }
}
