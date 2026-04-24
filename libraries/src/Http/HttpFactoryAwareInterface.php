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

/**
 * Interface for a http factory aware class.
 *
 * @since  __DEPLOY_VERSION__
 */
interface HttpFactoryAwareInterface
{
    /**
     * Set the http factory to use.
     *
     * @param   ?HttpFactoryInterface  $httpFactory  The http factory to use.
     *
     * @return  void
     *
     * @since   __DEPLOY_VERSION__
     */
    public function setHttpFactory(?HttpFactoryInterface $httpFactory = null);
}