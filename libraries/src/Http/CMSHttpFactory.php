<?php

/**
 * Joomla! Content Management System
 *
 * @copyright  (C) 2012 Open Source Matters, Inc. <https://www.joomla.org>
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\CMS\Http;

use Joomla\CMS\Version;
use Joomla\Http\HttpFactory as FrameworkHttpFactory;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * CMS HTTP factory class.
 *
 * @since  __DEPLOY_VERSION__
 */
class CMSHttpFactory
{
    /**
     * Method to create a JHttp instance.
     *
     * @param   array|\ArrayAccess  $options   Client options array.
     * @param   array|string        $adapters  Adapter (string) or queue of adapters (array) to use for communication.
     *
     * @return  \Joomla\Http\Http
     *
     * @throws  \RuntimeException
     * @since   __DEPLOY_VERSION__
     */
    public static function getHttp($options = [], $adapters = null)
    {
        if (!\is_array($options) && !($options instanceof \ArrayAccess)) {
            throw new \InvalidArgumentException(
                'The options param must be an array or implement the ArrayAccess interface.'
            );
        }

        // Set default userAgent if nothing else is set
        if (!isset($options['userAgent'])) {
            $version              = new Version();
            $options['userAgent'] = $version->getUserAgent('Joomla', true, false);
        }

        return (new FrameworkHttpFactory())->getHttp($options, $adapters);
    }
}
