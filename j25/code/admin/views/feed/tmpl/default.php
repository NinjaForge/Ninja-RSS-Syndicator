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
?>


<form action="index.php" method="post" name="adminForm" id="adminForm" class="adminForm">
    <table border="0" cellpadding="3" cellspacing="0" align="left">
        <tr>
            <td>Feed name:</td>
            <td><input type="text" size="50" maxlength="150" name="feed_name" value="<?php echo($this->name); ?>" /></td>
        </tr>
        <tr>
            <td>RSS Description</td><td><?php echo $this->editor->display( 'feed_description',  $this->description, 500, 200, 70, 20, 1 ) ; ?></td>
        </tr>
        <tr>
            <td rowspan="2" valign="top">Provide feed as RSS type:</td><td><?php echo $this->lists['rssTypeList']; ?></td>
        </tr>
        <tr>
          <td><i><small><font color="#FF0000">Important note: RSS 1.0 and 0.91, OPML, and MBOX are provided for backward compatibility,<br />but are no longer supported by NinjaForge.<br />We only provide support for Atom and RSS 2.0 on our support forum.</font></small></i></td>
        </tr>
        <tr>
            <td>Number of messages to show in feed: </td><td><input type="text" size="3" maxlength="3" name="msg_count" value="<?php echo $this->count; ?>" /></td>
        </tr>
        <tr>
            <td>Order by</td><td><?php echo $this->lists['orderingList']; ?></td>
        </tr>
        <?php /*>> MAD 2007/10/10 */  ?>
        <tr>
            <td>Select the number of words to display in the feed</td><td><?php echo $this->lists['numWordsList']; ?></td>
        </tr>
        <tr>
            <td>Fulltext</td><td><?php echo $this->lists['fulltextlist'];?></td>
        </tr>
        <?php /*<< MAD 2007/10/10 */  ?>
        <tr>
            <td>Include Author's email and name?</td><td><?php echo $this->lists['renderAuthorList']; ?></td>
        </tr>
        <tr>
            <td>Render HTML?</td><td><?php echo $this->lists['renderHTMLList'];?></td>
        </tr>
        <tr>
            <td>Render Images?</td><td><?php echo $this->lists['renderImagesList'];?></td>
        </tr>
        <tr>
            <td>Frontpage Items only?</td><td><?php echo $this->lists['FPItemsOnlyList'];?></td>
        </tr>
        <tr>
            <td>Number of seconds to cache</td><td><input type="text" size="10" maxlength="10" name="feed_cache" value="<?php echo $this->cache; ?>" /></td>
        </tr>
        <tr>
            <td>Published?</td><td><?php echo $this->lists['renderPublishedList'];?></td>
        </tr>
        <tr style="display:none">
            <td>Section(s)</td><td><?php echo $this->lists['sectionlist'];?></td>
        </tr>
        <tr>
            <td>Include or Exclude Categories?</td><td><?php echo $this->lists['includeCats'];?></td>
        </tr>
        <?php /*>> AGE 2007/09/25 */  ?>
        <tr>
            <td>Selected Categories</td><td><?php echo $this->lists['excludedcatlist'];?></td>
        </tr>
        <tr>
            <td>Excluded article(s)</td>
            <td>
                <textarea name="msg_exitems" cols="30" rows="3" ><?php echo $this->exitems; ?></textarea>
                <br />Enter article id(s) you want to exclude.
                <br />Seperate id with a ",". <br />Example: 1, 2, 3, 4, 5, 6
            </td>
        </tr>
        
        <!--  Includetags is  added to give support to the Joomla Tags Component -->
        <!-- Commented out until Joomla Tags is made J2.5 compatible - markup, June 2012
         <tr>
            <td>Included "Joomla Tags" Tags(s)</td>
            <td>
                <textarea name="msg_includetags" cols="30" rows="3" ><?php echo $this->includetags; ?></textarea>
                <br />Enter the Joomla Tags tags you want to include in this feed.  Leave blank for all.
                <br />Seperate tags with a ",". <br />Example: lawyer, fun, Iceland, volcano, etc
            </td>
        </tr>
        -->
        
        <tr>
            <td>Feed image<br />
			</td>
            <td>
                <input onchange="loadImg(this)" type="text" size="20" name="feed_imgUrl" value="<?php echo $this->imgUrl; ?>" />&nbsp;[Tab] to preview or leave blank to leave out image details from feed
            </td>
        </tr>		
        <tr>
            <td >Image Preview:</td><td valign="top"><img id="feedImg" src="<?php echo $this->imgUrl; ?>" /></td>
        </tr>
        <tr>
            <td>Feed button</td>
            <td><?php echo($this->lists['feedButtons']);?>&nbsp;
                <img id="feedButton" src="<?php echo (JURI::root() . "components/com_ninjarsssyndicator/assets/images/buttons/" . $this->BtnImgUrl); ?>" />
            </td>
        </tr>
    </table>
    <input type="hidden" name="id" value="<?php echo $this->id;?>" />
    <input type="hidden" name="option" value="com_ninjarsssyndicator" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="feed" />
    <?php echo JHTML::_( 'form.token' ); ?>
</form>
<script type="text/javascript">		
    checkRenderHtml();

    $('feed_renderHTML').addEvent('change', function(){
        checkRenderHtml();
    });
    $('feed_renderImages').addEvent('change', function(){
        checkRenderHtml();
    });

    function checkRenderHtml()
    {
        if($('feed_renderHTML').value == 0)
        {
            $('feed_renderImages').value = 0;
            $('feed_renderImages').setProperty('disabled','disabled');
        }
        else
        {
            $('feed_renderImages').setProperty('disabled','');
        }
    }
    function loadImg(elem) {
        document.getElementById("feedImg").src = elem.value;
    }
    function loadButton(elem) {
        document.getElementById("feedButton").src = '<?php echo(JURI::root() . "components/com_ninjarsssyndicator/assets/images/buttons/");?>' + elem.value;
    }
</script>