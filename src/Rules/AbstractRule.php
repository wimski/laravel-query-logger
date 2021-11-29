<?php

declare(strict_types=1);

namespace Wimski\LaravelQueryLogger\Rules;

use Illuminate\Contracts\Config\Repository as Config;
use Wimski\LaravelQueryLogger\Providers\Contracts\RuleInterface;

abstract class AbstractRule implements RuleInterface
{
    protected Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }
}
