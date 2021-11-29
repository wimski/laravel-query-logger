<?php

declare(strict_types=1);

namespace Wimski\LaravelQueryLogger;

use Illuminate\Support\ServiceProvider;
use Wimski\LaravelQueryLogger\Factories\LogChannelFactory;
use Wimski\LaravelQueryLogger\Factories\RuleFactory;
use Wimski\LaravelQueryLogger\Providers\Contracts\Factories\LogChannelFactoryInterface;
use Wimski\LaravelQueryLogger\Providers\Contracts\QueryLogFormatterInterface;
use Wimski\LaravelQueryLogger\Providers\Contracts\QueryLoggerInterface;
use Wimski\LaravelQueryLogger\Providers\Contracts\QueryLoggerManagerInterface;
use Wimski\LaravelQueryLogger\Providers\Contracts\Factories\RuleFactoryInterface;

class LaravelQueryLoggerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->publishes([
            $this->getConfigPath() => config_path('query-logger.php'),
        ], 'query-logger');

        $this->mergeConfigFrom(
            $this->getConfigPath(),
            'query-logger',
        );

        $this->createQueryLogChannelConfiguration();

        $this->app->singleton(LogChannelFactoryInterface::class, LogChannelFactory::class);
        $this->app->singleton(QueryLogFormatterInterface::class, QueryLogFormatter::class);
        $this->app->singleton(QueryLoggerInterface::class, QueryLogger::class);
        $this->app->singleton(QueryLoggerManagerInterface::class, QueryLoggerManager::class);
        $this->app->singleton(RuleFactoryInterface::class, RuleFactory::class);
    }

    public function boot(): void
    {
        /** @var QueryLoggerManagerInterface $manager */
        $manager = $this->app->make(QueryLoggerManagerInterface::class);

        $manager->initialize();
    }

    protected function createQueryLogChannelConfiguration(): void
    {
        $channels = config('logging.channels');

        if (! $channels) {
            return;
        }

        $channels[config('query-logger.channel')] = [
            'driver' => config('query-logger.driver'),
            'level'  => config('query-logger.level'),
            'path'   => storage_path(config('query-logger.path')),
        ];

        config('logging.channels', $channels);
    }

    protected function getConfigPath(): string
    {
        return __DIR__ .
            DIRECTORY_SEPARATOR .
            '..' .
            DIRECTORY_SEPARATOR .
            'config' .
            DIRECTORY_SEPARATOR .
            'query-logger.php';
    }
}
