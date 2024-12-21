<?php

use App\Application\Config\ConfigInterface;
use App\Application\Factory\ConfigFactory;
use Psr\Log\LoggerInterface;
use App\Application\Factory\LoggerFactory;

return [
    ConfigInterface::class =>  DI\factory([ConfigFactory::class,'create']),
    LoggerInterface::class =>  DI\factory([LoggerFactory::class,'create']),
];
