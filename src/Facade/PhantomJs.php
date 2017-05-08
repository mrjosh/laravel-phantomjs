<?php

namespace Josh\Component\PhantomJs\Facade;

use Illuminate\Support\Facades\Facade;

class PhantomJs extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @author Alireza Josheghani <josheghani.dev@gmail.com>
     * @since 8 May 2017
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'pjclient';
    }
}