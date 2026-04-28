<?php
/**
 * @package         Joomla.Administrator
 * @subpackage      com_contact
 *
 * @copyright   (C) 2005 Open Source Matters, Inc. <https://www.joomla.org>
 * @license         GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Contact\Administrator\Service\Provider;

use Joomla\CMS\Factory;
use Joomla\Component\Contact\Administrator\Service\ApiMVCFactory;

class MVCFactory extends \Joomla\CMS\Extension\Service\Provider\MVCFactory
{
    public function createMVCFactory()
    {
        if (Factory::getApplication()->isClient('api')) {
            return new ApiMVCFactory($this->getNamespace());
        }

        return new \Joomla\Component\Contact\Administrator\Service\MVCFactory($this->getNamespace());
    }
}