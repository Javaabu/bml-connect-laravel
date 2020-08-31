# BML Connect Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/javaabu/bml-connect-laravel.svg?style=flat-square)](https://packagist.org/packages/javaabu/bml-connect-laravel)
[![Build Status](https://img.shields.io/travis/javaabu/bml-connect-laravel/master.svg?style=flat-square)](https://travis-ci.org/javaabu/bml-connect-laravel)
[![Quality Score](https://img.shields.io/scrutinizer/g/javaabu/bml-connect-laravel.svg?style=flat-square)](https://scrutinizer-ci.com/g/javaabu/bml-connect-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/javaabu/bml-connect-laravel.svg?style=flat-square)](https://packagist.org/packages/javaabu/bml-connect-laravel)

Laravel wrapper for [BML Connect PHP SDK](https://github.com/bankofmaldives/bml-connect-php).

## Installation

You can install the package via composer:

``` bash
composer require javaabu/bml-connect-laravel
```

**Laravel 5.5** uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider/Facade.

After updating composer, add the ServiceProvider to the providers array in config/app.php

``` bash
Javaabu\BmlConnect\Providers\BmlConnectServiceProvider::class;
```

Optionally you can use the Facade for shorter code. Add this to your facades:

``` bash
'BMLConnect' => Javaabu\BmlConnect\Facades\BmlConnectFacade::class;
```

### Setting up the BML Connect credentials

Add your BML Connect API Key and APP ID to your `config/services.php`.
You can refer to how to generate the API Keys from the (Official BML Connect Documentation)[https://github.com/bankofmaldives/bml-connect#authentication].

``` php
// config/services.php
...
'bml_connect' => [
    'api_key' => env('BML_CONNECT_API_KEY'), // API Key 
    'app_id' => env('BML_CONNECT_APP_ID'), // App ID
    'mode' => env('BML_CONNECT_MODE', 'production'), // Can either be production or sandbox
    // 'client_options' => [], // any additional options you want to pass to the GuzzleHttp client                           
],
...
```

## Usage

Using the App container:

 
``` php
$bml_connect = App::make('bml-connect');

$json = [
 "provider" => "alipay", // Payment method enabled for your merchant account such as bcmc, alipay, card
 "currency" => "MVR",
 "amount" => 1000, // 10.00 MVR
 "redirectUrl" => "https://foo.bar/order/123" // Optional redirect after payment completion
];

$transaction = $bml_connect->createTransaction($json);
```

Using the Facade

``` php

$json = [
 "provider" => "alipay", // Payment method enabled for your merchant account such as bcmc, alipay, card
 "currency" => "MVR",
 "amount" => 1000, // 10.00 MVR
 "redirectUrl" => "https://foo.bar/order/123" // Optional redirect after payment completion
];

$bml_connect = BMLConnect::createTransaction($json);
```

### Available Methods

``` php
BMLConnect::createTransaction($json);
BMLConnect::listTransactions($params);
BMLConnect::getTransaction($id);
BMLConnect::cancelTransaction($id);
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email info@javaabu.com instead of using the issue tracker.

## Credits

- [Javaabu Pvt. Ltd.](https://github.com/javaabu)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
