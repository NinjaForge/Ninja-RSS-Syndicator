<?php 
/*
* @version		$id $
* @package		mod_ninja_rss_syndicator
* @author 		NinjaForge
* @author email	support@ninjaforge.com
* @link			http://ninjaforge.com
* @license      http://www.gnu.org/copyleft/gpl.html GNU GPL
* @copyright	Copyright (C) 2010 NinjaForge - All rights reserved.
*/
// no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
$doc =& JFactory::getDocument(); 
?>
<?php if (file_exists(JPATH_SITE.'/components/com_ninjarsssyndicator/ninjarsssyndicator.php')){?>
<?php if(count($items)){?>
<div style="text-align:<?php echo $align; ?>" class="ninjarss-<?php echo $cssClass;?>">
    <?php if($message){?>
        <p style="text-align:<?php echo $align; ?>">
            <?php echo $message; ?>
        </p>
    <?php }?>
    <div style="text-align:<?php echo $align; ?>;float:left;padding-right:10px;">
		<?php foreach ($items as $item) :?>
			<?php echo $item->feed_img_link; ?>
			<?php if($show_feed_name_text):?>
            	<?php echo ' '.$item->feed_name; ?>
            <?php endif?>
			<?php //we create the head link if it does not exist
			if($link_to_feed_icon){
				$feedLinkExist = false;
				foreach($doc->_links as $link)
				{
					preg_match("\"".preg_quote($item->feed_link)."\"", $link, $matches);
					if($matches){
						$feedLinkExist = true;
						break;
					}
				}
				if(!$feedLinkExist){
				$doc->addHeadLink($item->feed_link, 'alternate', 'rel', array('type'=>$item->feedFormat, 'title'=>$item->feed_name));
				}
			}?>  
		<?php endforeach?>
    </div>
</div>
<?php }else{echo JText::_('Unable to retrieve Items!');}?>
<?php }else{echo JText::_('Ninja RSS Syndicator is not Installed!');}?>