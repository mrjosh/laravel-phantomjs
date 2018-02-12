[![Build Status](https://api.travis-ci.org/iamalirezaj/laravel-phantomjs.svg?branch=develop)](https://travis-ci.org/iamalirezaj/laravel-phantomjs)
[![Latest Stable Version](https://poser.pugx.org/josh/laravel-phantomjs/v/stable)](https://packagist.org/packages/josh/laravel-phantomjs)
[![Total Downloads](https://poser.pugx.org/josh/laravel-phantomjs/downloads)](https://packagist.org/packages/josh/laravel-phantomjs)
[![Latest Unstable Version](https://poser.pugx.org/josh/laravel-phantomjs/v/unstable)](https://packagist.org/packages/josh/laravel-phantomjs)
[![License](https://poser.pugx.org/josh/laravel-phantomjs/license)](https://packagist.org/packages/josh/laravel-phantomjs)
[![Say Thanks!](https://img.shields.io/badge/Say%20Thanks-!-1EAEDB.svg)](https://saythanks.io/to/iamalirezaj)

# Laravel PhantomJs Client
Using phantomjs client in laravel 

[Full documantion](http://jonnnnyw.github.io/php-phantomjs/)

# Requirement
* [laravel/framework ^5](https://github.com/laravel/laravel)
* [jonnyw/php-phantomjs 4.*](https://github.com/jonnnnyw/php-phantomjs)

## Install

Via Composer

```bash
$ composer require josh/laravel-phantomjs
```

## Config

Add the following provider to providers part of config/app.php
```php
Josh\Component\PhantomJs\PhantomJsServiceProvider::class
```

and the following Facade to the aliases part
```php
'PhantomJs' => Josh\Component\PhantomJs\PhantomJs::class
```

and then you can run vendor:publish command for generating phantomjs config file
 ```bash
 $ php artisan vendor:publish --provider="Josh\Component\PhantomJs\PhantomJsServiceProvider"
 ```

#### Now you can config your phantomjs client in ```config/phantomjs.php``` file

## Basic Usage
The following illustrates how to make a basic GET request and output the page content:

```php
// you can use Facade or app make function to use phantomjs
// ex: app('phantomjs') or \PhantomJs

$response = \PhantomJs::get('http://google.com');

if($response->getStatus() === 200) {

    // Dump the requested page content
    echo $response->getContent();
}
```

Saving a screen capture to local disk:
```php

$width  = 800;
$height = 600;
$top    = 0;
$left   = 0;

$request = \PhantomJs::getMessageFactory()->createCaptureRequest('http://google.com', 'GET');

$request->setOutputFile(public_path('file.jpg'));

$request->setViewportSize($width, $height);

$request->setCaptureDimensions($width, $height, $top, $left);

$response = \PhantomJs::getMessageFactory()->createResponse();

\PhantomJs::send($request, $response);
```

Outputting a page as PDF:

```php
use Josh\Component\PhantomJs\PhantomJs;

$request = PhantomJs::getMessageFactory()->createPdfRequest('http://google.com', 'GET');
$request->setOutputFile(public_path('document.pdf'));
$request->setFormat('A4');
$request->setOrientation('landscape');
$request->setMargin('1cm');

$response = PhantomJs::getMessageFactory()->createResponse();

PhantomJs::send($request, $response);
```

## License
The MIT License (MIT)
