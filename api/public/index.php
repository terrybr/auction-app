<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

/**
 * Set up initial response code to 500 so server can respond properly in error cases.
 * If Slim response is success, server will respond with appropriate response code.
 */
http_response_code(500);

/**
 * Including autoloader.
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 * Set up app container.
 */
$builder = new ContainerBuilder();

$builder->addDefinitions([
  'config' => [
    'debug' => (bool) getenv('APP_DEBUG'),
  ],
]);

$container = $builder->build();

$app = AppFactory::createFromContainer($container);

/**
 * Add app middlewares.
 */
(require __DIR__.'/../config/middleware.php')($app, $container);

/**
 * Add app routes.
 */
(require __DIR__.'/../config/routes.php')($app);

/**
 * Run the app.
 */
$app->run();
