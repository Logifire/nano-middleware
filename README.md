# naive-middleware
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Logifire/naive-middleware/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Logifire/naive-middleware/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/Logifire/naive-middleware/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Logifire/naive-middleware/build-status/master)

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
