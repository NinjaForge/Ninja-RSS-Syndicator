<?php
/* Ninja RSS Strip Tags Plugin
* By Daniel Chapman
* http://www.ninjaforge.com 
* Copyright (C) 2008 Daniel Chapman www.ninjaforge.com - Weapons for websites.
* email: support@ninjaforge.com
* date: Dec 2009
* Release: 1.0
* License : http://www.gnu.org/copyleft/gpl.html GNU/GPL 
*
*/
	
// Ensure this file is being included by a parent file. 
defined('_JEXEC') or die( "Direct Access Is Not Allowed" );

jimport('joomla.event.plugin');

class plgContentNinjaRSSStripPlugTags extends JPlugin {

	function plgContentNinjaRSSStripPlugTags( &$subject ) {
			parent::__construct( $subject );
	}

	function onPrepareNinjaRSSFeedRow(&$item) {
		
		$plugin =& JPluginHelper::getPlugin('content', 'ninjarssstripplugtags');
		$params = json_decode( $plugin->params ); 
	
		$one_tag_array = explode("\n",str_replace(' ', '', $params->one_tag_list));
		$two_tag_array = explode("\n",str_replace(' ', '', $params->two_tag_list));
		
		//if we have any entries in our single tag list, clear them out
		if (count($one_tag_array)>1 || $one_tag_array[0] != ''){			 
		for ($i=0 ; $i < count($one_tag_array) ; $i++){
			$patterns[$i] =	'#{'.$one_tag_array[$i].'(.*?)}#s';
			$replacements[$i] = '';		
		}
		$item->description = preg_replace($patterns, $replacements, $item->description); 
		}
		
		//if we have any entries in our paired tag list, clear them out
		if (count($two_tag_array)>1 || $two_tag_array[0] != ''){
		for ($i=0 ; $i < count($two_tag_array) ; $i++){
			$patterns2[$i] =	"#{".$two_tag_array[$i]."(.*?)}(.*?){/".$two_tag_array[$i]."}#s";
			$replacements2[$i] = '';
		}
		$item->description = preg_replace($patterns2, $replacements2, $item->description);		 
		}
			
		//finish the plugin
		return true;
	}
}
?>