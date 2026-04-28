<?php

/**
 * @package         Joomla.Administrator
 * @subpackage      com_contact
 *
 * @copyright   (C) 2005 Open Source Matters, Inc. <https://www.joomla.org>
 * @license         GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Contact\Administrator\Service;

class ApiMVCFactory extends MVCFactory
{
    /**
     * Method to load and return a model object.
     *
     * @param   string  $name    The name of the model.
     * @param   string  $prefix  Optional model prefix.
     * @param   array   $config  Optional configuration array for the model.
     *
     * @return  \Joomla\CMS\MVC\Model\ModelInterface  The model object
     *
     * @throws  \Exception
     * @since   4.0.0
     */
    public function createModel($name, $prefix = '', array $config = [])
    {
        $model = parent::createModel($name, $prefix, $config);

        if (!$model) {
            $model = parent::createModel($name, 'Administrator', $config);
        }

        return $model;
    }
}