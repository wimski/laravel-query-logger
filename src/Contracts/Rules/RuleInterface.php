<?php

declare(strict_types=1);

namespace Wimski\LaravelQueryLogger\Providers\Contracts\Rules;

use Illuminate\Database\Events\QueryExecuted;

interface RuleInterface
{
    public function passes(QueryExecuted $query): bool;
}
