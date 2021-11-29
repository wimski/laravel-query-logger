<?php

declare(strict_types=1);

namespace Wimski\LaravelQueryLogger;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Database\Events\QueryExecuted;
use Wimski\LaravelQueryLogger\Providers\Contracts\Factories\LogChannelFactoryInterface;
use Wimski\LaravelQueryLogger\Providers\Contracts\Factories\RuleFactoryInterface;
use Wimski\LaravelQueryLogger\Providers\Contracts\QueryLogFormatterInterface;
use Wimski\LaravelQueryLogger\Providers\Contracts\QueryLoggerInterface;

class QueryLogger implements QueryLoggerInterface
{
    protected Config $config;
    protected RuleFactoryInterface $ruleFactory;
    protected LogChannelFactoryInterface $logChannelFactory;
    protected QueryLogFormatterInterface $queryLogFormatter;

    public function __construct(
        Config $config,
        RuleFactoryInterface $ruleFactory,
        LogChannelFactoryInterface $logChannelFactory,
        QueryLogFormatterInterface $queryLogFormatter
    ) {
        $this->config            = $config;
        $this->ruleFactory       = $ruleFactory;
        $this->logChannelFactory = $logChannelFactory;
        $this->queryLogFormatter = $queryLogFormatter;
    }

    public function log(QueryExecuted $query): void
    {
        if (! $this->queryShouldBeLogged($query)) {
            return;
        }

        $this->logChannelFactory->make()->info(
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
