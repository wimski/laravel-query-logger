<?php

declare(strict_types=1);

namespace Wimski\LaravelQueryLogger\Providers\Contracts\Factories;

use Wimski\LaravelQueryLogger\Providers\Contracts\Rules\RuleInterface;

interface RuleFactoryInterface
{
    public function make(string $ruleClass): RuleInterface;
}
