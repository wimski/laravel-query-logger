<?php

declare(strict_types=1);

namespace Wimski\LaravelQueryLogger;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Filesystem\Filesystem;
use Wimski\LaravelQueryLogger\Providers\Contracts\QueryLoggerInterface;
use Wimski\LaravelQueryLogger\Providers\Contracts\QueryLoggerManagerInterface;

class QueryLoggerManager implements QueryLoggerManagerInterface
{
    protected Config $config;
    protected Filesystem $filesystem;
    protected DatabaseManager $databaseManager;
    protected QueryLoggerInterface $queryLogger;

    public function __construct(
        Config $config,
        Filesystem $filesystem,
        DatabaseManager $databaseManager,
        QueryLoggerInterface $queryLogger
    ) {
        $this->config          = $config;
        $this->filesystem      = $filesystem;
        $this->databaseManager = $databaseManager;
        $this->queryLogger     = $queryLogger;
    }

    public function initialize(): void
    {
        if ($this->config->get('query-logger.enabled') !== true) {
            return;
        }

        $this->clearLog();

        $this->databaseManager->listen(function (QueryExecuted $query) {
            $this->queryLogger->log($query);
        });
    }

    protected function clearLog(): void
    {
        $path = $this->config->get('query-logger.path');

        if ($this->config->get('query-logger.clear_on_every_request') && $this->filesystem->exists($path)) {
            $this->filesystem->delete($path);
        }
    }
}
