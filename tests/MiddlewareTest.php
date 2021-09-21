<?php

namespace NanoMiddleware\Tests;

use NanoMiddleware\RequestHandler;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\ServerRequest;
use OutOfRangeException;
use PHPUnit\Framework\TestCase;

class MiddlewareTest extends TestCase
{

    public function testMiddlewareHandling()
    {
        // Arrange
        $psr17_factory = new Psr17Factory();
        $handler = new RequestHandler();

        $handler->addMiddleware(new MockLayerMiddleware());
        $handler->addMiddleware(new MockLayerMiddleware());
        $handler->addMiddleware(new MockApplicationMiddleware($psr17_factory));

        // Act 
        $server_request = new ServerRequest('get', 'http://example.org');
        $response = $handler->handle($server_request);

        // Assert
        $this->assertSame(2, MockLayerMiddleware::$count, 'Should call through two middlewares.');
        $this->assertSame(200, $response->getStatusCode(), 'Application middleware reached.');
    }

    public function testMissingApplicationMiddleware()
    {
        // Arrange
        $handler = new RequestHandler();

        // Assert
        // No application middleware is configured.
        $this->expectException(OutOfRangeException::class);

        // Act 
        $server_request = new ServerRequest('get', 'http://example.org');
        $handler->handle($server_request);
    }
}
