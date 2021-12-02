<?php

return [
    'enabled'                => env('QUERY_LOGGER_ENABLED', false),
    'clear_on_every_request' => env('QUERY_LOGGER_CLEAR_ON_EVERY_REQUEST', false),
    'channel_name'           => env('QUERY_LOGGER_CHANNEL_NAME', 'query'),
    'channel_config'         => [
        'driver' => env('QUERY_LOGGER_DRIVER', 'single'),
        'level'  => env('QUERY_LOGGER_LEVEL', 'debug'),
        'path'   => storage_path(env('QUERY_LOGGER_PATH', 'logs/query.log')),
    ],
    'minimum_duration'       => env('QUERY_LOGGER_MINIMUM_DURATION', 0),
    'match_pattern'          => env('QUERY_LOGGER_MATCH_PATTERN', '/^(select|insert|update|delete)((?!migration).)*/i'),
    'rules'                  => [
        Wimski\LaravelQueryLogger\Rules\MinimumDurationRule::class,
        Wimski\LaravelQueryLogger\Rules\MatchesPatternRule::class,
    ],
];
