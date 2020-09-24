<?php

namespace LUIS\Tests\Exceptions;

use Goodjun\LUIS\Exceptions\LuisResponseException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class LuisResponseExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testNoneResponse()
    {
        $request = $this->getMock(RequestInterface::class);
        $previous = new \Exception('Error message', 500);
        $exception = LuisResponseException::create($request, null, $previous);
        $this->assertEquals('Error message', $exception->getMessage());
        $this->assertEquals(500, $exception->getCode());
    }

    public function testResponseIsNotJson()
    {
        $request = $this->getMock(RequestInterface::class);
        $response = $this->getMock(ResponseInterface::class);
        $stream = $this->getMock(StreamInterface::class);
        $stream->expects($this->any())->method('getContents')->will($this->returnValue('Not found'));
        $response->expects($this->any())->method('getBody')->will($this->returnValue($stream));
        $previous = new \Exception('Error message', 500);
        $exception = LuisResponseException::create($request, $response, $previous);
        $this->assertEquals('Error message', $exception->getMessage());
        $this->assertEquals(500, $exception->getCode());
    }

    public function testResponseJsonIsNotAcceptableFormat()
    {
        $jsonStr = json_encode([
            'error' => 'Not found'
        ]);

        $request = $this->getMock(RequestInterface::class);
        $response = $this->getMock(ResponseInterface::class);
        $stream = $this->getMock(StreamInterface::class);
        $stream->expects($this->any())->method('getContents')->will($this->returnValue($jsonStr));
        $response->expects($this->any())->method('getBody')->will($this->returnValue($stream));
        $previous = new \Exception('Error message', 500);
        $exception = LuisResponseException::create($request, $response, $previous);
        $this->assertEquals('Error message', $exception->getMessage());
        $this->assertEquals(500, $exception->getCode());
    }

    public function testResponseJsonIsAcceptableFormat()
    {
        $jsonStr = json_encode([
            'error' => [
                'code' => '404',
                'message' => 'Not found',
            ]
        ]);

        $request = $this->getMock(RequestInterface::class);
        $response = $this->getMock(ResponseInterface::class);
        $stream = $this->getMock(StreamInterface::class);
        $stream->expects($this->any())->method('getContents')->will($this->returnValue($jsonStr));
        $response->expects($this->any())->method('getBody')->will($this->returnValue($stream));
        $previous = new \Exception('Error message', 500);
        $exception = LuisResponseException::create($request, $response, $previous);
        $this->assertEquals('Not found', $exception->getMessage());
        $this->assertEquals(404, $exception->getCode());
    }
}
