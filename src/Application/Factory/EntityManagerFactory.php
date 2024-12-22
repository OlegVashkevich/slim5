<?php
namespace App\Application\Factory;

use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\ORMSetup;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use App\Application\Config\ConfigInterface;

class EntityManagerFactory
{
    private $settings;
    public function __construct(ContainerInterface $container)
    {
        $this->settings = $container->get(ConfigInterface::class)->get()->doctrine;
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

        $connection = DriverManager::getConnection((array) $this->settings->connection);

        return new EntityManager($connection, $config);
    }
}