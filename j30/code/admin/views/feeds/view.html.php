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

class NinjaRssSyndicatorViewFeeds extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;

	public function display($tpl = null)
	{
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');
		
		$this->assignRef('items',		$this->items);
		$this->assignRef('pagination',	$this->pagination);
		
		$this->addToolbar();
		parent::display($tpl);
	}
	
	protected function addToolbar()
	{
		$text = 'Feed manager';
		JToolBarHelper::title(   JText::_( 'Ninja RSS Syndicator').': <small><small>[ ' . $text.' ]</small></small>', 'article-add.png' );
		JToolBarHelper::addNew('feed.add', 'JTOOLBAR_NEW');
		JToolBarHelper::publish('feed.publish', 'JTOOLBAR_PUBLISH', true);
		JToolBarHelper::unpublish('feed.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		JToolBarHelper::deleteList('', 'feed.remove', 'JTOOLBAR_DELETE');
		JToolBarHelper::editList('feed.edit', 'JTOOLBAR_EDIT');
			
	}
}
?>