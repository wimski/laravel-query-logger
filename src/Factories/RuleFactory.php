<?php

declare(strict_types=1);

namespace Wimski\LaravelQueryLogger\Factories;

use Illuminate\Contracts\Container\Container;
use InvalidArgumentException;
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
        if (! in_array(RuleInterface::class, class_implements($ruleClass))) {
            throw new InvalidArgumentException('Rule classes must implement ' . RuleInterface::class);
        }

        return $this->container->make($ruleClass);
    }
}
