<?php defined('_JEXEC') or die('Restricted access');

/*
* @version      2.0
* @package      com_ninjarsssydicator
* @author       NinjaForge
* @author email support@ninjaforge.com
* @link         http://ninjaforge.com
* @license      http://www.gnu.org/copyleft/gpl.html GNU GPL
* @copyright    Copyright (C) 2012 NinjaForge - All rights reserved.
*/

$rootpath = JURI::root();
?>
<form action="index.php" method="POST" name="adminForm">

    <div id="editcell">
        <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
            <thead>
                <tr>
                    <th width="5">#</th>
                    <th width="20"><input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $this->items ); ?>);" /></th>
                    <th width="100" align="left" nowrap="nowrap"><?php echo JText::_( 'Name' ); ?></th>
                    <th width="25" align="center" nowrap="nowrap"><?php echo JText::_( 'Button' ); ?></th>
                    <th width="50" align="left" nowrap="nowrap"><?php echo JText::_( 'Type' ); ?></th>
                    <th width="200" align="left" nowrap="nowrap"><?php echo JText::_( 'Feed url' ); ?></th>
                    <th width="5%" nowrap="nowrap"><?php echo JText::_( 'Published' ); ?></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="9">
                        <?php echo $this->pagination->getListFooter(); ?>
                    </td>
                </tr>
            </tfoot>
            <?php
            $k = 0;
            for ($i=0, $n=count( $this->items ); $i < $n; $i++) {
                $row = $this->items[$i];

                $checked 	= JHTML::_('grid.id',  $i, $row->id );
                $published 	= JHTML::_('grid.published', $row, $i );
				
				
				if(stristr($published,"'publish')"))
				{
					$published = str_replace("'publish')","'feed.publish')",$published);
				}				
				else if(stristr($published,"'unpublish')"))
				{
					$published = str_replace("'unpublish')","'feed.unpublish')",$published);
				}

                //$feedurl = JURI::root() . JRoute::_( "index.php?option=com_ninjarsssyndicator&feed_id=".$row->id."&format=raw");
				$feedurl = "../index.php?option=com_ninjarsssyndicator&feed_id=".$row->id."&format=raw";
                ?>
            <tr class="<?php echo "row$k"; ?>">
                <td><?php echo $this->pagination->getRowOffset( $i ); ?></td>
                <td>
                    <?php echo $checked ;?>
                </td>
                <td>

                    <span class="editlinktip hasTip" title="<?php echo JText::_( 'Edit feed' );?>::<?php echo $this->escape($row->feed_name); ?>">
                        <a href="#" onclick="return listItemTask('cb<?php echo $i; ?>','feed.edit')">
                    <?php echo $this->escape($row->feed_name); ?></a></span>

                </td>
                <td><img src="<?php if($row->feed_button != "") {echo ($rootpath . "components/com_ninjarsssyndicator/assets/images/buttons/".$row->feed_button);} ?>"></td>
                <td><?php echo $row->feed_type; ?></td>
                <td><a href="<?php echo $feedurl;?>" target="_blank"><?php echo $feedurl;?></a></td>
                <td><?php echo $published ;?></td>
            <?php		$k = 1 - $k; ?>		</tr>
            <?php	}
        ?>

        </table>
    </div>
    <div>
		<input type="hidden" name="option" value="com_ninjarsssyndicator" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="controller" value="feed" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>