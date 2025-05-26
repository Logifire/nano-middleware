# nano-middleware
[![Tests](https://github.com/Logifire/nano-middleware/actions/workflows/tests.yml/badge.svg)](https://github.com/Logifire/nano-middleware/actions/workflows/tests.yml)

A PSR-15 request handler implementation

See https://www.php-fig.org/psr/psr-15/

## Usage

```
    $handler = new RequestHandler();

    $handler->addMiddleware(new Middleware());
    $handler->addMiddleware(new Middleware());

    $response = $handler->handle($server_request);
```
