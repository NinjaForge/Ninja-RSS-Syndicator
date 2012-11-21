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

defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

class NinjaRssSyndicatorModelninjarsssyndicator extends JModel
{

	var $_data = null;
	var $_id = null;	
	var $_content = null;
	
	function __construct()
	{
		parent::__construct();

		global $option;
		
		$id = JRequest::getInt('feed_id',  0, '', 'int');
		$this->setId((int)$id);
	}
	
	function setId($id)
	{
		// Set id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}
	

	function _buildQuery()
	{
		$query = "SELECT * FROM `#__ninjarsssyndicator_feeds` WHERE id = $this->_id";
		return $query;
	}

	function getData()
	{
		$db = JFactory::getDBO();
		// Load the data
		if (empty( $this->_data )) {
			$query = $this->_buildQuery();
			$db->setQuery( $query );
			$this->_data = $db->loadObject();			
		}
		if (!$this->_data || $this->_data->published == 0) {
			$this->_data = array();	
		}
		return $this->_data;
	}
	
	function getContent()
	{
		
		if (null === ($feed = $this->getData())) {
		    JError::raiseWarning( 'SOME_ERROR_CODE', JText::_( 'Error Loading Modules' ) . $db->getErrorMsg());
		    return false;
		}
		
		$seclist = $feed->msg_sectlist; 
		$FPItemsOnly = $feed->msg_FPItemsOnly; 
		$inclExclCatList = $feed->msg_includeCats; 
		$excatlist = $feed->msg_excatlist;
		$exitems = str_replace(" ", "", $feed->msg_exitems);
		
		//$includetags =  "'" . str_replace(",", "','", str_replace(" ", "", $feed->msg_includetags)) . "'";
		$includetags =  str_replace(",", "','", str_replace(" ", "", $feed->msg_includetags)); //sp
		
		/*
		$includetags = str_replace(" ", "", $feed->msg_includetags);
		*/
		
		$count = $feed->msg_count;

		$db = JFactory::getDBO();
		
		
		//If Joomla tags is isntalled, and tags have been set then use tags
		$useTags = false;
		
		if (file_exists(JPATH_SITE.'/components/com_tag/tag.php') && (trim($includetags) != "")){		
			$useTags = true;
		}
			
		
        $date = JFactory::getDate();           
		//$now = date( "Y-m-d H:i:s",time()+$mainframe->getCfg('offset')*60*60 );
        $now = $date->toMySQL();         
			
		switch (strtolower( $feed->msg_orderby )) {
			case 'date':
				$orderby = "a.created";
				break;
			case 'rdate':
				$orderby = "a.created DESC";
				break;
			case 'mdate':
				$orderby = "GREATEST(a.created, a.modified)";
				break;
			case 'mrdate':
				$orderby = "GREATEST(a.created, a.modified) DESC";
				break;
			case 'catsect':
				$orderby = intval($FPItemsOnly)==1 ? "f.ordering, a.ordering ASC, a.catid, a.sectionid" : "a.ordering ASC, a.catid, a.sectionid";
				break;
			case 'artord':
				$orderby = "a.ordering";
				break;
			default:
				$orderby = "a.created";
				break;
		}  
		
		/* SELECT construction */
		$queryUncat = "";//Oct 25 2008: include uncategories
		$where = "";//define variable $where
		/*building 2 queries, in case Component Joomla Tag not installed - query1 : Joomla Tag NOT installed - query2 : Joomla Tag installed */
		//Oct 24 2008: include slug and catslug for work with JRoute
		$query =  'SELECT DISTINCT u.id as userid, IFNULL(c.id,a.catid) as catid, a.sectionid as secid, a.id as id, a.*, a.introtext as itext, a.fulltext as mtext, u.name AS author, u.usertype, u.email as authorEmail, a.created_by_alias as authorAlias, a.created AS dsdate, a.modified as updated, c.title as catName, CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug, CASE WHEN CHAR_LENGTH(c.alias) THEN CONCAT_WS(":", c.id, c.alias) ELSE c.id END as catslug';
		
		/* FROM */
		$query	.=  "\n FROM #__content AS a"		
				. 	"\n LEFT JOIN #__users AS u ON u.id = a.created_by"
                .  	"\n LEFT JOIN `#__categories` AS c on c.id = a.catid ";
                //.  	"\n LEFT JOIN `#__sections` AS s on s.id = c.section ";
		
		if ($useTags) {
			$query	.= "\nLEFT JOIN `#__tag_term_content` AS tc on tc.cid = a.id " /* Joomla Tags Addition */
					.  "\nLEFT JOIN `#__tag_term` AS t on t.id = tc.tid "; /* Joomla Tags Addition */
		}
		
		
		/* WHERE construction  */
		$where	.= "\n WHERE a.state='1'";
		/* JOIN construction */
		if (intval($FPItemsOnly)==1) {
			// frontpage Items only
			$where  .= "\n AND a.id IN (SELECT content_id FROM #__content_frontpage)";
		} elseif (intval($FPItemsOnly)==2) {
            // all articles except frontpage ones 
            $where  .= "\n AND a.id NOT IN (SELECT content_id FROM #__content_frontpage)";
        }
		if ($exitems != "") {
			$where	.= "\n AND a.id NOT IN (" . $exitems . ")";
		}

/*
		if ($seclist!=="") {
			if($seclist == "0")// Xipat - VH: Query uncategorised
			{
			   	$where	.= "\n AND a.sectionid = 0";
				$queryUncat= " OR a.sectionid = 0 ";
			}
			else {
				//$where	.= "\n AND IFNULL(s.id,0) IN (" . $seclist . ")";
			}
		}	
		else {
			$queryUncat= " OR a.sectionid = 0 ";
		}
*/

		if ($excatlist!=="") {
		
			if ($inclExclCatList){
				$where	.= "\n AND IFNULL(c.id,0) IN (" . $excatlist . ")";
			} else {
				$where	.= "\n AND IFNULL(c.id,0) NOT IN (" . $excatlist . ")";
			}
		}
		
	    $nullDate    = $db->getNullDate();
		$where	.=	"\n AND (a.access = 1 OR a.access = 5) "	// item only public access check
				.	"\n AND (c.access = 1 OR c.access = 5) "	// category only public access check
				.	"\n AND (a.publish_up = ".$db->Quote($nullDate)." OR a.publish_up <= ".$db->Quote($now).")"
				.	"\n AND (a.publish_down = ".$db->Quote($nullDate)." OR a.publish_down >= ".$db->Quote($now).")"
			;

        $query .= $where;
        
		/* JRO Apr 16 2020:  Add filter for Jooml Tags Tags  */
	    if ($useTags) {
			$query	.= "\n AND t.name  IN ('" . $includetags . "')"; //sp
		}
		/*  End filter for Joomla Tags Tags */


		/* ORDER BY, LIMIT ...  construction */
		$query	.= "\nORDER BY $orderby".  ($count ? (" LIMIT " . $count) : "");
		
       //echo $query;
        //we first try with Joomla Tag
		if (empty( $this->_content )) {	
			$db->setQuery( $query );
			
			$this->_content = $db->loadObjectList();
		}

		return $this->_content;
		
	}
	
	function getMenuItemArray(){
		$type = 'content_blog_section';
		$database = JFactory::getDBO();;
		$itemids = NULL;
	
		$query = "SELECT id, component_id FROM #__menu WHERE type = '$type' AND published = 1";
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		foreach ($rows as $row) {
			$itemids[$row->componentid] = $row->id;
		}
		return $itemids;
	}
	
	
}
?>
