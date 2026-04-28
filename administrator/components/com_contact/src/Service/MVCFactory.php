<?php

/**
 * @package         Joomla.Administrator
 * @subpackage      com_contact
 *
 * @copyright   (C) 2005 Open Source Matters, Inc. <https://www.joomla.org>
 * @license         GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Contact\Administrator\Service;

use Joomla\CMS\Factory;
use Psr\Log\LoggerInterface;

class MVCFactory extends \Joomla\CMS\MVC\Factory\MVCFactory
{
    /**
     * Define the namespace
     *
     * @var string
     */
    private $namespace;

    /**
     * Override the constructor to namespace in it own property since $namespace property in parent class is private
     *
     * @param   string            $namespace  The namespace
     * @param   ?LoggerInterface  $logger     A logging instance to inject into the controller if required
     *
     * @since   __DEPLOY_VERSION__
     */
    public function __construct($namespace, ?LoggerInterface $logger = null)
    {
        parent::__construct($namespace, $logger);

        $this->namespace = $namespace;
    }

    /**
     * Returns a standard classname, if the class doesn't exist null is returned.
     *
     * @param   string  $suffix  The suffix
     * @param   string  $prefix  The prefix
     *
     * @return  string|null  The class name
     *
     * @since   3.10.0
     */
    protected function getClassName(string $suffix, string $prefix)
    {
        if (!$prefix) {
            $prefix = Factory::getApplication();
        }

        $possibleClasses = [
            trim($this->namespace, '\\') . '\\' . ucfirst($prefix) . '\\Override\\' . $suffix,
            trim($this->namespace, '\\') . '\\' . ucfirst($prefix) . '\\' . $suffix
        ];

        foreach ($possibleClasses as $class) {
            if (class_exists($class)) {
                return $class;
            }
        }

        return null;
    }
}