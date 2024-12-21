<?php

use Slim\Middleware\BodyParsingMiddleware;
use Slim\Middleware\EndpointMiddleware;
use Slim\Middleware\ExceptionHandlingMiddleware;
use Slim\Middleware\ExceptionLoggingMiddleware;
use Slim\Middleware\RoutingMiddleware;
use Slim\App;

return function (App $app) {
    $app->add(RoutingMiddleware::class);
    $app->add(BodyParsingMiddleware::class);
    $app->add(ExceptionHandlingMiddleware::class);
    $app->add(ExceptionLoggingMiddleware::class);
    $app->add(EndpointMiddleware::class);
};
