<?php

declare(strict_types=1);

namespace App\Application\Config;

interface ConfigInterface
{
    public function get(): Config;
}