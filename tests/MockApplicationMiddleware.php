<?php

namespace NanoMiddleware\Tests;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MockApplicationMiddleware implements MiddlewareInterface
{

    private ResponseFactoryInterface $response_factory;

    public function __construct(ResponseFactoryInterface $response_factory)
    {
        $this->response_factory = $response_factory;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $this->response_factory->createResponse(200, 'Application reached...');
    }
}
