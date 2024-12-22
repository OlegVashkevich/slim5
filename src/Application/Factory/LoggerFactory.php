<?php
namespace App\Application\Factory;

use Psr\Container\ContainerInterface;
use App\Application\Config\ConfigInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Log\LoggerInterface;
use App\Application\Config\Logger as LoggerSettings;

class LoggerFactory
{
    private LoggerSettings $loggerSettings;
    public function __construct(ConfigInterface $config)
    {
        $this->loggerSettings = $config->get()->logger;
    }

    public function create(): LoggerInterface
    {
        $logger = new Logger($this->loggerSettings->name);

        $processor = new UidProcessor();
        $logger->pushProcessor($processor);

        $handler = new StreamHandler($this->loggerSettings->path, $this->loggerSettings->level);
        $logger->pushHandler($handler);

        if($this->loggerSettings->path == "php://stdout") {
            $logger->info('Logger ready', [$this->loggerSettings]);
        }

        return $logger;
    }
}