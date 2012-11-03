<?php

/**
* @Copyright Copyright (C) 2010 Ninja Forge
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
**/

jimport('joomla.application.component.controller');

class NinjaRssSyndicatorControllerButtonMaker extends JController
{

	var $_link = null;
	function __construct()
	{
		
		parent::__construct();
		$this->_link = 'index.php?option=com_ninjarsssyndicator&task=buttonmaker';
	}
	
	function save()
	{		
		$model = $this->getModel('buttonmaker');
		$msg = $model->save($post);
		$is_ajaxed = isset($_SERVER["HTTP_X_REQUESTED_WITH"]) ? ($_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest") : false;
		if($is_ajaxed)
			exit($msg);		
		$this->setRedirect( $this->_link, $msg );
	}	
}
?>
