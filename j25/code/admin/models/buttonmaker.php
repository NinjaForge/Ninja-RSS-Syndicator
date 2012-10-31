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

defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

class NinjaRssSyndicatorModelButtonMaker extends JModel
{	
	function __construct()
	{
		parent::__construct();		
	}

	function save(){	
		$url = urldecode(JRequest::getVar('imgurl', '', 'post', 'string'));
		$imgName =  urldecode(JRequest::getVar('imgname', '', 'post', 'string'));
		$savePath = JPATH_ROOT . DS .'images';
		if(!$url || !$imgName){
			return 'Image invalid!';			
		}
		if(!file_exists($savePath) || !is_readable($savePath) || !is_writable($savePath)){ 	
			return 'Cannot access images/stories directory!';			
		}
		//save image
		file_put_contents($savePath.DS.$imgName, file_get_contents($url));
		if(file_exists($savePath.DS.$imgName))
			return 'Image saved! link: <a href="'.JURI::root().'images/'.$imgName.'" title="copy this url to use">'.JURI::root().'images/'.$imgName.'</a>';
		else
			return "There's an error while save image.Please try again!";	
	}
}
