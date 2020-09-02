<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;

/**
 * Set up initial response code to 500 so server can respond properly in error cases.
 * If Slim response is success, server will respond with appropriate response code.
 */
http_response_code(500);

require __DIR__ . '/../vendor/autoload.php';

$container = require __DIR__.'/../config/container.php';

$app = AppFactory::createFromContainer($container);

(require __DIR__.'/../config/middleware.php')($app, $container);

(require __DIR__.'/../config/routes.php')($app);

$app->run();
