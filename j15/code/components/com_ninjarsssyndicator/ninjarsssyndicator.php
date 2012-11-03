<?php

/**
* @Copyright Copyright (C) 2010 Ninja Forge
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
**/

defined('_JEXEC') or die('Restricted access');

// Require the base controller
require_once (JPATH_COMPONENT.DS.'controllers'.DS.'defaultcontroller.php');

// Require specific controller if requested
if($controller = JRequest::getWord('controller')) {
	require_once (JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php');
}

// Create the controller
$classname	= 'NinjaRssSyndicatorController'.$controller;
//die($classname	);
$controller = new $classname( );

// Perform the Request task
$controller->execute( JRequest::getWord('task'));


// Redirect if set by the controller
$controller->redirect();
?>