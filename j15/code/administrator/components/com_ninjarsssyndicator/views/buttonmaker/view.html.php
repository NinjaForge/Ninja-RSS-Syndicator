<?php

/**
* @Copyright Copyright (C) 2010 Ninja Forge
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
**/

defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

class NinjaRssSyndicatorViewButtonMaker extends JView
{
	function display($tpl = null)
	{
		$text = 'Button maker';
		JToolBarHelper::title(   JText::_( 'Ninja RSS Syndicator').': <small><small>[ ' . $text.' ]</small></small>', 'mediamanager.png' );
				
		parent::display($tpl);
	}
}
?>