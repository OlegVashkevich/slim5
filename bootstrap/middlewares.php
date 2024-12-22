<?php

use Slim\Middleware\BodyParsingMiddleware;
use Slim\Middleware\EndpointMiddleware;
use Slim\Middleware\ExceptionHandlingMiddleware;
use Slim\Middleware\ExceptionLoggingMiddleware;
use Slim\Middleware\RoutingMiddleware;
use Slim\App;
use Psr\Log\LoggerInterface;

return function (App $app) {
    $app->add(RoutingMiddleware::class);
    $app->add(BodyParsingMiddleware::class);
    $app->add(ExceptionHandlingMiddleware::class);
    $app->add(ExceptionLoggingMiddleware::class);
    $app->add(EndpointMiddleware::class);

    /** @var LoggerInterface $logger */
    $logger = $app->getContainer()->get(LoggerInterface::class);
    $logger->info('Middlewares ready');
};
