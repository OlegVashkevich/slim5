<?php

use Slim\Middleware\BodyParsingMiddleware;
use Slim\Middleware\EndpointMiddleware;
use Slim\Middleware\ExceptionHandlingMiddleware;
use Slim\Middleware\ExceptionLoggingMiddleware;
use Slim\Middleware\RoutingMiddleware;
use Slim\App;

use Psr\Log\LoggerInterface;
use App\Application\Config\ConfigInterface;

return function (App $app) {    
    $app->add(RoutingMiddleware::class);
    $app->add(BodyParsingMiddleware::class);
    $app->add(ExceptionHandlingMiddleware::class);
    $app->add(ExceptionLoggingMiddleware::class);
    $app->add(EndpointMiddleware::class);

    /** @var ConfigInterface $config */
    $config = $app->getContainer()->get(ConfigInterface::class);
    /** @var LoggerInterface $logger */
    $logger = $app->getContainer()->get(LoggerInterface::class);
    if ($config->get()->logger->path == "php://stdout") {
        $logger->info('Middlewares ready');
    }
};
