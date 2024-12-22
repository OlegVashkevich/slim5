<?php
namespace App\Application\Factory;

use Psr\Container\ContainerInterface;
use App\Application\Config\ConfigInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Log\LoggerInterface;
use App\Application\Config\Logger as LoggerSettings;
use Monolog\Formatter\LineFormatter;

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

        $dateFormat = "D M j G:i:s Y";
        $output = "[%datetime%] >>> \033[1;34m %level_name% \033[0m > %message% %context% %extra%\n";
        $formatter = new LineFormatter($output, $dateFormat);
        $handler = new StreamHandler("php://stdout", 100);
        $handler->setFormatter($formatter);
        $logger->pushHandler($handler);

        if ($this->loggerSettings->path != "php://stdout") {
            $handler = new StreamHandler($this->loggerSettings->path, $this->loggerSettings->level);
            $logger->pushHandler($handler);
        }

        $logger->info('Logger ready', [$this->loggerSettings]);

        return $logger;
    }
}