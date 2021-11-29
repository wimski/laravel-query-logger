<?php

declare(strict_types=1);

namespace Wimski\LaravelQueryLogger\Factories;

use Illuminate\Contracts\Container\Container;
use Wimski\LaravelQueryLogger\Providers\Contracts\Factories\RuleFactoryInterface;
use Wimski\LaravelQueryLogger\Providers\Contracts\Rules\RuleInterface;

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
