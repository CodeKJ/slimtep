<?php

use DI\ContainerBuilder;
use DI\Bridge\Slim\Bridge as App;
use Dotenv\Dotenv;

$rootPath = dirname(__DIR__);

require_once $rootPath . '/vendor/autoload.php';

// Load environment variables.
$dotenv = Dotenv::createImmutable($rootPath);
$dotenv->load();

// Build container.
$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions($rootPath . '/config/container.php');
$container = $containerBuilder->build();

/**
 * Initialize app from container.
 * @var $app \Slim\App
 */
$app = $container->get(App::class);

// Register routes.
(require $container->get('settings')['routesPath'] . '/api.php')($app);
(require $container->get('settings')['routesPath'] . '/web.php')($app);

// Register middlewares.
(require $container->get('settings')['configPath'] . '/middleware.php')($app);

return $app;
