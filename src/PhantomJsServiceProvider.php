<?php

namespace Josh\Component\PhantomJs;

use Illuminate\Support\ServiceProvider;

class PhantomJsServiceProvider extends ServiceProvider
{

    /**
     * Publish config file
     *
     * @author Alireza Josheghani <josheghani.dev@gmail.com>
     * @since 7 May 2017
     * @return void
     */
    public function boot() : void
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
    public function register() : void
    {
        $this->app->singleton('phantomjs', function(){

            return $this->getClient();
        });
    }

    /**
     * Get phantomjs client
     *
     * @author Alireza Josheghani <josheghani.dev@gmail.com>
     * @since 8 May 2017
     * @return PhantomJs
     */
    protected function getClient() : PhantomJs
    {
        $client = new PhantomJs;

        if(file_exists(config_path('phantomjs.php'))){
            $config = config('phantomjs');

            if(! empty($config['binary_path']) && ! is_null($config['binary_path'])){
                $client->setBinaryPath($config['binary_path']);
            }

            if(! empty($config['options']) && ! is_null($config['options'])){
                $client->setOptions($config['options']);
            }

            if(! empty($config['debug']) && ! is_null($config['debug'])){
                $client->setDebug($config['debug']);
            }

            if(! empty($config['cache']) && ! is_null($config['cache'])){
                $client->setCache($config['cache']);
            }
        }

        return $client;
    }
}
