<?php
/*
* @version		$id $
* @package		mod_ninja_rss_syndicator
* @author 		NinjaForge
* @author email	support@ninjaforge.com
* @link			http://ninjaforge.com
* @license      http://www.gnu.org/copyleft/gpl.html GNU GPL
* @copyright	Copyright (C) 2012 NinjaForge - All rights reserved.
*/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
class modNinjaRssSyndicatorHelper
{	
	function getNinjaRssSyndicatorFeeds($params)
	{
        //connect to database
        $db = &JFactory::getDBO();
        //load module parameters & set defaults
		$only_feeds 		= $params->get('feedid','');
		$link_to_feed_icon 	= (int) $params->get('link_to_feed_icon','1');
		$link_target 		= $params->get('link_target','_self');
		$rows 				= null;
		$sql_feeds 			= "";
		//limit feeds by id
        $sql_feeds 			= '';
        $sql_testimonial 	= '';
		if ($only_feeds)
		{ 
			if( is_array( $only_feeds ) ) {
				$sql_feeds 	= ' AND (id IN ( ' . implode( ',', $only_feeds ) . ') )';
			} else {
				$sql_feeds 	= ' AND (id = '.$only_feeds.')';
			}	
		}
		$query = "SELECT * FROM #__ninjarsssyndicator_feeds WHERE published = 1" . $sql_feeds . " ORDER BY feed_name";
		$db->setQuery($query);
        $rows = $db->loadObjectList();
        if (!count($rows)) { return; }
        $items = array();
        foreach ($rows as $row)
        {
            $item = '';
			//set feed name
			$item->feed_name = $row->feed_name;
			//set feed link
			$item->feed_link = JRoute::_('index.php?option=com_ninjarsssyndicator&amp;feed_id='.$row->id.'&amp;format=raw');
			//set button image
			$item->feed_button = ($row->feed_button) ? $row->feed_button : "default.gif";;
			//Check if there is a picture present
			if (file_exists(JPATH_BASE.DS."components".DS."com_ninjarsssyndicator".DS."assets".DS."images".DS."buttons".DS.$item->feed_button)) 
			{			
				//the picture exist so display it
				$item->feed_img_link =  '<a href="'.$item->feed_link.'" title="'.$item->feed_name.'" target="'.$link_target.'"><img src="'.JURI::base() . 'components/com_ninjarsssyndicator/assets/images/buttons/'.$item->feed_button.'" alt="'.$item->feed_name.'" /></a>';			
			} else 
			{
				//if the picture doesn't exist show the name of the feed
				$item->feed_img_link =  '<a href="'.$item->feed_link.'" title="'.$item->feed_name.'" target="'.$link_target.'">'.$item->feed_name.'</a>';
			}
			//add head link
			$item->feedFormat = "application/xml";
			switch($row->feed_type)
			{
				case "0.91":
				case "1.0": 
				case "2.0":
					$item->feedFormat = "application/rss+xml";
					break;		
				case "ATOM":
					$item->feedFormat = "application/atom+xml";
					break;
				case "MBOX":
					$item->feedFormat = "text/plain";
					break;		
			}
			$items[] = $item;
        }
        return $items;
	}
}
