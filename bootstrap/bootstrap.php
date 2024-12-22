<?php

use Slim\Builder\AppBuilder;

require __DIR__.'/../vendor/autoload.php';

// Build the App instance
$builder = new AppBuilder();

$builder->setSettings(require __DIR__ . '/../config/settings.php');

$builder->addDefinitions(require __DIR__ . '/../bootstrap/dependencies.php');

$app = $builder->build();

return $app;
