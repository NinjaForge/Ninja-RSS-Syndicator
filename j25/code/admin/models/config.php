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

class ninjarsssyndicatorModelConfig extends JModel
{

	var $_data;
	
	function __construct()
	{
		parent::__construct();
		global $mainframe, $option;
	}

	function _buildQuery()
	{
		$query = ' SELECT * FROM #__ninjarsssyndicator '.
					'  WHERE id = 1 '
		;

		return $query;
	}

	function getData()
	{
		// Load the data
		if (empty( $this->_data )) {
			$query = $this->_buildQuery();
			$this->_db->setQuery( $query );
			$this->_data = $this->_db->loadObject();
		}
		if (!$this->_data) {
			$this->_data = '';
		}		
		return $this->_data;
	}
	
	function saveConfig(){
		$id = JRequest::getVar('id', '1', 'post', 'int');
		$msg = JRequest::getVar('msg', 'Get the latest news direct to your desktop', 'post', 'string');
        $msg = $this->_db->Quote($this->_db->getEscaped($msg), false);
		$defaultType = JRequest::getVar('defaultType', '1.0', 'post', 'string');
		$count = JRequest::getVar('count', '10', 'post', 'string');
		$orderby = JRequest::getVar('orderby', 'rdate', 'post', 'string');
		$numWords = JRequest::getVar('numWords', '25', 'post', 'int');
		
		$cache = JRequest::getVar('cache', '3600', 'post', 'int');
		$imgUrl = JRequest::getVar('imgUrl', '', 'post', 'string');
        $imgUrl = $this->_db->Quote($this->_db->getEscaped($imgUrl), false);
		$renderAuthorFormat = JRequest::getVar('renderAuthorFormat', '1', 'post', 'string');
		$renderHTML = JRequest::getVar('renderHTML', '0', 'post', 'int');
		$FPItemsOnly = JRequest::getVar('FPItemsOnly', '1', 'post', 'int');
		$description = JRequest::getVar('description', '', 'post', 'string');
        $description = $this->_db->Quote($this->_db->getEscaped($description), false);
		
		$query = "UPDATE #__ninjarsssyndicator SET msg = $msg,
													defaultType='$defaultType',
													count = '$count',
													orderby = '$orderby',
													numWords = $numWords,
													cache = $cache,
													imgUrl = $imgUrl,
													renderAuthorFormat = '$renderAuthorFormat',
													renderHTML = $renderHTML,
													FPItemsOnly = $FPItemsOnly,
													description = $description
													WHERE id = $id";
		
		
		$this->_db->setQuery($query);
		$this->_data = $this->_db->query();
		
		if($this->_data)
			return true;
		else
			return false;
	}
	

}
