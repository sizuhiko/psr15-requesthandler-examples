<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr15RequestHandlerExamples\RequestHandlers\ExampleRequestHandler;

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
  $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);
assert($request instanceof Psr\Http\Message\RequestInterface);

$router = new Northwoods\Router\Router;
$container = new DI\Container();

$container->set(ResponseFactoryInterface::class, DI\create(Zend\Diactoros\ResponseFactory::class));
$handler = new ExampleRequestHandler($container);

$router->get('root', '/', $handler);
assert($router instanceof Psr\Http\Server\MiddlewareInterface);

$response = $router->handle($request);
assert($response instanceof Psr\Http\Message\ResponseInterface);

(new Zend\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
