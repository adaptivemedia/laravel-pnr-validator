# Laravel 5 Package For Validating a Swedish Personnummer

## Installation

Install the package through [Composer](http://getcomposer.org).

On the command line:

```sh
composer require adaptivemedia/pnr-validator: dev-master
```

## Configuration

Add the following to your `providers` array in `config/app.php`:

```php
'providers' => array(
    // ...

    'Adaptivemedia\PnrValidator\PnrValidatorServiceProvider',
),
```


## Usage

Use it like any `Validator` rule:

```php
$rules = [
    'field' => 'pnr',
];
```

See the [Validation documentation](http://laravel.com/docs/validation) of Laravel.

## Valid pnr formats

- YYYYMMDD-XXXX
- YYMMDD-XXXX
- YYYYMMDDXXXX
- YYMMDDXXXX
