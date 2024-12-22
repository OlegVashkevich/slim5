<?php
namespace App\Application\Config;

final class Doctrine
{
    public function __construct(
        public readonly Connection $connection,
        public readonly bool $dev_mode = true,
        public readonly string $cache_dir = APP_ROOT . '/var/doctrine',
        /** @var array<string> */
        public readonly array $metadata_dirs = [APP_ROOT . '/src/Domain'],
    ) {
    }
}