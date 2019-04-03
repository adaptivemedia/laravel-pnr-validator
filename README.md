# Validate Swedish Personal Identity Numbers

## Installation

Install the package with Composer via the command line:

```sh
composer require adaptivemedia/laravel-pnr-validator
```

This package has auto discovery so you don't need to add the Service Provider.

## Usage

Use it like any `Validator` rule:

```php
$rules = [
    'field' => 'pnr',
];
```

```php
$rules = [
    'field' => new PersonalIdentityNumber()
];
```

See the [Validation documentation](http://laravel.com/docs/validation) of Laravel.

## Valid formats

- YYYYMMDD-XXXX
- YYMMDD-XXXX
- YYYYMMDDXXXX
- YYMMDDXXXX
- XXXXXX-XXXX (organization, TODO)
- XXXXXXXXXX (organization, TODO)
