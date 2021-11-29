<?php

declare(strict_types=1);

namespace Wimski\LaravelQueryLogger\Providers\Contracts;

use Illuminate\Database\Events\QueryExecuted;

interface QueryLogFormatterInterface
{
    public function format(QueryExecuted $query): string;
}
