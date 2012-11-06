<?php
/*
* @version		2.0
* @package		com_ninjarsssydicator
* @author		NinjaForge
* @author email support@ninjaforge.com
* @link			http://ninjaforge.com
* @license		http://www.gnu.org/copyleft/gpl.html GNU GPL
* @copyright	Copyright (C) 2012 NinjaForge - All rights reserved.
*/

// No direct access to this file
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

class NinjaRssSyndicatorViewInfo extends JViewLegacy
{
	function display($tpl = null)
	{
		$text = 'Dashboard';
		JToolBarHelper::title(	JText::_( 'Dashboard').': <small><small>[ ' . $text.' ]</small></small>', 'systeminfo.png' );
		parent::display($tpl);
	}
}
?>