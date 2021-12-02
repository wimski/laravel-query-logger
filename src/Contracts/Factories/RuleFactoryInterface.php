<?php

declare(strict_types=1);

namespace Wimski\LaravelQueryLogger\Providers\Contracts\Factories;

use InvalidArgumentException;
use Wimski\LaravelQueryLogger\Providers\Contracts\Rules\RuleInterface;

interface RuleFactoryInterface
{
    /**
     * @param string $ruleClass
     * @return RuleInterface
     * @throws InvalidArgumentException
     */
    public function make(string $ruleClass): RuleInterface;
}
