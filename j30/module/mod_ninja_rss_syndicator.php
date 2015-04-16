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
/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
// Include the syndicate functions only once

require_once (dirname(FILE).'/helper.php');
$cssClass 	= $params->get('moduleclass_sfx');
$message 	= $params->get('msg','');
$align 		= $params->get('align','left');
$link_to_feed_icon		= (int) $params->get('link_to_feed_icon','1');
$link_target 			= $params->get('link_target','_self');
$show_feed_name_text 	= (int) $params->get('show_feed_name_text','1');
$items 					= (new modNinjaRssSyndicatorHelper)->getNinjaRssSyndicatorFeeds($params);

require(JModuleHelper::getLayoutPath('mod_ninja_rss_syndicator', 'default' ));
?>
