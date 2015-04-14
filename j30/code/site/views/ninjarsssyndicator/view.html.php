<?php
/*
* @version		2.0
* @package		com_ninjarsssydicator
* @author 		NinjaForge
* @author email	support@ninjaforge.com
* @link			http://ninjaforge.com
* @license		http://www.gnu.org/copyleft/gpl.html GNU GPL
* @copyright	Copyright (C) 2012 NinjaForge - All rights reserved.
*/

// No direct access to this file
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

class NinjaRssSyndicatorViewNinjaRssSyndicator extends JViewLegacy
{
	function display($tpl = null)
	{
		$feed		= $this->get( 'Data');	
		//$feed		= $this->get( 'Items');	
		$content	= $this->get( 'Content');
		$menuItemArray = $this->get('MenuItemArray');

		$this->id = $feed->id;
		$this->title = $feed->feed_name;
		$this->type = $feed->feed_type;
		$this->sectlist = $feed->msg_sectlist;
		$this->excatlist = $feed->msg_excatlist; 
		$this->fulltext = $feed->msg_fulltext;	
		$this->count = $feed->msg_count;
		$this->orderby = $feed->msg_orderby;
		$this->cache = $feed->feed_cache;
		$this->description = $feed->feed_description;
		$this->renderAuthorFormat = $feed->feed_renderAuthorFormat;
		$this->renderHTML = $feed->feed_renderHTML;
		$this->renderImages = $feed->feed_renderImages;
		$this->FPItemsOnly = $feed->msg_FPItemsOnly;
		$this->numWords = $feed->msg_numWords;
		$this->imgUrl = $feed->feed_imgUrl;		
		$this->contentPlugins = $feed->msg_contentPlugins;
		$this->content = $content;
		$this->menuitemarray = $menuItemArray;
		//TODO - add these columns if enough people request them
		//$this->assignRef('ninjaRSSFeedRowPlugins', $feed->msg_ninjaRSSFeedRowPlugins);		
		//$this->assignRef('ninjaRSSFeedPlugins', $feed->feed_ninjaRSSFeedPlugins);
		
		parent::display($tpl);
	}
}
?>
