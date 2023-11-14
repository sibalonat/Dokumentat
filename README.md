![Alt text](<art/KEYSOFT_Logo blu.svg>)
# Package for using only office and php excel and word

This package offers the possibility to use onlyoffice with Vue 3. It provides controllers, models, and jobs to make connection to OnlyOffice editor and make for example conversion of documents to PDF or other. But some of the files included will serve as examples on how to use OnlyOffice and some of the best practises i noticed this year by using this package.

This package relies heavily on:
=== BEFORE INSTALLING THIS PACKAGE BE SURE TO INSTALL BREEZE WITH INERTIA.VUE === 
- [Laravel Inertia](https://github.com/inertiajs/inertia-laravel), 
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

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="dokumentat-views"
```

## Usage
After having installed inertia appart or through breeze, you will install 
```php
php artisan vendor:publish --tag="dokumentat-views"
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
