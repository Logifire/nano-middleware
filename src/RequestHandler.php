<?php
namespace NaiveMiddleware;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RequestHandler implements RequestHandlerInterface
{

    public const STATUS_CODE = 500;
    public const REASON_PHRASE = 'Missing middleware handling';

    /**
     * @var ResponseFactoryInterface
     */
    private $response_factory;

    /**
     * @var MiddlewareInterface[]
     */
    private $middlewares = [];

    public function __construct(ResponseFactoryInterface $response_factory)
    {
        $this->response_factory = $response_factory;
    }

    public function addMiddleware(MiddlewareInterface $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $middleware = current($this->middlewares);

        if ($middleware !== false) {
            next($this->middlewares);
            $response = $middleware->process($request, $this);
        } else {
            $response = $this->response_factory->createResponse(self::STATUS_CODE, self::REASON_PHRASE);
        }

        reset($this->middlewares);

        return $response;
    }
}
