<?php

namespace LUIS\Tests\Models;

use Goodjun\LUIS\Models\App;

class AppTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $app = new App([
            'name' => 'name',
            'description' => 'description',
            'domain' => 'domain',
            'culture' => 'en-us',
            'tokenizerVersion' => '1.0',
            'usageScenario' => 'usage',
            'initialVersionId' => '0.1',
        ]);

        $this->assertEquals('name', $app->getName());
        $this->assertEquals('description', $app->getDescription());
        $this->assertEquals('domain', $app->getDomain());
        $this->assertEquals('en-us', $app->getCulture());
        $this->assertEquals('0.1', $app->getInitialVersionId());
        $this->assertEquals('1.0', $app->getTokenizerVersion());
        $this->assertEquals('usage', $app->getUsageScenario());
    }

    public function testSetterGetter()
    {
        $app = new App();

        $app->setName('name')
            ->setDescription('description')
            ->setDomain('domain')
            ->setCulture('en-us')
            ->setInitialVersionId('0.1')
            ->setTokenizerVersion('1.0')
            ->setUsageScenario('usage');

        $this->assertEquals('name', $app->getName());
        $this->assertEquals('description', $app->getDescription());
        $this->assertEquals('domain', $app->getDomain());
        $this->assertEquals('en-us', $app->getCulture());
        $this->assertEquals('0.1', $app->getInitialVersionId());
        $this->assertEquals('1.0', $app->getTokenizerVersion());
        $this->assertEquals('usage', $app->getUsageScenario());
    }
}
