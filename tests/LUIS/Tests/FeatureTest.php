<?php

namespace LUIS\Tests;

use PHPUnit\Framework\TestCase;
use LUIS\LuisClient;

class FeatureTest extends TestCase
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
}
