<?php

namespace LUIS\Tests;

use LUIS\Models\App;

class AppTest extends FeatureTest
{
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
