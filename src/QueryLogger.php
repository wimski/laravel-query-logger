<?php

declare(strict_types=1);

namespace Wimski\LaravelQueryLogger;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Log\LogManager;
use Psr\Log\LoggerInterface;
use Wimski\LaravelQueryLogger\Providers\Contracts\QueryLogFormatterInterface;
use Wimski\LaravelQueryLogger\Providers\Contracts\QueryLoggerInterface;

class QueryLogger implements QueryLoggerInterface
{
    protected Config $config;
    protected LoggerInterface $log;
    protected QueryLogFormatterInterface $queryLogFormatter;

    public function __construct(Config $config, LogManager $logManager, QueryLogFormatterInterface $queryLogFormatter)
    {
        $this->config            = $config;
        $this->log               = $logManager->channel($config->get('query-logger.channel'));
        $this->queryLogFormatter = $queryLogFormatter;
    }

    public function log(QueryExecuted $query): void
    {
        if (! $this->queryShouldBeLogged($query)) {
            return;
        }

        $this->log->info(
            $this->queryLogFormatter->format($query),
        );
    }

    protected function queryShouldBeLogged(QueryExecuted $query): bool
    {
        if (! $this->queryExceedsMinimumDuration($query)) {
            return false;
        }

        if (! $this->queryMatchesPattern($query)) {
            return false;
        }

        return true;
    }

    protected function queryExceedsMinimumDuration(QueryExecuted $query): bool
    {
        $minimumDuration = (int) $this->config->get('query-logger.minimum_duration');

        return $query->time >= $minimumDuration * 1000;
    }

    protected function queryMatchesPattern(QueryExecuted $query): bool
    {
        $pattern = $this->config->get('query-logger.match_pattern');

        return preg_match($pattern, $query->sql) === 1;
    }
}
