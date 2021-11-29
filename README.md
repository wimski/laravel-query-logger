# :warning: THIS PROJECT IS CURRENTLY A WIP AND CANNOT BE INSTALLED THROUGH COMPOSER! :warning:

# Laravel Query Logger

A Laravel package to log database queries for local debugging.

* [Installation](#installation)
* [Configuration](#configuration)
* [Customize Rules](#customize-rules)

## Installation

You can install the package via composer:

```bash
composer require --dev wimski/laravel-query-logger
```

The package is loaded using [Package Discovery](https://laravel.com/docs/8.x/packages#package-discovery), when disabled read [Manual Installation](#manual-installation).

## Configuration

Configuration is done using the following environment variables:

### `QUERY_LOGGER_ENABLED`
Default: `false`

### `QUERY_LOGGER_CLEAR_ON_EVERY_REQUEST`
Default: `false`

### `QUERY_LOGGER_MINIMUM_DURATION`
Default: `0`

### `QUERY_LOGGER_MATCH_PATTERN`
Default: `/^(select|insert|update|delete)((?!migration).)*/i`

### `QUERY_LOGGER_CHANNEL`
Default: `query`

### `QUERY_LOGGER_DRIVER`
Default: `single`

### `QUERY_LOGGER_LEVEL`
Default: `debug`

### `QUERY_LOGGER_PATH`
Default: `logs/query.log`

## Customize Rules

## Manual Installation

When disabled, register the `LaravelQueryLoggerServiceProvider` manually by adding it to your `config/app.php`

```php
/*
 * Package Service Providers...
 */
 Wimski\LaravelQueryLogger\LaravelQueryLoggerServiceProvider::class,
```

## Testing

```bash
composer test
```

## Credits

- [wimski](https://github.com/wimski)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
