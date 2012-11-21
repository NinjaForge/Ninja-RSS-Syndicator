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

defined('_JEXEC') or die('Restricted access'); 
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define("TIME_ZONE","");
include_once(JPATH_COMPONENT.DS.'views'.DS.'ninjarsssyndicator'.DS.'tmpl'.DS.'feedcreator.class.php');

//check if com_finder is installed (J2.5 and above)
$finder_exists = 0;
$myfile = JPATH_BASE.DS.'components'.DS.'com_finder'.DS.'controller.php';
if (file_exists($myfile))
	$finder_exists = 1;
// Register dependent classes.
if ($finder_exists)
	{
	JLoader::register('FinderIndexerHelper', dirname(__FILE__) . '/helper.php');
	JLoader::register('FinderIndexerTaxonomy', dirname(__FILE__) . '/taxonomy.php');
	JLoader::register('FinderHelperRoute', JPATH_SITE . '/components/com_finder/helpers/route.php');
	JLoader::register('FinderHelperLanguage', JPATH_ADMINISTRATOR . '/components/com_finder/helpers/language.php');
	}

// Register dependent classes.
JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');


//global $mainframe;
$mainframe = JFactory::getApplication();

$feedid = $this->id;
$docache = intval($this->cache)>0?1:0;
//add_stats($lists); /*<< MAD 2007/09/28 */ //Oct 24 2008


//if type is Summaries then get numwords from db
$numWords = $this->numWords > 0	? $this->numWords: 10000; // numWord == 0 represents ALL

/*if type is RSS then use admin defined default
if (($this->type=="RSS") || ($this->type=="RSSSUMM"))
{
	//$this->type = "RSS".$row->defaultType;
	$this->type = "RSS2.0";// TO-DO
}
*/

//make a feed id based filename
$filename = JPATH_COMPONENT.DS."feed".DS."feed".$feedid.".xml";
$rss = new UniversalFeedCreator();

//Use cache if docache is set to 1
if (intval($docache)==1) {
	$rss->useCached($this->type,$filename,$this->cache); // use cached version if age<1 hour. May not return!
}
//$rss->title 			= htmlspecialchars($this->title, ENT_QUOTES);
$rss->title 			= $this->title;
$rss->description		= $this->description;
$rss->link 				= JURI::root();

$u = JFactory::getURI();
$rss->syndicationURL 	= $u->toString();
$rss->descriptionHtmlSyndicated = true;

$image 					= new FeedImage();
$image->title 			= $mainframe->getCfg('sitename');
$image->url 			= $this->imgUrl;
$image->link 			= JURI::root();
$image->description		= $mainframe->getCfg('sitename');
$image->descriptionHtmlSyndicated	= true;

if ( $this->imgUrl!="") { $rss->image = $image; }
//Xipat - VH (Feb 09 2009): Remove unuse code
/*
if (intval($this->catsInTitle)) {
	$rss->title .= " (".htmlspecialchars($this->cat).")";
}
*/
$rows = $this->content;

//used to trigger content plugins below
JPluginHelper::importPlugin( 'content' );
$dispatcher = JDispatcher::getInstance();	 

// Include menu itemid's in URLs by forming $itemids lookup array
//$itemids = makeMenuItemArray('content_blog_section');
$itemids = $this->menuitemarray;	
foreach ($rows as $row) {
	$item 		 = new FeedItem();
	$item->title = htmlspecialchars($row->title);
	$itemid		 = $itemids[$row->sectionid];		

	// be sure itemid has some content!
	/*>>> AGE 20071012 */
	if (($itemid == "")&&($finder_exists))
	{ 
		//$itemid = $mainframe->getItemid( $row->id, 0, 0 );					
		// Get the menu item id.
		//$query = array('id' => $row->id);
		$itemid = FinderHelperRoute::getItemid($row->id);
	}
	/*<<< AGE 20071012 */
	if ($itemid == "") {$itemid = 99999999;}
	
	$item->link = JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catslug),false,2);
	$item->guid = $item->link;
	
	//Jroute produces htmlspecialchar modified urls. 
	//We need to decode them because the feedclass also specialchars them, giving us things like &amp;amp;
	//TODO - test special characters
	//$itemurl = htmlspecialchars_decode ($itemurl);
	

	/* >> DAN 2009/12/14 */
	/* fulltext options:
	 * 0 -> Do nothing
	 * 1 -> Read more link
	 * 2 -> Add to intro text
	 * 3 -> Use only full text
	 */
	$AddReadMoreLink = false;	 
	
	/*		 Testing Case statement below. If it works, remove this code- D
	$words = $row->itext;
	if ($this->fulltext == 2) {
		$words .= $row->mtext;
	} */
	
	switch ($this->fulltext) {
		case 0:
			$words = ($row->introtext) ? $row->introtext : ((str_word_count(trim($row->fulltext)) > $numWords) ? word_limiter($row->fulltext, $numWords) : $row->fulltext);
		case 1:
			$words = ($row->introtext) ? $row->introtext : ((str_word_count(trim($row->fulltext)) > $numWords) ? word_limiter($row->fulltext, $numWords) : $row->fulltext);
			break;
		case 2:
			$words = $row->introtext.$row->fulltext;
			break;
		case 3:
			$words = ($row->fulltext) ? $row->fulltext : $row->introtext;
			break;
	}							
	 
	// Check if $words is larger then the $numWords
	// Add some extra words because characters are count as words (20% extra)
	
	if (str_word_count(trim($words)) > $numWords) 
	{			
		$AddReadMoreLink = true;	 				
		$words = word_limiter($words, $numWords);			 
	}
			
	if($this->fulltext == 0)
	{
		$AddReadMoreLink = false;
	}
	
	if ($this->fulltext == 1 or $AddReadMoreLink) {
		if (strlen(trim($row->mtext)) > 0 or $AddReadMoreLink)
			$words .= "\n<p><a href=\"" . $item->link . "\">" . JText::_('COM_NINJARSSSYNDICATOR_READ_MORE') . "</a></p>";
	}
			
	if (!intval($this->renderHTML)) {
		//Remove HTML tags if told not to render them
		$words = noHTML ($words); 
		
	} else {		 						
		//Remove images if told not to render them	
		//Images will also get remove with HTML tags above			
		if (!intval($this->renderImages)) {
			$words = delImagesFromHTML($words);
		} 
	}

	/* Convert relative urls to absolute */
	$words = addAbsoluteURL($words);
	
	$item->description 	= $words;
	$item->descriptionHtmlSyndicated	= true;		

	//Many, many failed attempts to get the date right.
	//Kept here for a while in case issues arise again - Dec 2009
	//After some issues with the date not coming out correctly I am trying the exact code from Com_content
	//$itemDate = JFactory::getDate(JHTML::_('date', $row->dsdate, JText::_('DATE_FORMAT_LC2')));		
	//$itemDate = JFactory::getDate(JHTML::_('date', $row->dsdate), 0);
	//$itemDate = JFactory::getDate($row->dsdate, 0);		
	//$item->date 				= $itemDate->toRFC822() ;
	//$item->date = strftime("%a, %d %b %Y %H:%M:%S",strtotime($row->dsdate))." -0700";
	//$item->date = date($row->dsdate, 'D, d M Y g:i:s')." GMT\n";
	
	$item->date = date("r",strtotime($row->dsdate));		
	$item->updated = date("r",strtotime($row->updated));		
	$item->source 				= JURI::root();		
	
	if ($this->renderAuthorFormat){
		$author = trim($row->authorAlias);
		
		if (empty($author)) $author = $row->author;
		
		$item->author 	= $author;
		$item->authorEmail	= $row->authorEmail;
	}
	//If needed, trigger content plugins on the row content.										 		
	//TODO - expand this to allow for individual paramters for the plugin instances
	$dispatcher->trigger( 'onPrepareNinjaRSSFeedRow', array( &$item ) );				
	
	$rss->addItem($item);		
}

//If needed, trigger content plugins on the feed as a whole.
//TODO - expand this to allow for individual paramters for the plugin instances
$dispatcher->trigger( 'onPrepareNinjaRSSFeed', array( &$rss ) ); 			
ob_end_clean();
ob_start();		
//If we are using the cache and the time out is greater than 0, then generate and use a file.
//Otherwise generate the feed on the fly
if (intval($docache)==1 && $this->cache > 0) 
{
	$rss->saveFeed($this->type,$filename,true);
} else {
	$rss->outputFeed($this->type);
}										

function noHTML($words) {
	$words = preg_replace("'<script[^>]*>.*?</script>'si","",$words);
	$words = preg_replace('/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is','\2 (\1)', $words);
	$words = preg_replace('/<!--.+?-->/','',$words);
	//$words = preg_replace('/{.+?}/','',$words);
	$words = strip_tags($words);
	$words = preg_replace('/&nbsp;/',' ',$words);
	//$words = preg_replace('/&amp;/','&',$words);
	//$words = preg_replace('/&quot;/','"',$words);

	return $words;
}

function addAbsoluteURL($html) {
	$root_url = JURI::root();
	$html = preg_replace('@href="(?!http://)(?!https://)(?!mailto:)([^"]+)"@i', "href=\"{$root_url}\${1}\"", $html);
	$html = preg_replace('@src="(?!http://)(?!https://)([^"]+)"@i', "src=\"{$root_url}\${1}\"", $html);

	return $html;
}

/*
** Delete all the images from the url
*/
function delImagesFromHTML($html, $instances = -1) {
	$html = preg_replace('/<img\\s.*>/i','', $html, $instances);

	return $html;
}

/* >> MAD 2007/10/09
 * Added function word_limiter
 */
function word_limiter($string, $limit = 100) {
	$words = array();
	$string = eregi_replace(" +", " ", $string);
	$array = explode(" ", $string);
	//$limit = (count($array) <= $numwords) ? count($array) : $numwords;
	for($k=0;$k < $limit;$k++)
	{
		if(($limit>0 && $limit == $k)||!isset($array[$k]))
			break;
		if (eregi("[0-9A-Za-zÀ-ÖØ-öø-ÿ]", $array[$k]))
			$words[$k] = $array[$k];
	}
	$txt = implode(" ", $words);
	return $txt;
}

function first_img_src($html) {
	if (stripos($html, '<img') !== false) {
			$imgsrc_regex = '#<\s*img [^\>]*src\s*=\s*(["\'])(.*?)\1#im';
			preg_match($imgsrc_regex, $html, $matches);
			unset($imgsrc_regex);
			unset($html);
			if (is_array($matches) && !empty($matches)) {
					return $matches[2];
			} else {
					return false;
			}
	} else {
			return false;
	}
}
