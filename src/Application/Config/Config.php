<?php

namespace App\Application\Config;

final class Config implements ConfigInterface
{
    #[\CuyZ\Valinor\Mapper\Object\Constructor]
    public function __construct(
        public readonly string $name,
        public readonly \DateTimeZone $timeZone,
        public readonly Logger $logger,
        public readonly Doctrine $doctrine,
    ) {
    }

    public function get(): Config
    {
        return $this;
    }

    #[\CuyZ\Valinor\Mapper\Object\Constructor]
    public static function createFrom(
        string $name = 'app',
        \DateTimeZone $timeZone = new \DateTimeZone('Europe/Minsk'),
        Logger $logger = new Logger(),
        Doctrine $doctrine = new Doctrine(new Connection())
    ): self 
    {
        return new self($name, $timeZone, $logger, $doctrine);
    }
}
