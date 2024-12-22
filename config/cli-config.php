<?php

require 'vendor/autoload.php';

use Doctrine\ORM\EntityManager;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Slim\App;

/** @var App $app */
$app = require_once __DIR__ . '/../bootstrap/bootstrap.php';

$config = new PhpFile(__DIR__.'/migrations.php'); // Or use one of the Doctrine\Migrations\Configuration\Configuration\* loaders

$entityManager = $app->getContainer()->get(EntityManager::class);

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));