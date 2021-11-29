<?php

declare(strict_types=1);

namespace Wimski\LaravelQueryLogger;

use Illuminate\Contracts\Container\Container;
use Wimski\LaravelQueryLogger\Providers\Contracts\RuleFactoryInterface;
use Wimski\LaravelQueryLogger\Providers\Contracts\RuleInterface;

class RuleFactory implements RuleFactoryInterface
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function make(string $ruleClass): RuleInterface
    {
        return $this->container->make($ruleClass);
    }
}
