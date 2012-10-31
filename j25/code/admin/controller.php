<?php
/*
* @version		2.0
* @package		com_ninjarsssydicator
* @author 		NinjaForge
* @author email	support@ninjaforge.com
* @link			http://ninjaforge.com
* @license      http://www.gnu.org/copyleft/gpl.html GNU GPL
* @copyright	Copyright (C) 2012 NinjaForge - All rights reserved.
*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');
//JHTML::styleSheet('coolfeed.css', 'administrator/components/com_ninjarsssyndicator/assets/css/');
JSubMenuHelper::addEntry(JText::_('Dashboard'), 'index.php?option=com_ninjarsssyndicator&view=info');
JSubMenuHelper::addEntry(JText::_('Feeds'), 'index.php?option=com_ninjarsssyndicator');
JSubMenuHelper::addEntry(JText::_('Botton Maker'), 'index.php?option=com_ninjarsssyndicator&view=buttonmaker');
JSubMenuHelper::addEntry(JText::_('Default settings'), 'index.php?option=com_ninjarsssyndicator&view=config');

class NinjaRssSyndicatorController extends JController
{
	/**
	 * display task
	 *
	 * @return void
	 */
	function display($cachable = false) 
	{
		// set default view if not set
		JRequest::setVar('view', JRequest::getCmd('view', 'feeds'));

		// call parent behavior
		parent::display($cachable);
	}
}
