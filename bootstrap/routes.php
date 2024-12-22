<?php

use App\Action\PingAction;
use Psr\Log\LoggerInterface;
use Slim\App;
use App\Application\Config\ConfigInterface;

return function (App $app) {

    // Register Routes
    $app->get('/', function ($request, $response, $args) {
        $response->getBody()->write('Hello, World!');
        return $response;
    });

    // Register route with action class
    $app->get('/ping', PingAction::class);

    /** @var ConfigInterface $config */
    $config = $app->getContainer()->get(ConfigInterface::class);
    /** @var LoggerInterface $logger */
    $logger = $app->getContainer()->get(LoggerInterface::class);
    if ($config->get()->logger->path == "php://stdout") {
        $logger->info('Routes ready');
    }
};
