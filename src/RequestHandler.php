<?php

namespace NanoMiddleware;

use OutOfRangeException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RequestHandler implements RequestHandlerInterface
{

    /**
     * @var MiddlewareInterface[]
     */
    private array $middlewares = [];

    public function addMiddleware(MiddlewareInterface $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $middleware = current($this->middlewares);

        if ($middleware === false) {
            throw new OutOfRangeException('Middleware is missing, usually this should be the application middleware.');
        }

        next($this->middlewares);

        // Recursive call through the middleware stack
        $response = $middleware->process($request, $this);

        // If used in a long running application, reset the pointer.
        reset($this->middlewares);

        return $response;
    }
}
