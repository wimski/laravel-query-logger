<?php

declare(strict_types=1);

namespace Wimski\LaravelQueryLogger\Tests\Integration;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase;
use Wimski\LaravelQueryLogger\QueryLoggerServiceProvider;

abstract class AbstractIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app): array
    {
        return [
            QueryLoggerServiceProvider::class,
        ];
    }

    protected function defineDatabaseMigrations(): void
    {
        $this->loadMigrationsFrom($this->getStubsPath('database' . DIRECTORY_SEPARATOR . 'migrations'));
    }

    protected function getStubsPath(string $path): string
    {
        return dirname(__DIR__) .
            DIRECTORY_SEPARATOR .
            'stubs' .
            DIRECTORY_SEPARATOR .
            $path;
    }
}
