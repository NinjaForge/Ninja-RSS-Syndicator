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

defined( '_JEXEC' ) or die( 'Restricted access' );

function com_install()
{
	
	$database = JFactory::getDBO();
	
	$database->setQuery("DROP TABLE IF EXISTS `#__ninjarsssyndicator`;");
	$database->query();
	
	$database->setQuery("CREATE TABLE IF NOT EXISTS `#__ninjarsssyndicator` 
	(
		`id` tinyint(4) NOT NULL auto_increment, 
		`msg` varchar(100) default NULL,			  		
		`defaultType` varchar(4) default NULL, 
		`count` varchar(4) default NULL, 
		`orderby` varchar(10) default NULL,
		`numWords` tinyint(4) unsigned default NULL, 
		`cache` smallint(9) default NULL, 
		`imgUrl` varchar(100) default NULL,
		`renderAuthorFormat` varchar(10) default 'NAME', 
		`renderHTML` tinyint(1) default '1', 
		`FPItemsOnly` tinyint(1) default '0',
		`description` text default NULL, PRIMARY KEY  (`id`) 
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
	$database->query();

	/*$database->setQuery("INSERT IGNORE INTO `#__ninjarsssyndicator` (`id`, `msg`, `defaultType`, `count`, `orderby`, `numWords`, `cache`, `imgUrl`, `renderHTML`, `FPItemsOnly`) VALUES (1,'Get the latest news direct to your desktop','2.0','10','rdate',0,0,'',1, 0);");
	$database->query();*/
		
	$database->setQuery("DROP TABLE IF EXISTS `#__ninjarsssyndicator_feeds`;");
	$database->query();
	
	$database->setQuery("CREATE TABLE IF NOT EXISTS `#__ninjarsssyndicator_feeds` 
	(
		`id` tinyint(4) NOT NULL auto_increment, 
		`feed_name` varchar(150) default NULL,
		`feed_description` text default NULL, `feed_type` varchar(10) default NULL, 
		`feed_cache` smallint(9) default NULL,
		`feed_imgUrl` varchar(100) default NULL, 
		`feed_button` varchar(100) default NULL, 
		`feed_renderAuthorFormat` varchar(10) default '0',
		`feed_renderHTML` tinyint(1) default '0',
		`feed_renderImages` INT(1) NOT NULL, 
		`msg_count` varchar(4) default NULL, 
		`msg_orderby` varchar(10) default NULL,
		`msg_numWords` tinyint(4) unsigned default NULL, 
		`msg_FPItemsOnly` tinyint(1) default '1', 
		`msg_sectlist` varchar(50) default NULL, 
		`msg_excatlist` varchar(100) default NULL, 	
		`msg_includeCats` tinyint(1) default NULL, 
		`msg_fulltext` tinyint(1) default NULL, 
		`msg_exitems` varchar(250) default NULL, 
		`msg_includetags` varchar(250) default NULL, 
		`msg_contentPlugins` tinyint(1) default NULL, 
		`published` tinyint(1) default NULL, PRIMARY KEY  (`id`) 
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
	$database->query();

	/*$database->setQuery("SHOW FULL COLUMNS FROM #__ninjarsssyndicator_feeds where field = 'feed_catsInTitle'");	
	$results = $database->loadObjectList();
	if (count($results))
	{
		$database->setQuery("
						ALTER TABLE `#__ninjarsssyndicator_feeds`
						DROP COLUMN `feed_catsInTitle`;");
		$database->query();
	}*///if (count($results)) 
	
	/*$database->setQuery("SHOW FULL COLUMNS FROM #__ninjarsssyndicator_feeds where field = 'msg_sectcat'");	
	$results = $database->loadObjectList();
	if (count($results))
	{
		$database->setQuery("
						ALTER TABLE `#__ninjarsssyndicator_feeds`
						CHANGE COLUMN `msg_sectcat` `msg_exitems` varchar(250) default NULL;");
		$database->query();
	}*///if (count($results)) 
    
	//Do updates of table structure if we need to
	//This is mainly for people doing an upgrade
	/*$database->setQuery("SHOW FULL COLUMNS FROM #__ninjarsssyndicator_feeds where field = 'msg_contentPlugins'");	
	$results = $database->loadObjectList();
	if (!count($results))
	{
		$database->setQuery("
						ALTER TABLE `#__ninjarsssyndicator_feeds`
						ADD COLUMN `msg_contentPlugins` tinyint(1) default NULL;");
		$database->query();
	}*///if (!count($results))  


	/*$database->setQuery("SHOW FULL COLUMNS FROM #__ninjarsssyndicator_feeds where field = 'msg_includeCats'");	
	$results = $database->loadObjectList();
	if (!count($results))
	{
		$database->setQuery("
						ALTER TABLE `#__ninjarsssyndicator_feeds`
						ADD COLUMN `msg_includeCats` tinyint(1) default NULL;");
		$database->query();
	}*///if (!count($results))   
	
	
	
	/*$database->setQuery("SHOW FULL COLUMNS FROM #__ninjarsssyndicator_feeds where field = 'msg_includetags'");	
	$results = $database->loadObjectList();
	if (!count($results))
	{
		$database->setQuery("
						ALTER TABLE `#__ninjarsssyndicator_feeds`
						ADD COLUMN `msg_includetags` varchar(250) default NULL;");
		$database->query();
	}*///if (!count($results))  

?>
<img src="<?php echo JURI::root(); ?>administrator/components/com_ninjarsssyndicator/assets/images/ninja-rss.jpg" alt="Ninja RSS Syndicator" /><br />
<p>Ninja RSS Syndicator has been succesfully installed.</p>

<?php } 
