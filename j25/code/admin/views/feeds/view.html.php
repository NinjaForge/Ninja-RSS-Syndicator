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

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');;

class NinjaRssSyndicatorViewFeeds extends JView
{
	function display($tpl = null)
	{
		$text = 'Feed manager';
		JToolBarHelper::title(   JText::_( 'Ninja RSS Syndicator').': <small><small>[ ' . $text.' ]</small></small>', 'article-add.png' );
		
		JToolBarHelper::publish('feed.publish', 'JTOOLBAR_PUBLISH', true);
		JToolBarHelper::unpublish('feed.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		JToolBarHelper::deleteList('', 'feed.remove', 'JTOOLBAR_DELETE');
		JToolBarHelper::editList('feed.edit', 'JTOOLBAR_EDIT');
		JToolBarHelper::addNew('feed.add', 'JTOOLBAR_NEW');
		
		//$items		= $this->get( 'Data');
		//$total		= $this->get( 'Total');
		//$pagination 	= $this->get( 'Pagination' );
		
		$items 			= $this->get('Items');
		$pagination 	= $this->get('Pagination');
		$state 			= $this->get('State');
		
		$this->assignRef('items',		$items);
		$this->assignRef('pagination',	$pagination);
		
		parent::display($tpl);
	}
}
?>