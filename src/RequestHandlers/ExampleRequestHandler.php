<?php

namespace Psr15RequestHandlerExamples\RequestHandlers;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ExampleRequestHandler implements RequestHandlerInterface
{
  private $container;

  public function __construct(ContainerInterface $container)
  {
    $this->container = $container;
  }

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    $response = $this->container->get(ResponseFactoryInterface::class)->createResponse();
    $response->getBody()->write('<h1>Hello, World!</h1>');
    return $response;
  }
}
