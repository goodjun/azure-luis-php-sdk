<?php

namespace LUIS\Tests\Models;

use Goodjun\LUIS\Models\Utterance;

class UtteranceTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $utterance = new Utterance([
            'text' => 'text',
            'intentName' => 'intent name',
            'entityLabels' => [],
        ]);

        $this->assertEquals('text', $utterance->getText());
        $this->assertEquals('intent name', $utterance->getIntentName());
        $this->assertEquals([], $utterance->getEntityLabels());
    }

    public function testSetterGetter()
    {
        $utterance = new Utterance();

        $utterance->setText('text')
            ->setIntentName('intent name')
            ->setEntityLabels([]);

        $this->assertEquals('text', $utterance->getText());
        $this->assertEquals('intent name', $utterance->getIntentName());
        $this->assertEquals([], $utterance->getEntityLabels());
    }
}
