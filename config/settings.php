<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$settings = [];

$settings['rootPath'] = dirname(__DIR__);
$settings['appPath'] = $settings['rootPath'] . '/app';
$settings['configPath'] = $settings['rootPath'] . '/config';
$settings['publicPath'] = $settings['rootPath'] . '/public';
$settings['resourcesPath'] = $settings['rootPath'] . '/resources';
$settings['routesPath'] = $settings['rootPath'] . '/routes';
$settings['viewsPath'] = $settings['resourcesPath'] . '/views';

$settings['timezone'] = env('APP_TIMEZONE', 'UTC');
date_default_timezone_set($settings['timezone']);

$settings['error'] = [
    'display_error_details' => true,
    'log_errors' => true,
    'log_error_details' => true,
];

$settings['twig'] = [
    'paths' => [
        $settings['viewsPath'],
    ],
    'options' => [
        'cache' => false,
    ],
];

$settings['db'] = [
    'driver' => 'mysql',
    'host' => env('DB_HOST', 'localhost'),
    'database' => env('DB_DATABASE', 'slimtep'),
    'username' => env('DB_USERNAME', 'root'),
    'password' => env('DB_PASSWORD'),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'options' => [
        // Turn off persistent connections
        PDO::ATTR_PERSISTENT => false,
        // Enable exceptions
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Emulate prepared statements
        PDO::ATTR_EMULATE_PREPARES => true,
        // Set default fetch mode to array
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Set character set
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
    ],
];

return $settings;
