<?php defined('_JEXEC') or die('Restricted access');

/*
* @version    2.0
* @package    com_ninjarsssydicator
* @author     NinjaForge
* @author email support@ninjaforge.com
* @link     http://ninjaforge.com
* @license      http://www.gnu.org/copyleft/gpl.html GNU GPL
* @copyright  Copyright (C) 2012 NinjaForge - All rights reserved.
*/

?>
<script src="../media/system/js/mootools-core.js" type="text/javascript"></script>
<script src="../media/system/js/core.js" type="text/javascript"></script>
  
<form method="post" action="index.php" name="adminForm" id="adminForm" class="adminForm">
  <table align="left">
    <tr>
      <td ><strong>Preview image:</strong></td>
   
      <td id="gen"><img src="<?php echo JURI::root() ?>administrator/index.php?option=com_ninjarsssyndicator&view=buttonmaker&layout=button&outerBorder=#666666&innerBorder=#ffffff&barPosition=25&leftFill=#ff6600&leftText=RSS&leftTextColor=#ffffff&leftTextPosition=5&rightFill=#898E79&rightText=Valid&rightTextColor=#ffffff&rightTextPosition=29" alt="" id="generated" height="15" width="80"></td>
    </tr>
    <tr>
      <td colspan="2"><strong>Borders</strong></td>
    </tr>
    <tr>
      <td><label for="outerBorder">Outer border</label></td>
      <td><input name="outerBorder" id="outerBorder" value="#666666" size="20" type="text">
        <a href="javascript:TCP.popup(document.forms['adminForm'].elements['outerBorder'])" ><img src="<?php echo JURI::root() ?>administrator/components/com_ninjarsssyndicator/assets/images/sel.gif" alt="Color Picker" title="Pick a color" border="0" height="13" width="15"></a></td>
    </tr>
    <tr>
      <td><label for="innerBorder">Inner border</label></td>
      <td><input name="innerBorder" id="innerBorder" value="#ffffff" size="20" type="text">
        <a href="javascript:TCP.popup(document.forms['adminForm'].elements['innerBorder']);" ><img src="<?php echo JURI::root() ?>administrator/components/com_ninjarsssyndicator/assets/images/sel.gif" alt="Color Picker" title="Pick a color" border="0" height="13" width="15"></a></td>
    </tr>
    <tr>
      <td><label for="barPosition">Bar Position</label></td>
      <td><input name="barPosition" id="barPosition" value="25" size="20" type="text">
        pixels from the left</td>
    </tr>
    <tr>
      <td colspan="2"><strong>Left Box</strong></td>
    </tr>
    <tr>
      <td><label for="leftText">Text</label></td>
      <td><input name="leftText" id="leftText" value="RSS" size="20" type="text"></td>
    </tr>
    <tr>
      <td><label for="leftFill">Background</label></td>
      <td><input name="leftFill" id="leftFill" value="#ff6600" size="20"  type="text">
        <a href="javascript:TCP.popup(document.forms['adminForm'].elements['leftFill']);" ><img src="<?php echo JURI::root() ?>administrator/components/com_ninjarsssyndicator/assets/images/sel.gif" alt="Color Picker" title="Pick a color" border="0" height="13" width="15"></a></td>
    </tr>
    <tr>
      <td><label for="leftTextColor">Text color</label></td>
      <td><input name="leftTextColor" id="leftTextColor" value="#ffffff" size="20" type="text">
        <a href="javascript:TCP.popup(document.forms['adminForm'].elements['leftTextColor']);" ><img src="<?php echo JURI::root() ?>administrator/components/com_ninjarsssyndicator/assets/images/sel.gif" alt="Color Picker" title="Pick a color" border="0" height="13" width="15"></a></td>
    </tr>
    <tr>
      <td><label for="leftTextPosition">Text start</label></td>
      <td><input name="leftTextPosition" id="leftTextPosition" value="5" size="20" type="text">
        pixels from the left</td>
    </tr>
    <tr>
      <td colspan="2"><strong>Right Box</strong></td>
    </tr>
    <tr>
      <td><label for="rightText">Text</label></td>
      <td><input name="rightText" id="rightText" value="Valid" size="20" type="text"></td>
    </tr>
    <tr>
      <td><label for="rightFill">Background</label></td>
      <td><input name="rightFill" id="rightFill" value="#898E79" size="20" type="text">
        <a href="javascript:TCP.popup(document.forms['adminForm'].elements['rightFill']);" ><img src="<?php echo JURI::root() ?>administrator/components/com_ninjarsssyndicator/assets/images/sel.gif" alt="Color Picker" title="Pick a color" border="0" height="13" width="15"></a></td>
    </tr>
    <tr>
      <td><label for="rightTextColor">Text color</label></td>
      <td><input name="rightTextColor" id="rightTextColor" value="#ffffff" size="20" type="text">
        <a href="javascript:TCP.popup(document.forms['adminForm'].elements['rightTextColor']);" ><img src="<?php echo JURI::root() ?>administrator/components/com_ninjarsssyndicator/assets/images/sel.gif" alt="Color Picker" title="Pick a color" border="0" height="13" width="15"></a></td>
    </tr>
    <tr>
      <td><label for="rightTextPosition">Text start</label></td>
      <td><input name="rightTextPosition" id="rightTextPosition" value="29" size="20" type="text">
        pixels from the bar</td>
    </tr>
    <tr>
      <td colspan="2">
	  <p style="padding:10px 0px 0px 0px;margin:0px">
          <input name="Reset-Render" value="Reset" type="button" onclick="renderImage('reset')" />
          <input name="Render" value="Render" type="button" onclick="renderImage('render');" />
          <input name="Save" value="Save" type="button" id="btnSave" onclick="renderImage('save');" />
      </p>
	 </td>
    </tr>
    <tr><td colspan="2">    
    </td></tr>
  </table>
  <div id="btnsavetip" style="clear:both; display:none"></div>
  <input type="hidden" name="option" value="com_ninjarsssyndicator" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="save_img" value="0" />
  <input type="hidden" name="controller" id="controller" value="buttonmaker" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
<script type="text/javascript">
function toggleTip(msg)
{			
	if(!msg)
		//$('btnsavetip').setStyle('display','none');			
		document.getElementById('btnsavetip').style.display='none';
	else
	{
		//$('btnsavetip').setHTML(msg);	
		//$('btnsavetip').setStyle('display', 'block');
		document.getElementById('btnsavetip').style.display='';
		document.getElementById('btnsavetip').innerHTML = msg;		
	}
}

function renderImage(action) {
	var url = "<?php echo JURI::root();?>";
	var frm = $("adminForm");
	var imgUrl = url+"administrator/components/com_ninjarsssyndicator/views/buttonmaker/tmpl/button.php";
	if (action=="reset") {
		$("outerBorder").value="#666666";
		$("innerBorder").value="#ffffff";
		$("barPosition").value="25";
		$("leftText").value="RSS";
		$("leftFill").value="#ff6600";
		$("leftTextColor").value="#ffffff";
		$("leftTextPosition").value="5";
		$("rightText").value="Valid";
		$("rightFill").value="#898E79";
		$("rightTextColor").value="#ffffff";
		$("rightTextPosition").value="30";

		$("generated").src=imgUrl;		
	}
	else if(action=="save")
	{
		imgUrl = renderImage(''); 
		/*frm.getElement('input[name=task]').value = 'buttonmaker.save';
        frm.getElement('input[name=controller]').value = 'buttonmaker';
        frm.getElement('input[name=save_img]').value = '1';
		frm.send({
            method: 'POST',
            onRequest: function() {
            	toggleTip('');
                $('btnSave').setAttribute('disabled', 'disabled');
            },
            onComplete: function() {
            	$('btnSave').removeAttribute('disabled'); 
            	toggleTip(this.response.text);
                frm.getElement('input[name=save_img]').value = '0';
            },  
            onFailure:function() {
            	$('btnSave').removeAttribute('disabled');
                frm.getElement('input[name=save_img]').value = '0';
            }  
                      
        });*/
		
		document.getElementById('btnsavetip').disabled='true';
		
		var xmlHttpReq = false;
		var self = this;
		// Mozilla/Safari
		if (window.XMLHttpRequest) {
			self.xmlHttpReq = new XMLHttpRequest();
		}
		// IE
		else if (window.ActiveXObject) {
			self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
		}
					
		self.xmlHttpReq.open('GET', imgUrl+'save_img=1', true);
		self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		
		self.xmlHttpReq.onreadystatechange = function() 
		{	
			if (self.xmlHttpReq.readyState == 4) {
				//alert(self.xmlHttpReq.responseText);
				toggleTip(self.xmlHttpReq.responseText);
				document.getElementById('btnsavetip').disabled='false';
			}
		}
		self.xmlHttpReq.send('');
		
		return;
	}
	else if(action == "render")
	{	
		toggleTip('Right click on the<strong> preview image</strong> and select <strong>Save as...</strong> to save the image');
	}
	
	//build image url
	var inputElems = frm.getElementsByTagName("input");
	var qs = "";
	for (var i = 0 ; i < inputElems.length; i++)
    {
		if (inputElems[i].getAttribute("type")=="text") {
		 var currElem = inputElems[i];
		 qs+=currElem.getAttribute("id");
		 qs+="=";
		 qs+=currElem.value;
		 if (i!=inputElems.length-1)
		 	qs+="&";
		}
	}
	//replace # chars as http don't like 'em
	var re = new RegExp ('#', 'gi') ;
	qs = qs.replace(re, '') ;
	imgUrl = url+"administrator/index.php?option=com_ninjarsssyndicator&view=buttonmaker&layout=button&"+qs
	$("generated").src= imgUrl;
	return imgUrl;
}
var mosUrl = "<?php echo JURI::root() ?>administrator/components/com_ninjarsssyndicator/";
</script>
<script language="JavaScript" src="<?php echo JURI::root() ?>administrator/components/com_ninjarsssyndicator/assets/js/picker.js"></script>