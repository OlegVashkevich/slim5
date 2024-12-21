<?php

namespace App\Application\Factory;

use CuyZ\Valinor\Cache\FileSystemCache;
use CuyZ\Valinor\Cache\FileWatchingCache;
use CuyZ\Valinor\MapperBuilder;
use CuyZ\Valinor\Mapper\Source\Source;
use CuyZ\Valinor\Mapper\MappingError;
use App\Application\Config\Config;
use App\Application\Config\ConfigInterface;
use Psr\Container\ContainerInterface;

class ConfigFactory
{
    private $path = __DIR__.'/../../../env.php';
    private bool $is_cache = false;
    public function __construct(
        ContainerInterface $container
    ) {
        $settings = $container->get('settings');
        if (!empty($settings['config_path'])) {
            $this->path = $settings['config_path'];
        }
        if (!empty($settings['prod_mode'])) {
            $this->is_cache = $settings['prod_mode'];
        }
    }

    public function create(): ConfigInterface
    {
        try {
            $config = include_once($this->path);
            $mapper = new MapperBuilder();
            if ($this->is_cache) {
                $cache = new FileSystemCache(__DIR__.'/../../../var/cache/mapper');
                $cache = new FileWatchingCache($cache);
                $mapper = $mapper->withCache($cache);
            }
            return $mapper->allowSuperfluousKeys()
                ->mapper()
                ->map(Config::class, Source::json(json_encode($config)));
        } catch (MappingError $error) {
            // Handle the error…
            echo '<pre>';
            print_r($error);
            echo '</pre>';
        }
    }
}
