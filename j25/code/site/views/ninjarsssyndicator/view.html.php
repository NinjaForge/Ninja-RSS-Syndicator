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

defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

class NinjaRssSyndicatorViewNinjaRssSyndicator extends JView
{
	function display($tpl = null)
	{
		$feed		= $this->get( 'Data');	
		//$feed		= $this->get( 'Items');	
		$content	= $this->get( 'Content');
		$menuItemArray = $this->get('MenuItemArray');
		$this->assignRef('id', $feed->id);
		$this->assignRef('title', $feed->feed_name);
		$this->assignRef('type', $feed->feed_type);
		$this->assignRef('sectlist', $feed->msg_sectlist);
		$this->assignRef('excatlist', $feed->msg_excatlist); 
		$this->assignRef('fulltext', $feed->msg_fulltext);  
		$this->assignRef('cat', $feed->msg_sectcat);
		$this->assignRef('count', $feed->msg_count);
		$this->assignRef('orderby', $feed->msg_orderby);
		$this->assignRef('cache', $feed->feed_cache);
		$this->assignRef('description', $feed->feed_description);
		$this->assignRef('renderAuthorFormat', $feed->feed_renderAuthorFormat);
		$this->assignRef('renderHTML', $feed->feed_renderHTML);
		$this->assignRef('renderImages', $feed->feed_renderImages);
		$this->assignRef('FPItemsOnly', $feed->msg_FPItemsOnly);
		$this->assignRef('numWords', $feed->msg_numWords);
		$this->assignRef('imgUrl', $feed->feed_imgUrl);		
		$this->assignRef('contentPlugins', $feed->msg_contentPlugins);
		
    //TODO - add these columns if enough people request them
    //$this->assignRef('ninjaRSSFeedRowPlugins', $feed->msg_ninjaRSSFeedRowPlugins);		
	//$this->assignRef('ninjaRSSFeedPlugins', $feed->feed_ninjaRSSFeedPlugins);
		
		$this->assignRef('content', $content);
		$this->assignRef('menuitemarray',$menuItemArray );
		parent::display($tpl);
	}
}
?>