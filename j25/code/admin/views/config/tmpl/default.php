<?php defined('_JEXEC') or die('Restricted access');
/*
* @version		2.0
* @package		com_ninjarsssydicator
* @author 		NinjaForge
* @author email	support@ninjaforge.com
* @link			http://ninjaforge.com
* @license      http://www.gnu.org/copyleft/gpl.html GNU GPL
* @copyright	Copyright (C) 2012 NinjaForge - All rights reserved.
*/
?>
<?php /*<script>
			function loadImg(elem) {
				document.getElementById("feedImg").src = elem.value;
			}
		</script><?php */?>
		<form action="index.php" method="post" name="adminForm" id="adminForm" class="adminForm">
	<table border="0" cellpadding="3" cellspacing="0" align="left">
	<tr>
		<td>Text to display</td><td><textarea name="msg" cols="80" rows="3" ><?php echo $this->msg; ?></textarea></td>
	</tr>
	<tr>
		<td>RSS Description</td><td><textarea name="description" cols="80" rows="3" ><?php echo $this->description; ?></textarea></td>
	</tr>
	<tr>
		<td>Provide feed as RSS type:</td><td><?php echo $this->defaultType; ?></td>
	</tr>
	<tr>
		<td>Number of messages to show in feed: </td><td><input type="text" size="3" maxlength="3" name="count" value="<?php echo $this->count; ?>" /></td>
	</tr>
	<tr>
		<td>Ordering</td><td><?php echo $this->orderby; ?></td>
	</tr>
	<tr>
		<td>In summaries, select the number of words to display in the feed</td><td><?php echo $this->numWords; ?></td>
	</tr>
	<tr>
		<td>Include Author's email and name?</td><td><?php echo $this->renderAuthorFormat; ?></td>
	</tr>
	<tr>
		<td>Render HTML?</td><td><?php echo $this->renderHTML;?></td>
	</tr>
	<tr>
		<td>Frontpage Items only?</td><td><?php echo $this->FPItemsOnly;?></td>
	</tr>
	<tr>
		<td>Number of seconds to cache</td><td><input type="text" size="10" maxlength="10" name="cache" value="<?php echo $this->cache; ?>" /></td>
	</tr>
	<?php /*?><tr>
		<td>Url of feed image</td><td><input onchange="loadImg(this)" type="text" size="20" maxsize="100" name="imgUrl" value="<?php echo $this->imgUrl; ?>" />&nbsp;[Tab] to preview or leave blank to leave out image details from feed</td>
	</tr>
	<tr>
		<td >&nbsp;</td><td valign="top">Image Preview:<br /> <img id="feedImg" src="<?php echo $this->imgUrl; ?>" /></td>
	</tr><?php */?>
	</table>
	<input type="hidden" name="id" value="<?php echo $this->id;?>" />
	<input type="hidden" name="option" value="com_ninjarsssyndicator" />
	<input type="hidden" name="controller" value="config" />
	<input type="hidden" name="task" value="" />
	</form>