<?php

declare(strict_types=1);

namespace Wimski\LaravelQueryLogger\Factories;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Log\LogManager;
use Psr\Log\LoggerInterface;
use Wimski\LaravelQueryLogger\Providers\Contracts\Factories\LogChannelFactoryInterface;

class LogChannelFactory implements LogChannelFactoryInterface
{
    protected Config $config;
    protected LogManager $logManager;

    public function __construct(Config $config, LogManager $logManager)
    {
        $this->config     = $config;
        $this->logManager = $logManager;
    }

    public function make(): LoggerInterface
    {
        return $this->logManager->channel(
            $this->config->get('query-logger.channel'),
        );
    }
}
