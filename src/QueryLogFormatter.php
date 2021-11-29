<?php

declare(strict_types=1);

namespace Wimski\LaravelQueryLogger;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Str;
use Wimski\LaravelQueryLogger\Providers\Contracts\QueryLogFormatterInterface;

class QueryLogFormatter implements QueryLogFormatterInterface
{
    public function format(QueryExecuted $query): string
    {
        $sql = $query->sql;

        foreach ($query->bindings as $binding) {
            $sql = Str::replaceFirst('?', $binding, $sql);
        }

        return $sql;
    }
}
