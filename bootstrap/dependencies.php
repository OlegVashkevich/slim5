<?php

use App\Application\Config\ConfigInterface;
use App\Application\Factory\ConfigFactory;
use Psr\Log\LoggerInterface;
use App\Application\Factory\LoggerFactory;
use Doctrine\ORM\EntityManager;
use App\Application\Factory\EntityManagerFactory;

return [
    ConfigInterface::class =>  DI\factory([ConfigFactory::class,'create']),
    LoggerInterface::class =>  DI\factory([LoggerFactory::class,'create']),
    EntityManager::class =>  DI\factory([EntityManagerFactory::class,'create']),
];
