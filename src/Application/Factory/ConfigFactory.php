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
    private string $path = APP_ROOT.'/config/settings.php';
    private bool $is_cache = false;
    public function __construct(
        ContainerInterface $container
    ) {
        $settings = (array) $container->get('settings');
        if (isset($settings['config_path']) && is_string($settings['config_path'])) {
            $this->path = $settings['config_path'];
        }
        if (isset($settings['prod_mode'])) {
            $this->is_cache = $settings['prod_mode'];
        }
    }

    public function create(): ConfigInterface
    {
        try {
            $config = include_once($this->path);
            $mapper = new MapperBuilder();
            if ($this->is_cache) {
                $cache = new FileSystemCache(APP_ROOT.'/var/cache/mapper');
                $cache = new FileWatchingCache($cache);
                $mapper = $mapper->withCache($cache);
            }
            return $mapper->allowSuperfluousKeys()
                ->mapper()
                ->map(Config::class, Source::array($config));
        } catch (MappingError $error) {
            throw $error;
            // Handle the error…
            /*$messages = \CuyZ\Valinor\Mapper\Tree\Message\Messages::flattenFromNode(
                $error->node()
            );
            $errorMessages = $messages->errors();
            foreach ($errorMessages as $message) {
                throw new \Exception($message->toString());
            }*/
        }
    }
}
