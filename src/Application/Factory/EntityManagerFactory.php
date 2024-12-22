<?php

namespace App\Application\Factory;

use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\ORMSetup;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use App\Application\Config\ConfigInterface;
use App\Application\Config\Doctrine;
use Psr\Log\LoggerInterface;
use App\Application\Config\Logger as LoggerSettings;

class EntityManagerFactory
{
    private Doctrine $settings;
    private LoggerInterface $logger;
    private LoggerSettings $loggerSettings;
    
    public function __construct(ConfigInterface $config, LoggerInterface $logger)
    {
        $this->settings = $config->get()->doctrine;

        $this->logger = $logger;
        $this->loggerSettings = $config->get()->logger;
    }

    public function create(): EntityManager
    {
        // Use the ArrayAdapter or the FilesystemAdapter depending on the value of the 'dev_mode' setting
        // You can substitute the FilesystemAdapter for any other cache you prefer from the symfony/cache library
        $cache = $this->settings->dev_mode ?
            new ArrayAdapter() :
            new FilesystemAdapter(directory: $this->settings->cache_dir);

        $config = ORMSetup::createAttributeMetadataConfiguration(
            $this->settings->metadata_dirs,
            $this->settings->dev_mode,
            null,
            $cache
        );

        // @phpstan-ignore argument.type
        $connection = DriverManager::getConnection((array) $this->settings->connection);

        if ($this->loggerSettings->path == "php://stdout") {
            $this->logger->info('EntityManager ready');
        }

        return new EntityManager($connection, $config);
    }
}
