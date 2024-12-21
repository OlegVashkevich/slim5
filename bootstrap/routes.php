<?php

use App\Action\PingAction;
use Psr\Log\LoggerInterface;
use Slim\App;

return function (App $app) {

    // Register Routes
    $app->get('/', function ($request, $response, $args) {
        $response->getBody()->write('Hello, World!');
        // add records to the log
        $this->get(LoggerInterface::class)->info('Main');

        return $response;
    });

    // Register route with action class
    $app->get('/ping', PingAction::class);
};
