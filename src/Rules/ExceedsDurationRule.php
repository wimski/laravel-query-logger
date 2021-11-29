<?php

declare(strict_types=1);

namespace Wimski\LaravelQueryLogger\Rules;


use Illuminate\Database\Events\QueryExecuted;

class ExceedsDurationRule extends AbstractRule
{
    public function passes(QueryExecuted $query): bool
    {
        $minimumDuration = (int) $this->config->get('query-logger.minimum_duration');

        return $query->time >= $minimumDuration * 1000;
    }
}
