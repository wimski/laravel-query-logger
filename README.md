# Laravel Query Logger

A Laravel package to log database queries for local debugging.

## Installation

You can install the package via composer:

```bash
composer require --dev wimski/laravel-query-logger
```

The package is loaded using [Package Discovery](https://laravel.com/docs/8.x/packages#package-discovery), when disabled read [Manual Installation](#manual-installation).

## Configuration

Configuration is done using the following environment variables:

### `QUERY_LOGGER_ENABLED`
### `QUERY_LOGGER_CLEAR_ON_EVERY_REQUEST`
### `QUERY_LOGGER_MINIMUM_DURATION`
### `QUERY_LOGGER_MATCH_PATTERN`
### `QUERY_LOGGER_CHANNEL`
### `QUERY_LOGGER_DRIVER`
### `QUERY_LOGGER_LEVEL`
### `QUERY_LOGGER_PATH`

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
