<?php
/**
 * Joomla! Content Management System
 *
 * @copyright  (C) 2011 Open Source Matters, Inc. <https://www.joomla.org>
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\CMS\Http;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;

// phpcs:enable PSR1.Files.SideEffects

use Joomla\CMS\Version;
use Joomla\Http\Http;

class HttpClientFactory implements HttpFactoryInterface
{
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
     * @since   1.0
     */
    public function getHttp($options = [], $adapters = null)
    {
        // Set default userAgent if nothing else is set
        if (!isset($options['userAgent'])) {
            $version              = new Version();
            $options['userAgent'] = $version->getUserAgent('Joomla', true, false);
        }

        return (new \Joomla\Http\HttpFactory())->getHttp($options, $adapters);
    }
}
