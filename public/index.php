<?php

use Slim\Builder\AppBuilder;


require __DIR__.'/../vendor/autoload.php';

// Build the App instance
$builder = new AppBuilder();

$builder->setSettings( require __DIR__ . '/../bootstrap/settings.php' );

$builder->addDefinitions( require __DIR__ . '/../bootstrap/dependencies.php' );

$app = $builder->build();

// Add middleware (New: FIFO by default)
(require __DIR__ . '/../bootstrap/middlewares.php')($app);

(require __DIR__ . '/../bootstrap/routes.php')($app);

// Run the app
$app->run();
