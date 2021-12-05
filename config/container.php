<?php

use App\Repository\UserRepository;
use DI\Bridge\Slim\Bridge as App;
use Psr\Container\ContainerInterface;
use Slim\Middleware\ErrorMiddleware;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Illuminate\Container\Container as IlluminateContainer;
use Illuminate\Database\Connection;
use Illuminate\Database\Connectors\ConnectionFactory;

return [
    'settings' => function () {
        return require __DIR__ . '/settings.php';
    },

    App::class => function (ContainerInterface $container) {
        return App::create($container);
    },

    ResponseFactoryInterface::class => function (ContainerInterface $container) {
        return $container->get(App::class)->getResponseFactory();
    },

    ErrorMiddleware::class => function (ContainerInterface $container) {
        $app = $container->get(App::class);
        $settings = $container->get('settings')['error'];

        return new ErrorMiddleware(
            $app->getCallableResolver(),
            $app->getResponseFactory(),
            (bool)$settings['display_error_details'],
            (bool)$settings['log_errors'],
            (bool)$settings['log_error_details']
        );
    },

    Twig::class => function (ContainerInterface $container) {
        $settings = $container->get('settings')['twig'];

        $twig = Twig::create($settings['paths'], $settings['options']);

        return $twig;
    },

    TwigMiddleware::class => function (ContainerInterface $container) {
        return TwigMiddleware::create($container->get(App::class), $container->get(Twig::class));
    },

    Connection::class => function (ContainerInterface $container) {
        $factory = new ConnectionFactory(new IlluminateContainer());

        $connection = $factory->make($container->get('settings')['db']);

        // Disable the query log to prevent memory issues
        $connection->disableQueryLog();

        return $connection;
    },

    PDO::class => function (ContainerInterface $container) {
        return $container->get(Connection::class)->getPdo();
    },

    UserRepository::class => function (ContainerInterface $container) {
        return new UserRepository($container->get(Connection::class));
    },

];
