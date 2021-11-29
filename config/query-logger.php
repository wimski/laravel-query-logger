<?php

return [
    'enabled'                => env('QUERY_LOGGER_ENABLED', false),
    'clear_on_every_request' => env('QUERY_LOGGER_CLEAR_ON_EVERY_REQUEST', false),
    'minimum_duration'       => env('QUERY_LOGGER_MINIMUM_DURATION', 0),
    'match_pattern'          => env('QUERY_LOGGER_MATCH_PATTERN', '/^(select|insert|update|delete)((?!migration).)*/i'),
    'channel'                => env('QUERY_LOGGER_CHANNEL', 'query'),
    'driver'                 => env('QUERY_LOGGER_DRIVER', 'single'),
    'level'                  => env('QUERY_LOGGER_LEVEL', 'debug'),
    'path'                   => env('QUERY_LOGGER_PATH', 'logs/query.log'),
];
