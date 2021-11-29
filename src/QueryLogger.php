<?php

declare(strict_types=1);

namespace Wimski\LaravelQueryLogger;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Log\LogManager;
use Psr\Log\LoggerInterface;
use Wimski\LaravelQueryLogger\Providers\Contracts\QueryLogFormatterInterface;
use Wimski\LaravelQueryLogger\Providers\Contracts\QueryLoggerInterface;
use Wimski\LaravelQueryLogger\Providers\Contracts\RuleFactoryInterface;

class QueryLogger implements QueryLoggerInterface
{
    protected Config $config;
    protected LoggerInterface $log;
    protected QueryLogFormatterInterface $queryLogFormatter;
    protected RuleFactoryInterface $ruleFactory;

    public function __construct(
        Config $config,
        LogManager $logManager,
        QueryLogFormatterInterface $queryLogFormatter,
        RuleFactoryInterface $ruleFactory
    ) {
        $this->config            = $config;
        $this->log               = $logManager->channel($config->get('query-logger.channel'));
        $this->queryLogFormatter = $queryLogFormatter;
        $this->ruleFactory       = $ruleFactory;
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
        $ruleClasses = $this->config->get('query-logger.rules');

        foreach ($ruleClasses as $ruleClass) {
            $rule = $this->ruleFactory->make($ruleClass);

            if (! $rule->passes($query)) {
                return false;
            }
        }

        return true;
    }
}
