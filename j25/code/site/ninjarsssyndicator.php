<?php

/**
* @version      2.0
* @package      com_ninjarsssydicator
* @author       NinjaForge
* @author email support@ninjaforge.com
* @link         http://ninjaforge.com
* @license      http://www.gnu.org/copyleft/gpl.html GNU GPL
* @copyright    Copyright (C) 2012 NinjaForge - All rights reserved.
*/

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