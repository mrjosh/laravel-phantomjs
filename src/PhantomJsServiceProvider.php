<?php

namespace Josh\Component\PhantomJs;

use JonnyW\PhantomJs\Engine;
use JonnyW\PhantomJs\Client;
use Illuminate\Support\ServiceProvider;
use JonnyW\PhantomJs\DependencyInjection\ServiceContainer;

class PhantomJsServiceProvider extends ServiceProvider
{
    /**
     * Publish config file
     *
     * @author Alireza Josheghani <josheghani.dev@gmail.com>
     * @since 7 May 2017
     * @return void
     */
    public function boot()
    {
        $this->publishes([ __DIR__ . '/../config.php' => config_path( 'phantomjs.php' ) ]);
    }

    /**
     * Register package to ur project
     *
     * @author Alireza Josheghani <josheghani.dev@gmail.com>
     * @since 7 May 2017
     * @return void
     */
    public function register()
    {
        $this->app->singleton('phantomjs', function(){

            $serviceContainer = $this->getServiceContainer();

            return new Client(
                $serviceContainer->get('engine'),
                $serviceContainer->get('procedure_loader'),
                $serviceContainer->get('procedure_compiler'),
                $serviceContainer->get('message_factory')
            );
        });
    }

    /**
     * Get engine istance
     *
     * @author Alireza Josheghani <josheghani.dev@gmail.com>
     * @since 8 May 2017
     * @return Engine
     */
    protected function getEngine()
    {
        $engine = $this->app->make(Engine::class);

        if(file_exists(config_path('phantomjs.php'))){
            $config = config('phantomjs');

            if(! empty($config['binary_path']) && ! is_null($config['binary_path'])){
                $engine->setPath($config['binary_path']);
            }

            if(! empty($config['options']) && ! is_null($config['options'])){
                $engine->setOptions($config['options']);
            }

            if(! empty($config['debug']) && ! is_null($config['debug'])){
                $engine->debug($config['debug']);
            }

            if(! empty($config['cache']) && ! is_null($config['cache'])){
                $engine->debug($config['cache']);
            }
        }

        return $engine;
    }

    /**
     * Get Service container instance
     *
     * @author Alireza Josheghani <josheghani.dev@gmail.com>
     * @since 8 May 2017
     * @return Client
     */
    protected function getServiceContainer()
    {
        $serviceContainer = ServiceContainer::getInstance();

        $serviceContainer->set('engine', $this->getEngine());

        return $serviceContainer;
    }
}
