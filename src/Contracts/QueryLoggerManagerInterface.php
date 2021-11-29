<?php

declare(strict_types=1);

namespace Wimski\LaravelQueryLogger\Providers\Contracts;

interface QueryLoggerManagerInterface
{
    public function initialize(): void;
}
