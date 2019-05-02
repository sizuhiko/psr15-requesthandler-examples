<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Psr\Http\Message\ResponseFactoryInterface;
use Psr15RequestHandlerExamples\RequestHandlers\ExampleRequestHandler;

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
  $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);
assert($request instanceof Psr\Http\Message\RequestInterface);

$container = new DI\Container();
$container->set(ResponseFactoryInterface::class, DI\create(Zend\Diactoros\ResponseFactory::class));

$fastRouteDispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) use($container) {
  $handler = new ExampleRequestHandler($container);
  $r->addRoute('GET', '/', $handler);
});
$handler = new Relay\Relay([
  new Middlewares\FastRoute($fastRouteDispatcher),
  new Middlewares\RequestHandler()
]);
assert($handler instanceof Psr\Http\Server\RequestHandlerInterface);

$response = $handler->handle($request);
assert($response instanceof Psr\Http\Message\ResponseInterface);

(new Zend\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
