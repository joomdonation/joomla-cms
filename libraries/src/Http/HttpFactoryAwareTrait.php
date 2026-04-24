<?php

/**
 * Joomla! Content Management System
 *
 * @copyright  (C) 2018 Open Source Matters, Inc. <https://www.joomla.org>
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\CMS\Http;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Defines the trait for a HttpFactoryAwareTrait Aware Class.
 *
 * @since  __DEPLOY_VERSION__
 */
trait HttpFactoryAwareTrait
{
    /**
     * HttpFactoryInterface
     *
     * @var    HttpFactoryInterface
     * @since  __DEPLOY_VERSION__
     */
    private $httpFactory;

    /**
     * Get the FormFactoryInterface.
     *
     * @return  HttpFactoryInterface
     *
     * @throws  \UnexpectedValueException May be thrown if the FormFactory has not been set.
     * @since   4.0.0
     */
    public function getHttpFactory(): HttpFactoryInterface
    {
        if ($this->httpFactory) {
            return $this->httpFactory;
        }

        throw new \UnexpectedValueException('HttpFactory not set in ' . __CLASS__);
    }

    /**
     * Set the form factory to use.
     *
     * @param   ?HttpFactoryInterface  $httpFactory  The http factory to use.
     *
     * @return  $this
     *
     * @since   4.0.0
     */
    public function setHttpFactory(?HttpFactoryInterface $httpFactory = null)
    {
        $this->httpFactory = $httpFactory;

        return $this;
    }
}
