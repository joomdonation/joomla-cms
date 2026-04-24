<?php
/**
 * Joomla! Content Management System
 *
 * @copyright  (C) 2011 Open Source Matters, Inc. <https://www.joomla.org>
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\CMS\Http;

// phpcs:disable PSR1.Files.SideEffects
use Joomla\Http\Http;

\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

interface HttpFactoryInterface
{
    /**
     * Method to create an Http instance.
     *
     * @param   array|\ArrayAccess  $options   Client options array.
     * @param   array|string        $adapters  Adapter (string) or queue of adapters (array) to use for communication.
     *
     * @return  Http
     *
     * @since   1.0
     * @throws  \InvalidArgumentException
     * @throws  \RuntimeException
     */
    public function getHttp($options = [], $adapters = null);
}