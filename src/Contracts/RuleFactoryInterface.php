<?php

declare(strict_types=1);

namespace Wimski\LaravelQueryLogger\Providers\Contracts;

interface RuleFactoryInterface
{
    public function make(string $ruleClass): RuleInterface;
}
