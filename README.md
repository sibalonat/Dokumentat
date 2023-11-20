![Alt text](<art/KEYSOFT_Logo blu.svg>)
# ONLYOFFICE DEVELOPER EDITION Package for Laravel with Vue 3 Integration

## Overview
This Laravel package enables the integration of ONLYOFFICE DEVELOPER EDITION with Vue 3 applications. It includes controllers, models, and jobs to facilitate the connection with the ONLYOFFICE editor, allowing functionalities like document conversion to PDF among others. The package also includes example files demonstrating best practices and effective usage of ONLYOFFICE within a Laravel environment.

## Key Dependencies:


- [Laravel Inertia](https://github.com/inertiajs/inertia-laravel) -> Required, 
- [Laravel-Medialibrary](https://github.com/spatie/laravel-medialibrary) -> Recommended for enhanced file management, 
- [Laravel Breeze](https://github.com/laravel/breeze) - Simplifies the installation of Inertia, Tailwind, and Vue
- [Tailwind](https://tailwindcss.com/) -> For styling
- [Vue](https://vuejs.org/) -> Core dependency

### Prerequisites
```bash
=== Ensure Laravel Breeze with Inertia.Vue is installed before using this package === 
```

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

### Configuration Notes:
- The config file sets the local environment IP and handles callbacks for document conversions using ONLYOFFICE's asynchronous approach.
- Example configurations for local and production environments are provided below.

```bash
php artisan vendor:publish --tag="dokumentat-config"
```

This is the contents of the published config file:
- Local Environment Config:
```php
return [
    'developer' => 'http://192.168.0.3:82/"',
    'convert' => config('dokumentat.developer').'/ConvertService.ashx',
];
```
- Production Environment Config:
```php
return [
    'developer' => 'https://yourdomain.com/"',
    'convert' => config('dokumentat.developer').'/ConvertService.ashx',
];
```

<!-- Optionally, you can publish the views using -->

<!-- ```bash
php artisan vendor:publish --tag="dokumentat-views"
``` -->

## Usage
After installing Breeze (or Inertia separately) and this package, use the following command to set up the necessary files:
```php
php artisan dokumentat
```

This command will create a model, controller, a job, add routes, and a Vue document. It will also install the necessary npm packages.


### Upcoming Features:

- Guidelines for setting up a local environment with ONLYOFFICE.
- Integration examples with PHPWord and PHPExcel.




```php
Further details and use cases will be added soon, including setting up ONLYOFFICE locally and on a server, 
and integrating it with other applications.
```

___
## Tutorials: 
- [Part 1](https://medium.com/@marin.nikoli/this-year-i-ventured-beyond-the-usual-crud-applications-and-tackled-an-exciting-challenge-a1efe5a35df6) / ['Examples/Part1']
___

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

<!-- ## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities. -->

## Credits

- [Marin Nikolli](https://github.com/mnplus)
<!-- - [All Contributors](../../contributors) -->

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
