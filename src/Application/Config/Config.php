<?php
namespace App\Application\Config;


final class Config implements ConfigInterface
{
    public function __construct(
        /** @var non-empty-string */
        public readonly string $name,
        public readonly \DateTimeZone $timeZone,
        
        public readonly Logger $logger,
    ) {}

    public function get():Config
    {
        return $this;
    }
}


