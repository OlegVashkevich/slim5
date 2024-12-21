<?php
namespace App\Application\Config;

use Monolog\Level;

final class Logger
{
    public function __construct(
        public readonly bool $enable = true,
        public readonly string $name = "app",
        public readonly string $path = "php://stdout",
        public readonly Level $level = Level::Debug,
    ) {}
}