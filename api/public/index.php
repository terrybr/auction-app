<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Factory\AppFactory;
use App\Http;

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
    ResponseFactoryInterface::class => DI\get(Slim\Psr7\Factory\ResponseFactory::class),
]);

$container = $builder->build();

$app = AppFactory::createFromContainer($container);

/**
 * Add error handling.
 */
$app->addErrorMiddleware($container->get('config')['debug'], true, true);

/**
 * Add app routes.
 */
$app->get('/', Http\Action\HomeAction::class);

/**
 * Run the app.
 */
$app->run();
