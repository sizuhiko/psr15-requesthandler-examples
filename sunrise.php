<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr15RequestHandlerExamples\Middlewares\ExampleRequestHandler;

$request = Sunrise\Http\ServerRequest\ServerRequestFactory::fromGlobals();
assert($request instanceof Psr\Http\Message\RequestInterface);

$routes = new Sunrise\Http\Router\RouteCollection();
$routes->get('root', '/')->addMiddleware(new ExampleRequestHandler);

$router = new Sunrise\Http\Router\Router();
$router->addRoutes($routes);

$response = $router->handle($request);
assert($response instanceof Psr\Http\Message\ResponseInterface);

(new Zend\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
