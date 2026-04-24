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

interface HttpFactoryAwareInterface
{
    /**
     * Set the mailer factory to use.
     *
     * @param   ?HttpFactoryInterface  $httpFactory  The mailer factory to use.
     *
     * @return  void
     *
     * @since   4.4.0
     */
    public function setHttpFactory(?HttpFactoryInterface $httpFactory = null);
}