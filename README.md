# Package for using only office and php excel and word

![Alt text](<art/KEYSOFT_Logo blu.svg>)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/keysoft/dokumentat.svg?style=flat-square)](https://packagist.org/packages/keysoft/dokumentat)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/keysoft/dokumentat/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/keysoft/dokumentat/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/keysoft/dokumentat/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/keysoft/dokumentat/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/keysoft/dokumentat.svg?style=flat-square)](https://packagist.org/packages/keysoft/dokumentat)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us


## Installation

You can install the package via composer:

```bash
composer require keysoft/dokumentat
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="dokumentat-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="dokumentat-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="dokumentat-views"
```

## Usage

```php
$dokumentat = new Keysoft\Dokumentat();
echo $dokumentat->echoPhrase('Hello, Keysoft!');
```

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

- [Marin Nikolli](https://github.com/mnplus)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
