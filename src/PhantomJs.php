<?php

namespace Josh\Component\PhantomJs;

use Illuminate\Support\Arr;
use JonnyW\PhantomJs\Client;
use JonnyW\PhantomJs\Engine;
use JonnyW\PhantomJs\Http\RequestInterface;

class PhantomJs
{
    /**
     * phantomjs engine object
     *
     * @var Engine
     */
    protected $engine;

    /**
     * Phantomjs container object
     *
     * @var PhantomJsServiceContainer
     */
    protected $container;

    /**
     * PhantomJs constructor.
     * Set options of phantomjs
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        $this->engine = new Engine();
        $this->setOptions($options);
        $this->container = $this->getContainer();
    }

    /**
     * Set binary path for phantomjs
     * 
     * @param $path
     * @return $this
     */
    public function setBinaryPath($path)
    {
        $this->engine->setPath($path);

        return $this;
    }

    /**
     * Set debug mode
     *
     * @param $debug
     * @return $this
     */
    public function setDebug($debug)
    {
        $this->engine->debug($debug);

        return $this;
    }

    /**
     * Set cache mode
     *
     * @param $cache
     * @return $this
     */
    public function setCache($cache)
    {
        $this->engine->cache($cache);

        return $this;
    }

    /**
     * Get engine object of phantomjs client
     *
     * @return \Illuminate\Foundation\Application|mixed
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * Get container object
     *
     * @return PhantomJsServiceContainer
     */
    public function getContainer()
    {
        $serviceContainer = PhantomJsServiceContainer::getInstance();

        $serviceContainer->set('engine', $this->getEngine());

        return $serviceContainer;
    }

    /**
     * Get client
     *
     * @return \Exception|Client
     */
    public function getClient()
    {
        try {

            return new Client(
                $this->container->get('engine'),
                $this->container->get('procedure_loader'),
                $this->container->get('procedure_compiler'),
                $this->container->get('message_factory')
            );

        } catch (\Exception $exception) {

            return $exception;
        }
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->engine->getOptions();
    }

    /**
     * Set options
     *
     * @param array $options
     * @return PhantomJs
     */
    public function setOptions(array $options)
    {
        $this->setBinaryPath( Arr::get($options, 'binary_path', 'bin/phantomjs') );

        Arr::forget($options,'binary_path');

        $this->engine->setOptions($options);

        return $this;
    }

    /**
     * Create request
     *
     * @param $url
     * @param string $method
     * @param array $headers
     * @param array $data
     * @param int $timeout
     * @return RequestInterface
     */
    public function createRequest($url, $method = RequestInterface::METHOD_GET,$headers = [],$data = [], $timeout = 5000)
    {
        $request = $this->getClient()->getMessageFactory()->createRequest($url, $method, $timeout);

        $request->setHeaders($headers);

        $request->setRequestData($data);

        return $request;
    }

    /**
     * Get response of request
     *
     * @param $request
     * @return \JonnyW\PhantomJs\Http\ResponseInterface
     */
    public function createResponse($request)
    {
        $response = $this->getClient()->getMessageFactory()->createResponse();

        return $this->getClient()->send($request, $response);
    }

    /**
     * send get request
     *
     * @param $url
     * @param array $headers
     * @param array $parameters
     * @return \JonnyW\PhantomJs\Http\ResponseInterface
     */
    public function get($url,$headers = [],$parameters = [])
    {
        $request = $this->createRequest($url, 'GET', $headers, $parameters);

        return $this->createResponse($request);
    }

    /**
     * Send post request
     *
     * @param $url
     * @param array $headers
     * @param array $parameters
     * @return \JonnyW\PhantomJs\Http\ResponseInterface
     */
    public function post($url, $headers = [], $parameters = [])
    {
        $request = $this->createRequest($url, 'POST', $headers, $parameters);

        return $this->createResponse($request);
    }

    /**
     * Send PUT request
     *
     * @param $url
     * @param array $headers
     * @param array $parameters
     * @return \JonnyW\PhantomJs\Http\ResponseInterface
     */
    public function put($url, $headers = [], $parameters = [])
    {
        $request = $this->createRequest($url, 'PUT', $headers, $parameters);

        return $this->createResponse($request);
    }

    /**
     * Send PUT request
     *
     * @param $url
     * @param array $headers
     * @param array $parameters
     * @return \JonnyW\PhantomJs\Http\ResponseInterface
     */
    public function delete($url, $headers = [], $parameters = [])
    {
        $request = $this->createRequest($url, 'PUT', $headers, $parameters);

        return $this->createResponse($request);
    }
}