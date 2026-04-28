<?php

/**
 * Joomla! Content Management System
 *
 * @copyright  (C) 2018 Open Source Matters, Inc. <https://www.joomla.org>
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\CMS\Extension\Service\Provider;

use Joomla\CMS\Cache\CacheControllerFactoryInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\Http\HttpFactoryInterface;
use Joomla\CMS\Mail\MailerFactoryInterface;
use Joomla\CMS\MVC\Factory\ApiMVCFactory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\Router\SiteRouter;
use Joomla\CMS\User\UserFactoryInterface;
use Joomla\Database\DatabaseInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Service provider for the service MVC factory.
 *
 * @since  4.0.0
 */
class MVCFactory implements ServiceProviderInterface
{
    /**
     * The extension namespace
     *
     * @var  string
     *
     * @since   4.0.0
     */
    private $namespace;

    /**
     * MVCFactory constructor.
     *
     * @param   string  $namespace  The namespace
     *
     * @since   4.0.0
     */
    public function __construct(string $namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * Registers the service provider with a DI container.
     *
     * @param   Container  $container  The DI container.
     *
     * @return  void
     *
     * @since   4.0.0
     */
    public function register(Container $container)
    {
        $container->set(
            MVCFactoryInterface::class,
            function (Container $container) {
                $factory = $this->createMVCFactory();

                $this->injectServicesIntoFactory($factory, $container);

                return $factory;
            }
        );
    }

    /**
     * Get namespace
     *
     * @return string
     */
    protected function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Create MVC Factory
     *
     * @return ApiMVCFactory|\Joomla\CMS\MVC\Factory\MVCFactory
     *
     * @throws \Exception
     */
    protected function createMVCFactory()
    {
        if (Factory::getApplication()->isClient('api')) {
            return new ApiMVCFactory($this->namespace);
        }

        return new \Joomla\CMS\MVC\Factory\MVCFactory($this->namespace);
    }

    /**
     * Inject services from container to MVCFactory
     *
     * @param   MVCFactory  $factory
     * @param   Container   $container
     *
     * @return void
     */
    protected function injectServicesIntoFactory(\Joomla\CMS\MVC\Factory\MVCFactory $factory, Container $container)
    {
        $factory->setFormFactory($container->get(FormFactoryInterface::class));
        $factory->setDispatcher($container->get(DispatcherInterface::class));
        $factory->setDatabase($container->get(DatabaseInterface::class));
        $factory->setSiteRouter($container->get(SiteRouter::class));
        $factory->setCacheControllerFactory($container->get(CacheControllerFactoryInterface::class));
        $factory->setUserFactory($container->get(UserFactoryInterface::class));
        $factory->setMailerFactory($container->get(MailerFactoryInterface::class));
        $factory->setHttpFactory($container->get(HttpFactoryInterface::class));
    }
}
