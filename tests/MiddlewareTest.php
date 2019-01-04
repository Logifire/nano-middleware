<?php

use NaiveMiddleware\RequestHandler;
use NaiveMiddleware\Tests\MockMiddleware;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

class MiddlewareTest extends TestCase
{

    public function testMiddlewareHandling()
    {
        $server_request = new ServerRequest('get', 'http://example.org');

        $psr17_factory = new Psr17Factory();

        $handler = new RequestHandler($psr17_factory);

        $handler->addMiddleware(new MockMiddleware());
        $handler->addMiddleware(new MockMiddleware());

        $response = $handler->handle($server_request);

        $this->assertSame(2, MockMiddleware::$count, 'Should call through two middlewares');
        $this->assertSame(RequestHandler::STATUS_CODE, $response->getStatusCode(), 'Should generate a 500 response if no middleware handles the response');
        $this->assertSame(RequestHandler::REASON_PHRASE, $response->getReasonPhrase(), 'Should give a reason phrase if no middleware handles the response');
    }
}
