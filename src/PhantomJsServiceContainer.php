<?php

namespace Josh\Component\PhantomJs;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * PHP PhantomJs
 *
 * For some reasons i haveto create an object to load phantomjs config files in laravel
 * i hope this problem gonna fix in main repo and we can use and enjoy. :)
 *
 * @author Alireza Josheghani <josheghani.dev@gmail.com>
 */
class PhantomJsServiceContainer extends ContainerBuilder
{
    /**
     * Service container instance
     *
     * @var \JonnyW\PhantomJs\DependencyInjection\ServiceContainer
     * @access private
     */
    private static $instance;

    /**
     * Get singleton instance
     *
     * @access public
     * @return PhantomJsServiceContainer
     */
    public static function getInstance()
    {
        if (! self::$instance instanceof PhantomJsServiceContainer) {

            self::$instance = new self;
            self::$instance->load();
        }

        return self::$instance;
    }

    /**
     * Load service container.
     *
     * @access public
     * @param null $file
     * @return void
     */
    public function load($file = null)
    {
        $loader = new YamlFileLoader($this, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('config.yml');
        $loader->load('services.yml');

        $this->setParameter('phantomjs.cache_dir', sys_get_temp_dir());
        $this->setParameter('phantomjs.resource_dir', __DIR__ . '/../Resources');
    }
}
