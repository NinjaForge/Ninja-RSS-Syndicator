<?php

/**
* @version		2.0
* @package		com_ninjarsssydicator
* @author 		NinjaForge
* @author email	support@ninjaforge.com
* @link			http://ninjaforge.com
* @license      http://www.gnu.org/copyleft/gpl.html GNU GPL
* @copyright	Copyright (C) 2012 NinjaForge - All rights reserved.
*/

jimport('joomla.application.component.controller');

class NinjaRssSyndicatorControllerConfig extends JController
{

	function __construct()
	{
		parent::__construct();
	}

	function save()
	{
		$model = $this->getModel('config');
		if ($model->saveConfig($post)) {
			$msg = JText::_( 'Settings Saved!' );
		} else {
			$msg = JText::_( 'Error Saving Settings' );
		}
		
		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_ninjarsssyndicator&view=config';
		$this->setRedirect($link, $msg);
	}
}
?>
