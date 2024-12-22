<?php

use Slim\Builder\AppBuilder;

define('APP_ROOT', __DIR__.'/..');
define('APP_DEBUG', true);

require APP_ROOT.'/vendor/autoload.php';

// Build the App instance
$builder = new AppBuilder();

$builder->setSettings([
    'config_path' => APP_ROOT.'/config/settings.php',
    'prod_mode' => APP_DEBUG,
]);

$builder->addDefinitions(require APP_ROOT . '/bootstrap/dependencies.php');

$app = $builder->build();

return $app;
