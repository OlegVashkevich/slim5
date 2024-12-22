<?php

namespace App\Application\Config;

final class Connection
{
    public function __construct(
        public readonly string $driver = 'pdo_sqlite',
        public readonly ?string $path = null,
        public readonly ?string $host = null,
        public readonly ?int $port = null,
        public readonly ?string $dbname = null,
        public readonly ?string $user = null,
        public readonly ?string $password = null,
        public readonly ?string $charset = null,
    ) {
    }
}
