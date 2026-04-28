<?php
/**
 * @package         Joomla.Administrator
 * @subpackage      com_contact
 *
 * @copyright   (C) 2008 Open Source Matters, Inc. <https://www.joomla.org>
 * @license         GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Contact\Administrator\Override\Controller;

class DisplayController extends \Joomla\Component\Contact\Administrator\Controller\DisplayController
{
	public function display($cachable = false, $urlparams = [])
	{
		echo 'Display called From Override Controller';

		parent::display($cachable, $urlparams);
	}
}