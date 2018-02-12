<?php

namespace Josh\Component\PhantomJs\Facade;

use JonnyW\PhantomJs\Engine;
use Illuminate\Support\Facades\Facade;
use JonnyW\PhantomJs\Http\RequestInterface;
use JonnyW\PhantomJs\Http\ResponseInterface;
use JonnyW\PhantomJs\Http\MessageFactoryInterface;
use JonnyW\PhantomJs\Procedure\ProcedureLoaderInterface;
use JonnyW\PhantomJs\Procedure\ProcedureCompilerInterface;

/**
 * @method static getLog
 * @method static void isLazy
 * @method static Engine getEngine
 * @method static string getProcedure
 * @method static void setProcedure($procedure)
 * @method static MessageFactoryInterface getMessageFactory
 * @method static ProcedureLoaderInterface getProcedureLoader
 * @method static ProcedureCompilerInterface getProcedureCompiler
 * @method static ResponseInterface send(RequestInterface $request, ResponseInterface $response)
 */
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
        return 'phantomjs';
    }
}