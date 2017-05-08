# Laravel PhantomJs Client
Using phantomjs client in laravel 

# Requirement
* Laravel ^5.1
* PHP ^5.5

## Install

Via Composer

``` bash
$ composer require josh/laravel-phantomjs
```

##Config

Add the following provider to providers part of config/app.php
``` php
Josh\Component\PhantomJs\Provider\PhantomJsServiceProvider::class
```

and the following Facade to the aliases part
``` php
'PJCleint' => Josh\Component\PhantomJs\Facade\PhantomJs::class
```

## License
The MIT License (MIT)