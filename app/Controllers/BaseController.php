<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Views\Twig;

abstract class BaseController
{

    protected ContainerInterface $container;

    public function __construct(
        protected App $app,
        protected Twig $view,
    ){
        $this->container = $this->app->getContainer();
    }

    protected function redirect(Response $response, string $path, int $code = 302)
    {
        return $response
            ->withHeader('Location', $this->app->getRouteCollector()->getRouteParser()->urlFor($path))
            ->withStatus($code)
            ;
    }

}
