[![Build Status](https://api.travis-ci.org/MrJoshLab/laravel-phantomjs.svg?branch=develop)](https://travis-ci.org/MrJoshLab/laravel-phantomjs)
[![Latest Stable Version](https://poser.pugx.org/josh/laravel-phantomjs/v/stable)](https://packagist.org/packages/josh/laravel-phantomjs)
[![Total Downloads](https://poser.pugx.org/josh/laravel-phantomjs/downloads)](https://packagist.org/packages/josh/laravel-phantomjs)
[![Latest Unstable Version](https://poser.pugx.org/josh/laravel-phantomjs/v/unstable)](https://packagist.org/packages/josh/laravel-phantomjs)
[![Discord](https://discordapp.com/api/guilds/638962572032475148/embed.png)](https://discord.gg/NGeAPHv)
[![License](https://poser.pugx.org/josh/laravel-phantomjs/license)](https://packagist.org/packages/josh/laravel-phantomjs)

# Laravel PhantomJs Client
Using phantomjs client in laravel 

[Full documentation](http://jonnnnyw.github.io/php-phantomjs/)

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
'PhantomJs' => Josh\Component\PhantomJs\Facade\PhantomJs::class
```

and then you can run vendor:publish command for generating phantomjs config file
 ```bash
 $ php artisan vendor:publish --provider="Josh\Component\PhantomJs\PhantomJsServiceProvider"
 ```

#### Now you can config your phantomjs client in ```config/phantomjs.php``` file

## Basic Usage
The following illustrates how to make a basic GET request and output the page content:

### On Load Finished
```php
// Tells the client to wait for all resources before rendering

$request = \PhantomJs::get('http://phantomjs.org/');

\PhantomJs::isLazy()->send($request);
```

```php
// you can use Facade or app make function to use phantomjs
// ex: app('phantomjs') or \PhantomJs

$request = \PhantomJs::get('http://phantomjs.org/');

$response = \PhantomJs::send($request);

if($response->getStatus() === 200) {

    // Dump the requested page content
    echo $response->getContent();
}
```

Saving a screen capture to local disk:
```php

$request = \PhantomJs::createImage('http://phantomjs.org/', 'GET');

$request->setOutputFile(public_path('file.jpg'));

$request->setViewportSize(800, 600);

$request->setCaptureDimensions(800, 600, 0, 0);

$response = \PhantomJs::send($request);

if($response->getStatus() === 200) {

    // Dump the requested page content
    echo $response->getContent();
}
```

Outputting a page as PDF:

```php
$request = \PhantomJs::createPdf('http://phantomjs.org/', 'GET');
$request->setOutputFile(public_path('document.pdf'));
$request->setFormat('A4');
$request->setOrientation('landscape');
$request->setMargin('1cm');

$response = \PhantomJs::send($request);

if($response->getStatus() === 200) {

    // Dump the requested page content
    echo $response->getContent();
}
```

## License
The MIT License (MIT)
