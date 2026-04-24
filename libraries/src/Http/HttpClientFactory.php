<?php

/**
 * Joomla! Content Management System
 *
 * @copyright  (C) 2011 Open Source Matters, Inc. <https://www.joomla.org>
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\CMS\Http;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

use Joomla\CMS\Version;
use Joomla\Http\Http;
use Joomla\Registry\Registry;

/**
 * HTTP client factory.
 *
 * @since  __DEPLOY_VERSION__
 */
class HttpClientFactory implements HttpFactoryInterface
{
    /**
     * The application configuration
     *
     * @var    Registry
     * @since  __DEPLOY_VERSION__
     */
    private $config;

    /**
     * The Joomla version
     *
     * @var    Version
     * @since  __DEPLOY_VERSION__
     */
    private $version;

    /**
     * Constructor.
     *
     * @param   Registry  $config   The application configuration
     * @param   Version   $version  The Joomla version
     *
     * @since   __DEPLOY_VERSION__
     */
    public function __construct(Registry $config, Version $version)
    {
        $this->config  = $config;
        $this->version = $version;
    }

    /**
     * Method to create an Http instance.
     *
     * @param   array|\ArrayAccess  $options   Client options array.
     * @param   array|string        $adapters  Adapter (string) or queue of adapters (array) to use for communication.
     *
     * @return  Http
     *
     * @throws  \InvalidArgumentException
     * @throws  \RuntimeException
     * @since   __DEPLOY_VERSION__
     */
    public function getHttp($options = [], $adapters = null)
    {
        // Set default userAgent if nothing else is set
        if (!isset($options['userAgent'])) {
            $options['userAgent'] = $this->version->getUserAgent('Joomla', true, false);
        }

        // Set proxy settings from global config if not already set and proxy is enabled
        if ($this->config->get('proxy_enable') && !isset($options['proxy'])) {
            $proxy = [];

            if ($host = $this->config->get('proxy_host')) {
                $proxy['host'] = $host;
            }

            if ($port = $this->config->get('proxy_port')) {
                $proxy['port'] = $port;
            }

            if ($user = $this->config->get('proxy_user')) {
                $proxy['user'] = $user;
            }

            if ($pass = $this->config->get('proxy_pass')) {
                $proxy['pass'] = $pass;
            }

            if (!empty($proxy)) {
                $options['proxy'] = $proxy;
            }
        }

        return (new \Joomla\Http\HttpFactory())->getHttp($options, $adapters);
    }
}
