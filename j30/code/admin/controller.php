<?php
/*
* @version		2.0
* @package		com_ninjarsssydicator
* @author 		NinjaForge
* @author email	support@ninjaforge.com
* @link			http://ninjaforge.com
* @license		http://www.gnu.org/copyleft/gpl.html GNU GPL
* @copyright	Copyright (C) 2012 NinjaForge - All rights reserved.
*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class NinjaRssSyndicatorController extends JControllerLegacy
{
	/**
	 * display task
	 *
	 * @return void
	 */
	public function display($cachable = false, $urlparams = false)
	{
		// set default view if not set
		JRequest::setVar('view', JRequest::getCmd('view', 'feeds'));
		$this->addSubMenu($this->input->get('view', 'feeds'));
		
		$view   = $this->input->get('view', 'index', 'word');
		$layout = $this->input->get('layout', 'index', 'word');

		if ($view == 'feed' && $layout == 'edit' && !$this->checkEditId('com_ninjarsssyndicator.edit.feed', $id)) {

			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_ninjarsssyndicator&view=feeds', false));

			return false;
		}
		
		// call parent behavior
		parent::display();
		return $this;
	}

	public function addSubMenu($vName)
	{
		JSubMenuHelper::addEntry(JText::_('Dashboard'), 'index.php?option=com_ninjarsssyndicator&view=info', $vName == 'info');
		JSubMenuHelper::addEntry(JText::_('Feeds'), 'index.php?option=com_ninjarsssyndicator', $vName == 'feeds');
		JSubMenuHelper::addEntry(JText::_('Button Maker'), 'index.php?option=com_ninjarsssyndicator&view=buttonmaker', $vName == 'buttonmaker');
		JSubMenuHelper::addEntry(JText::_('Default settings'), 'index.php?option=com_ninjarsssyndicator&view=config', $vName == 'config');
	}
}
