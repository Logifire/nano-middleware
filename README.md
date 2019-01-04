# naive-middleware

A PSR-15 request handler implementation

See https://www.php-fig.org/psr/psr-15/

## Usage

```
    $psr17_factory = new Psr17Factory();

    $handler = new RequestHandler($psr17_factory);

    $handler->addMiddleware(new Middleware());
    $handler->addMiddleware(new Middleware());

    $response = $handler->handle($server_request);
```
