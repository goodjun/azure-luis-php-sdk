<?php

namespace LUIS\Tests\Models;

use Goodjun\LUIS\Models\ModelAbstract;

class ModelAbstractTest extends \PHPUnit_Framework_TestCase
{
    public function testToArray()
    {
        $stub = $this->getMockForAbstractClass(ModelAbstract::class);

        $stub->expects($this->any())
            ->method('toArray')
            ->will($this->returnValue([]));
    }
}
