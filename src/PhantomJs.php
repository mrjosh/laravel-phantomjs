<?php

namespace Josh\Component\PhantomJs;

use JonnyW\PhantomJs\Client;
use JonnyW\PhantomJs\Engine;
use JonnyW\PhantomJs\Http\Request;
use JonnyW\PhantomJs\Http\Response;
use JonnyW\PhantomJs\Http\PdfRequest;
use JonnyW\PhantomJs\Http\CaptureRequest;
use JonnyW\PhantomJs\Http\RequestInterface;
use JonnyW\PhantomJs\Http\ResponseInterface;

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
     * PhantomJs Client
     *
     * @var Client
     */
    protected $client;

    /**
     * PhantomJs constructor.
     * Set options of phantomjs
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        $this->engine = new Engine;
        $this->setOptions($options);
        $this->container = $this->getContainer();
        $this->setClient();
    }

    /**
     * Set binary path for phantomjs
     * 
     * @param $path
     * @return $this
     */
    public function setBinaryPath($path) : PhantomJs
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
    public function setDebug($debug) : PhantomJs
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
    public function setCache($cache) : PhantomJs
    {
        $this->engine->cache($cache);

        return $this;
    }

    /**
     * Get engine object of phantomjs client
     *
     * @return Engine
     */
    public function getEngine() : Engine
    {
        return $this->engine;
    }

    /**
     * Get container object
     *
     * @return PhantomJsServiceContainer
     */
    public function getContainer() : PhantomJsServiceContainer
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
    public function getClient() : Client
    {
        if (!$this->client) {
			$this->setClient();
		}

        return $this->client;
    }

    /**
     * Set PhantomJs Client
     *
     * @param null $client
     * @return PhantomJs
     */
    public function setClient($client = null)
    {
        try {

            $this->client = is_null($client) ? new Client(
                $this->container->get('engine'),
                $this->container->get('procedure_loader'),
                $this->container->get('procedure_compiler'),
                $this->container->get('message_factory')
            ) : $client;

        } catch (\Exception $exception) {}

        return $this;
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
        $this->engine->setOptions($options);

        return $this;
    }

    /**
     * Set isLazy option to client
     *
     * @return $this
     */
    public function isLazy()
    {
        $client = $this->getClient()->isLazy();

        return $this->setClient($client);
    }

    /**
     * send request
     *
     * @param $url
     * @param $method
     * @param $timeout
     * @param array $headers
     * @param array $parameters
     * @return Request
     */
    public function request(string $url, string $method = "GET", int $timeout = 5000, array $headers = [], array $parameters = []) : Request
    {
        $request = new Request($url, $method, $timeout);

        $request->setHeaders($headers);

        $request->setRequestData($parameters);

        return $request;
    }

    /**
     * Create pdf request
     *
     * @param $url
     * @param $method
     * @param int $timeout
     * @param array $headers
     * @param array $parameters
     * @return PdfRequest
     */
    public function createPdf(string $url, string $method = RequestInterface::METHOD_GET, int $timeout = 5000, array $headers = [], array $parameters = []) : PdfRequest
    {
        $request = new PdfRequest($url, $method, $timeout);

        $request->setHeaders($headers);

        $request->setRequestData($parameters);

        return $request;
    }

    /**
     * Create pdf request
     *
     * @param $url
     * @param $method
     * @param int $timeout
     * @param array $headers
     * @param array $parameters
     * @return CaptureRequest
     */
    public function createImage(string $url, string $method = RequestInterface::METHOD_GET, int $timeout = 5000, array $headers = [], array $parameters = []) : CaptureRequest
    {
        $request = new CaptureRequest($url, $method, $timeout);

        $request->setHeaders($headers);

        $request->setRequestData($parameters);

        return $request;
    }

    /**
     * send get request
     *
     * @param $url
     * @param array $headers
     * @param array $parameters
     * @return Request
     */
    public function get(string $url, array $headers = [], array $parameters = []) : Request
    {
        return $this->request($url, RequestInterface::METHOD_GET, 5000, $headers, $parameters);
    }

    /**
     * Send post request
     *
     * @param $url
     * @param array $headers
     * @param array $parameters
     * @return Request
     */
    public function post(string $url, array $headers = [], array $parameters = []) : Request
    {
        return $this->request($url, RequestInterface::METHOD_POST, 5000, $headers, $parameters);
    }

    /**
     * Send PUT request
     *
     * @param $url
     * @param array $headers
     * @param array $parameters
     * @return Request
     */
    public function put(string $url, array $headers = [], array $parameters = []) : Request
    {
        return $this->request($url, RequestInterface::METHOD_PUT, 5000, $headers, $parameters);
    }

    /**
     * Send PUT request
     *
     * @param $url
     * @param array $headers
     * @param array $parameters
     * @return Request
     */
    public function delete(string $url, array $headers = [], array $parameters = []) : Request
    {
        return $this->request($url, RequestInterface::METHOD_DELETE, 5000, $headers, $parameters);
    }

    /**
     * Send request with response
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function send(RequestInterface $request, ResponseInterface $response = null) : ResponseInterface
    {
        return $this->getClient()->send($request, ( is_null($response) ? new Response : $response ) );
    }
}
