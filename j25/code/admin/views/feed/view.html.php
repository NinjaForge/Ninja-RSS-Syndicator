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

jimport( 'joomla.application.component.view' );

class NinjaRssSyndicatorViewFeed extends JView
{
	function display($tpl = null)
	{
		$feed = $this->get('SData');
		//$sections = $this->get('Sections');
		
		$isNew = ($feed->id<1);
		$text = $isNew ? 'New feed':'Change feed: '. $feed->feed_name;
		
		JToolBarHelper::title(   JText::_( 'Ninja RSS Syndicator').': <small><small>[ ' . $text.' ]</small></small>', 'article-add.png' );
		JToolBarHelper::apply('feed.apply');
		JToolBarHelper::save('feed.save');
		
		$lists = array();
		
		if ($isNew)  {
			JToolBarHelper::cancel();
			$default = $this->get('DefaultData');			
		} else {
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'close' );
		}
		
		
		//rss type list
		
		$rssType[] = JHTML::_('select.option', '2.0','RSS 2.0');
		$rssType[] = JHTML::_('select.option', '1.0','RSS 1.0');  		
		$rssType[] = JHTML::_('select.option', '0.91','RSS 0.91');
		$rssType[] = JHTML::_('select.option', 'ATOM','ATOM');
		$rssType[] = JHTML::_('select.option', 'OPML','OPML');
		$rssType[] = JHTML::_('select.option', 'MBOX','MBOX');
		//$rssType[] = JHTML::_('select.option', 'HTML','HTML'); //COMMENTED OUT BY JOHN BARTELS IN COSULTATION WITH DANIEL & MARK DUE TO UNSUPPORTED FORMATTING
		//$rssType[] = JHTML::_('select.option', 'JS','JS');
		$lists['rssTypeList'] = JHTML::_('select.genericlist', $rssType, 'feed_type', 'class="inputbox"', 'value', 'text', $isNew ? $default->defaultType : $feed->feed_type, 'feed_type');

		$fulltext[] = JHTML::_('select.option', "0","Intro text only");
		$fulltext[] = JHTML::_('select.option', "1","Intro text + Read more link");
		$fulltext[] = JHTML::_('select.option', "2","Intro text + Full text");		
		$fulltext[] = JHTML::_('select.option', "3","Full text only");
		$lists['fulltextlist'] = JHTML::_('select.genericlist', $fulltext, 'msg_fulltext', 'class="inputbox"', 'value', 'text',  $isNew ? '1': $feed->msg_fulltext );
		
		$orderings[] = JHTML::_('select.option', 'date','Created Date Ascending');
		$orderings[] = JHTML::_('select.option', 'rdate','Created Date Descending');
		$orderings[] = JHTML::_('select.option', 'mdate','Modified Date Ascending');
		$orderings[] = JHTML::_('select.option', 'mrdate','Modified Date Descending');
		$orderings[] = JHTML::_('select.option', 'catsect','Joomla Section, Category ordering');
		$orderings[] = JHTML::_('select.option', 'artord','Joomla Article ordering');
		$lists['orderingList'] = JHTML::_('select.genericlist', $orderings, 'msg_orderby', 'class="inputbox"', 'value', 'text', $isNew ? $default->orderby : $feed->msg_orderby, 'msg_orderby');
		
		$numWords[] = JHTML::_('select.option','0','All');
		for ($i=25;$i<=250;$i+=25) {
			$numWords[] = JHTML::_('select.option',$i,$i);
		}
		$lists['numWordsList'] = JHTML::_('select.genericList', $numWords, 'msg_numWords', 'class="inputbox"','value', 'text', $isNew ? $default->numWords : $feed->msg_numWords, 'msg_numWords' );
		
		$FPItemsOnly[] = JHTML::_( 'select.option', '0','All items');
    $FPItemsOnly[] = JHTML::_( 'select.option', '1','Front page items only');
		$FPItemsOnly[] = JHTML::_( 'select.option', '2','Non-frontpage items only');
		$lists['FPItemsOnlyList'] =JHTML::_( 'select.genericList',$FPItemsOnly, 'msg_FPItemsOnly', 'class="inputbox"','value', 'text',$isNew ? $default->FPItemsOnly : $feed->msg_FPItemsOnly, 'msg_FPItemsOnly' );
		
		$yesNoList[]   = JHTML::_( 'select.option', "1","Yes");
		$yesNoList[]   = JHTML::_( 'select.option', "0","No");
		$lists['renderImagesList'] = JHTML::_( 'select.genericList', $yesNoList, 'feed_renderImages', 'class="inputbox"','value', 'text',$isNew ? '1' : $feed->feed_renderImages );
	  $lists['renderPublishedList'] = JHTML::_( 'select.genericList', $yesNoList, 'published', 'class="inputbox"','value', 'text',$isNew ? NULL : $feed->published);
		$lists['renderHTMLList'] =JHTML::_( 'select.genericList',$yesNoList, 'feed_renderHTML', 'class="inputbox"','value', 'text', $isNew ? $default->renderHTML : $feed->feed_renderHTML , 'feed_renderHTML');
		$lists['renderAuthorList'] = JHTML::_('select.genericList', $yesNoList, 'feed_renderAuthorFormat', 'class="inputbox"','value', 'text', $isNew ? $default->renderAuthorFormat : $feed->feed_renderAuthorFormat, 'feed_renderAuthorFormat' );
		
		
		$includeCats[] = JHTML::_( 'select.option', "0","Exclude Selected Categories");
		$includeCats[] = JHTML::_( 'select.option', "1","Include Selected Categories");
		$lists['includeCats'] = JHTML::_( 'select.genericList', $includeCats, 'msg_includeCats', 'class="inputbox"','value', 'text',$isNew ? NULL : $feed->msg_includeCats);
		
		
		
		//Section list
		/*$sectOptions[] = JHTML::_('select.option', "","All sections");
		$sectOptions[] = JHTML::_('select.option', "0","Uncategorised");		
		foreach($sections as $section)
		{
			$sectOptions[] = JHTML::_('select.option', $section->id,$section->title);			
		}
		
		if($isNew)
			$sectSelected = '';
		else
			$sectSelected = explode(',',$feed->msg_sectlist);
		
		$lists['sectionlist'] = JHTML::_( 'select.genericList',$sectOptions, 'msg_sectlist' . '[]', ' class="inputbox"  multiple="true"', 'value', 'text', $sectSelected );*/
		
		
		
		//Excluded categories		
		$db = JFactory::getDbo();		
		$query = "SELECT * FROM #__categories WHERE published=1 and extension='com_content' ";
		$db->setQuery($query);
		$rowlist = $db->loadObjectList();
		foreach($rowlist as $row)
		{
			$menu_array[$row->id] = array('name' => $row->title,'parent' => $row->parent_id,'level' => $row->level );
		}		
		
		if($isNew)
			$exCatSelected = '';
		else
			$exCatSelected = explode(',',$feed->msg_excatlist);			
		
		$model = $this->getModel('feed');		
		$model->getExCategories(1,$menu_array);
		$session = JFactory::getSession();
		$exCatOptions = $session->get('_exCategories');				
		$lists['excludedcatlist'] = JHTML::_( 'select.genericList', $exCatOptions, 'msg_excatlist' . '[]', 'class="inputbox"  multiple="true"', 'value', 'text', $exCatSelected );
		
		
		
		
		//Feedbutton images uit de directory laden
		$button_path = JPATH_ROOT .DS. "components".DS."com_ninjarsssyndicator".DS."assets".DS."images".DS."buttons";
		$dir = @opendir($button_path);
		$button_images = array();
		$button_col_count = 0;

		while( $file = @readdir($dir) )
		{
			if( $file != '.' && $file != '..' && is_file($button_path . '/' . $file) && !is_link($button_path . '/' . $file) )
			{
				if( preg_match('/(\.gif$|\.png$|\.jpg|\.jpeg)$/is', $file) )
				{
				   $button_images[$button_col_count] = $file;
				   $button_name[$button_col_count] = ucfirst(str_replace("_", " ", preg_replace('/^(.*)\..*$/', '\1', $file)));
				   $buttons[] = JHTML::_( 'select.option', $button_images[$button_col_count], $button_name[$button_col_count]);
				   $button_col_count++;				
				}
			}
		}
		@closedir($dir);
		$lists['feedButtons'] = JHTML::_( 'select.genericList', $buttons, 'feed_button', 'onchange="loadButton(this)" class="inputbox" ','value', 'text',$isNew ? 'rss20.gif' : $feed->feed_button);
		
		//Editor
		$editor  = JFactory::getEditor();	
		
		$this->assignRef('id', $feed->id);
		$this->assignRef('name', $feed->feed_name);
		$this->assignRef('count', $feed->msg_count = $isNew? $default->count:$feed->msg_count);
		$this->assignRef('cache', $feed->feed_cache = $isNew? $default->cache:$feed->feed_cache);
		$this->assignRef('imgUrl', $feed->feed_imgUrl);
		$isNew? $feed->feed_button='rss20.gif':$feed->feed_button;
		$this->assignRef('BtnImgUrl', $feed->feed_button);
		$this->assignRef('exitems', $feed->msg_exitems);
		$this->assignRef('includetags', $feed->msg_includetags);
		$this->assignRef('description', $feed->feed_description = $isNew ? $default->description : $feed->feed_description);
		$this->assignRef('editor', $editor);
		$this->assignRef('lists', $lists);
		parent::display($tpl);
	}
}
?>