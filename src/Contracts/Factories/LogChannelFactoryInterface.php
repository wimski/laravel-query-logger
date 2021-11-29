<?php

declare(strict_types=1);

namespace Wimski\LaravelQueryLogger\Providers\Contracts\Factories;

use Psr\Log\LoggerInterface;

interface LogChannelFactoryInterface
{
    public function make(): LoggerInterface;
}
