<?php
/*
* @version      2.0
* @package      com_ninjarsssydicator
* @author       NinjaForge
* @author email support@ninjaforge.com
* @link         http://ninjaforge.com
* @license      http://www.gnu.org/copyleft/gpl.html GNU GPL
* @copyright    Copyright (C) 2012 NinjaForge - All rights reserved.
*/
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

class NinjaRssSyndicatorViewButtonMaker extends JView
{
	function display($tpl = null)
	{
		$text = 'Button maker';
		JToolBarHelper::title(   JText::_( 'Ninja RSS Syndicator').': <small><small>[ ' . $text.' ]</small></small>', 'mediamanager.png' );
				
		parent::display($tpl);
	}
}
