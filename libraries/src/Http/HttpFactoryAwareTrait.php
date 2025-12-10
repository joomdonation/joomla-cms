<?php
/**
 * Joomla! Content Management System
 *
 * @copyright  (C) 2012 Open Source Matters, Inc. <https://www.joomla.org>
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\CMS\Http;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;

// phpcs:enable PSR1.Files.SideEffects

trait HttpFactoryAwareTrait
{
    /**
     * The CMS HTTP factory.
     *
     * @var  CMSHttpFactory
     * @since  __DEPLOY_VERSION__
     */
    private CMSHttpFactory $httpFactory;

    /**
     * Set the CMS HTTP factory to use.
     *
     * @param   CMSHttpFactory  $httpFactory  The HTTP factory to use.
     *
     * @return  void
     *
     * @since   __DEPLOY_VERSION__
     */
    public function setHttpFactory(CMSHttpFactory $httpFactory): void
    {
        $this->httpFactory = $httpFactory;
    }

    /**
     * Get the CMS HTTP factory.
     *
     * @return  CMSHttpFactory  The HTTP factory.
     *
     * @since   __DEPLOY_VERSION__
     */
    public function getHttpFactory(): CMSHttpFactory
    {
        if (isset($this->httpFactory)) {
            return $this->httpFactory;
        }

        throw new \UnexpectedValueException('HTTP Factory not set in ' . __CLASS__);
    }
}