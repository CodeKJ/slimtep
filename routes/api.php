<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

    $app->group('/api', function (RouteCollectorProxy $group) {

        $group->get('/example/{id:[0-9]+}', function ($id, Request $request, Response $response) {
            $response->getBody()->write($id);
            return $response;
        })->setName('api.example');

    });
};

