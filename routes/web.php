<?php

use App\Controllers\HomeController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function (App $app) {

    $app->get('/', HomeController::class . ':home')->setName('home');

    $app->get('/hello/{name}', function ($name, Request $request, Response $response) {
        $response->getBody()->write("Hello, $name");
        return $response;
    });

};

