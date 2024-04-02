# Sail on Lagoon

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bomoko/sailinglagoon.svg?style=flat-square)](https://packagist.org/packages/bomoko/sailinglagoon)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/bomoko/sailinglagoon/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/bomoko/sailinglagoon/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/bomoko/sailinglagoon/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/bomoko/sailinglagoon/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/bomoko/sailinglagoon.svg?style=flat-square)](https://packagist.org/packages/bomoko/sailinglagoon)

Sail on Lagoon is a Laravel extension that simplifies the process of Lagoonizing Laravel sites 
that are already using Laravel Sail to generate their docker-compose setup.
This extension provides additional features and configurations tailored for Lagoon environments.

## Installation

The assumption is that you've already set up your Laravel development environment locally using [Sail](https://laravel.com/docs/11.x/sail). 

Once you have your Laravel site running locally, you can install `Sail on Lagoon` via composer:

```bash
composer require bomoko/sailinglagoon
```

To use Sail on Lagoon, run the following Artisan command:

```bash
php artisan sail:onlagoon [--projectName=my-lagoon-project] [--no-interaction]
```

This will read your sail generated docker-compose.yml file and attempt to generate the required files for a Lagoon installation.
You can, optionally, specify the name of your project and skip the interactive question.
Specifying `--no-interaction` will skip any interaction (including warnings) and Lagoonize the project.

## Supported Services

Sail-on-Lagoon currently supports the following service types:

    MySQL
    PostgreSQL
    MariaDB
    Redis
    MeiliSearch

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Blaize Kaye](https://github.com/bomoko)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
