<?php

declare(strict_types=1);

namespace Wimski\LaravelQueryLogger\Rules;

use Illuminate\Database\Events\QueryExecuted;

class MatchesPatternRule extends AbstractRule
{
    public function passes(QueryExecuted $query): bool
    {
        $pattern = $this->config->get('query-logger.match_pattern');

        return preg_match($pattern, $query->sql) === 1;
    }
}
