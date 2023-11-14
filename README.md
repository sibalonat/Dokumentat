![Alt text](<art/KEYSOFT_Logo blu.svg>)
# Package for using ONLYOFFICE DEVELOPER EDITION for documents

This package offers the possibility to use onlyoffice with Vue 3. It provides controllers, models, and jobs to make connection to OnlyOffice editor and make for example conversion of documents to PDF or other. But some of the files included will serve as examples on how to use OnlyOffice and some of the best practises i noticed this year by using this package.

This package relies heavily on:
```bash
=== BEFORE INSTALLING THIS PACKAGE BE SURE TO INSTALL BREEZE WITH INERTIA.VUE === 
```

- [Laravel Inertia](https://github.com/inertiajs/inertia-laravel), 
- [Laravel-Medialibrary](https://github.com/spatie/laravel-medialibrary) -> this would be helpful to install, 
- [Laravel Breeze](https://github.com/laravel/breeze) - that will in fact streamline installing inertia, tailwind and vue
- [Tailwind](https://tailwindcss.com/)
- [Vue](https://vuejs.org/)

<!-- ## Support us -->


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
- This file is responsabile for adding the IP on local environment. 
- If you have purchased the developer edition like we did from OnlyOffice for internal use you would be able to refer to this guide also for installing the application on the Production
- The two basic configuration here are developer: that will be the ip or domain when in production, and then the other is the callback when we send a request for converting the document. OnlyOffice uses async approach to these type of callbacks, therefore it first finishes doing the process, and then sends back the payload with the changes. 

```bash
php artisan vendor:publish --tag="dokumentat-config"
```

This is the contents of the published config file:

```php
return [
    'developer' => 'http://192.168.0.3:82/"',
    'convert' => config('dokumentat.developer').'/ConvertService.ashx',
];
```
- or in prod
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
After having installed inertia appart or through breeze, and installed this package, appart for migration and config, there are some examples i've added to the package to be included in your project. The way to do that, would be to hit a command of the package. 
```php
php artisan dokumentat
```

This will create a model, controller, a job, some entries on web route, and finally a vue document, that will connect everything together. 

```bash
Later i will add more explaining and some use cases on how to setup ONLYOFFICE
locally and on the server, and some examples on using it with other applications
```

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
