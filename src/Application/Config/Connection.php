<?php

namespace App\Application\Config;

/**
 * @property 'ibm_db2'|'mysqli'|'oci8'|'pdo_mysql'|'pdo_oci'|'pdo_pgsql'|'pdo_sqlite'|'pdo_sqlsrv'|'pgsql'|'sqlite3'|'sqlsrv'  $driver
 */
final class Connection
{
    public function __construct(
        public readonly string $driver = 'pdo_sqlite',
        public readonly ?string $path = APP_ROOT . '/var/db.sqlite',
        public readonly ?string $host = null,
        public readonly ?int $port = null,
        public readonly ?string $dbname = null,
        public readonly ?string $user = null,
        public readonly ?string $password = null,
        public readonly ?string $charset = null,
    ) {
    }
}
