<?php
namespace App\Application\Factory;

use Psr\Container\ContainerInterface;
use App\Application\Config\ConfigInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Log\LoggerInterface;

class LoggerFactory
{
    private $loggerSettings;
    public function __construct(ContainerInterface $container)
    {
        $this->loggerSettings = $container->get(ConfigInterface::class)->get()->logger;
    }

    public function create(): LoggerInterface
    {
        $logger = new Logger($this->loggerSettings->name);

        $processor = new UidProcessor();
        $logger->pushProcessor($processor);

        $handler = new StreamHandler($this->loggerSettings->path, $this->loggerSettings->level);
        $logger->pushHandler($handler);

        if($this->loggerSettings->path == "php://stdout") {
            $logger->info('logger add', [$this->loggerSettings]);
        }

        return $logger;
    }
}