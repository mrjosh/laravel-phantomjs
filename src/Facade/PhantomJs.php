<?php

namespace Josh\Component\PhantomJs\Facade;

use Illuminate\Support\Facades\Facade;
use Josh\Component\PhantomJs\PhantomJs as PhantomJsComponent;
use JonnyW\PhantomJs\Engine;
use JonnyW\PhantomJs\Client;
use JonnyW\PhantomJs\Http\CaptureRequest;
use JonnyW\PhantomJs\Http\PdfRequest;
use JonnyW\PhantomJs\Http\Request;
use JonnyW\PhantomJs\Http\RequestInterface;
use JonnyW\PhantomJs\Http\ResponseInterface;
use JonnyW\PhantomJs\Http\MessageFactoryInterface;
use JonnyW\PhantomJs\Procedure\ProcedureLoaderInterface;
use JonnyW\PhantomJs\Procedure\ProcedureCompilerInterface;

/**
 * @method static PhantomJsComponent setBinaryPath($path)
 * @method static PhantomJsComponent setDebug($debug)
 * @method static PhantomJsComponent setCache($cache)
 * @method static Engine getEngine()
 * @method static PhantomJsServiceContainer getContainer()
 * @method static Client getClient()
 * @method static PhantomJsComponent setClient($client = null)
 * @method static mixed getOptions()
 * @method static PhantomJsComponent setOptions(array $options)
 * @method static PhantomJsComponent isLazy()
 * @method static CaptureRequest request(string $url, string $method = RequestInterface::METHOD_GET, int $timeout = 5000, array $headers = [], array $parameters = [])
 * @method static PdfRequest createPdf(string $url, string $method = RequestInterface::METHOD_GET, int $timeout = 5000, array $headers = [], array $parameters = [])
 * @method static CaptureRequest createImage(string $url, string $method = RequestInterface::METHOD_GET, int $timeout = 5000, array $headers = [], array $parameters = [])
 * @method static Request get(string $url, array $headers = [], array $parameters = [])
 * @method static Request post(string $url, array $headers = [], array $parameters = [])
 * @method static Request put(string $url, array $headers = [], array $parameters = [])
 * @method static Request delete(string $url, array $headers = [], array $parameters = [])
 * @method static ResponseInterface send(RequestInterface $request, ResponseInterface $response = null)
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
