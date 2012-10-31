<?php

/**
* @Copyright Copyright (C) 2010 Ninja Forge
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
**/

defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

class NinjaRssSyndicatorViewNinjaRssSyndicator extends JView
{
	function display($tpl = null)
	{
		$feed		= & $this->get( 'Data');	
		$content	= & $this->get( 'Content');
		$menuItemArray =& $this->get('MenuItemArray');
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
		//Xipat - VH (Feb 09 2009): Remove unuse code
		/*
		$this->assignRef('catsInTitle',$feed->feed_catsInTitle); // default = 1
		*/
		$this->assignRef('content', $content);
		$this->assignRef('menuitemarray',$menuItemArray );
		
		
		
		$doc = JFactory::getDocument();
		$doc->setMimeEncoding('application/rss+xml');
		

		
		
		parent::display($tpl);
	}
}
?>