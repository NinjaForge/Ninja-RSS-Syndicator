<?php
/* 
 * Copyright Bill Zeller, Minimal Verbosity.com
 *
 * Steal this code.
 *
 */

/*
* @version      2.0
* @package      com_ninjarsssydicator
* @author       NinjaForge
* @author email support@ninjaforge.com
* @link         http://ninjaforge.com
* @license      http://www.gnu.org/copyleft/gpl.html GNU GPL
* @copyright    Copyright (C) 2012 NinjaForge - All rights reserved.
*/

defined('_JEXEC') or die('Restricted access');
$lettersPath = dirname(__FILE__).DS."letters.png";

$save_file          = JRequest::getInt('save_img',0);
$leftTextPosition   = JRequest::getInt('leftTextPosition', 5);
$rightTextPosition  = JRequest::getInt('rightTextPosition', 29);
$barPosition        = JRequest::getInt('barPosition', 25);

$leftText           = JRequest::getVar('leftText', 'RSS');
$rightText          = JRequest::getVar('rightText', 'VALID');
$leftTextColor      = JRequest::getVar('leftTextColor', 'ffffff');
$rightTextColor     = JRequest::getVar('rightTextColor', 'ffffff');
$outerBorder        = JRequest::getVar('outerBorder', '666666');
$innerBorder        = JRequest::getVar('innerBorder', 'ffffff');
$leftFill           = JRequest::getVar('leftFill', 'ff6600');
$rightFill          = JRequest::getVar('rightFill', '898E79');

$leftTextColor  = str_replace('#', '', $leftTextColor);
$rightTextColor = str_replace('#', '', $rightTextColor);
$outerBorder    = str_replace('#', '', $outerBorder);
$innerBorder    = str_replace('#', '', $innerBorder);
$leftFill       = str_replace('#', '', $leftFill);
$rightFill      = str_replace('#', '', $rightFill);


function ImageColorAllocateHex( $image, $hex ) { 
    for( $i=0; $i<3; $i++ ) {
        $temp = substr($hex, 2*$i, 2);
        $rgb[$i] = 16 * hexdec( substr($temp, 0, 1) ) + hexdec(substr($temp, 1, 1));
    }
    $rgb = ImageColorAllocate ( $image, $rgb[0], $rgb[1], $rgb[2] );
    return $rgb;
}

function getRGB($hex ) { 
    for( $i=0; $i<3; $i++ ) {
        $temp = substr($hex, 2*$i, 2);
        $rgb[$i] = 16 * hexdec( substr($temp, 0, 1) ) + hexdec(substr($temp, 1, 1));
    }
    return $rgb;
}

$im = @imagecreatetruecolor(80, 15) or die ("Cannot Initialize new GD image stream");
imagerectangle($im, 0, 0, 79, 14, ImageColorAllocateHex($im,$outerBorder));
imagerectangle($im, 1, 1, 78, 13, ImageColorAllocateHex($im, $innerBorder));

$barPosition = $barPosition;
imageline ($im, $barPosition, 1, $barPosition, 12, ImageColorAllocateHex($im, $innerBorder));

imagefilledrectangle($im, 2, 2, $barPosition-1, 12, ImageColorAllocateHex($im, $leftFill));
imagefilledrectangle($im, $barPosition+1, 2, 77, 12, ImageColorAllocateHex($im, $rightFill));

$images[65] = array("x"=>0, "y"=>0, "w"=>6);
$images[66] = array("x"=>6, "y"=>0, "w"=>6);
$images[67] = array("x"=>12, "y"=>0, "w"=>6);
$images[68] = array("x"=>18, "y"=>0, "w"=>6);
$images[69] = array("x"=>24, "y"=>0, "w"=>5);
$images[70] = array("x"=>29, "y"=>0, "w"=>5);
$images[71] = array("x"=>34, "y"=>0, "w"=>6);
$images[72] = array("x"=>40, "y"=>0, "w"=>6);
$images[73] = array("x"=>46, "y"=>0, "w"=>3);
$images[74] = array("x"=>49, "y"=>0, "w"=>6);
$images[75] = array("x"=>55, "y"=>0, "w"=>6);
$images[76] = array("x"=>61, "y"=>0, "w"=>5);
$images[77] = array("x"=>66, "y"=>0, "w"=>7);
$images[78] = array("x"=>73, "y"=>0, "w"=>7);
$images[79] = array("x"=>80, "y"=>0, "w"=>6);
$images[80] = array("x"=>86, "y"=>0, "w"=>6);
$images[81] = array("x"=>92, "y"=>0, "w"=>6);
$images[82] = array("x"=>98, "y"=>0, "w"=>6);
$images[83] = array("x"=>104, "y"=>0, "w"=>6);
$images[84] = array("x"=>110, "y"=>0, "w"=>5);
$images[85] = array("x"=>115, "y"=>0, "w"=>6);
$images[86] = array("x"=>121, "y"=>0, "w"=>7);
$images[87] = array("x"=>128, "y"=>0, "w"=>7);
$images[88] = array("x"=>135, "y"=>0, "w"=>7);
$images[89] = array("x"=>142, "y"=>0, "w"=>7);
$images[90] = array("x"=>149, "y"=>0, "w"=>5);
$images[32] = array("x"=>154, "y"=>0, "w"=>4);

$images[49] = array("x"=>0, "y"=>10, "w"=>5);
$images[50] = array("x"=>5, "y"=>10, "w"=>6);
$images[51] = array("x"=>11, "y"=>10, "w"=>6);
$images[52] = array("x"=>17, "y"=>10, "w"=>6);
$images[53] = array("x"=>23, "y"=>10, "w"=>6);
$images[54] = array("x"=>29, "y"=>10, "w"=>6);
$images[55] = array("x"=>35, "y"=>10, "w"=>6);
$images[56] = array("x"=>41, "y"=>10, "w"=>6);
$images[57] = array("x"=>47, "y"=>10, "w"=>6);
$images[48] = array("x"=>53, "y"=>10, "w"=>6);

$images[33] = array("x"=>59, "y"=>10, "w"=>3);// !
$images[64] = array("x"=>62, "y"=>10, "w"=>7);// @
$images[35] = array("x"=>69, "y"=>10, "w"=>7);// #
$images[36] = array("x"=>76, "y"=>10, "w"=>6);// $
$images[37] = array("x"=>82, "y"=>10, "w"=>7);// %
$images[94] = array("x"=>89, "y"=>10, "w"=>5);// ^
$images[38] = array("x"=>94, "y"=>10, "w"=>6);// &
$images[42] = array("x"=>100, "y"=>10, "w"=>7);// *
$images[40] = array("x"=>107, "y"=>10, "w"=>4);// (
$images[41] = array("x"=>111, "y"=>10, "w"=>4);// )
$images[95] = array("x"=>115, "y"=>10, "w"=>6);// _
$images[43] = array("x"=>121, "y"=>10, "w"=>7);// +
$images[96] = array("x"=>128, "y"=>10, "w"=>4);// `
$images[126] = array("x"=>132, "y"=>10, "w"=>6);// ~
$images[91] = array("x"=>138, "y"=>10, "w"=>4);// [
$images[93] = array("x"=>142, "y"=>10, "w"=>4);// ]
$images[92] = array("x"=>146, "y"=>10, "w"=>5);// \
$images[123] = array("x"=>151, "y"=>10, "w"=>5);// {
$images[125] = array("x"=>156, "y"=>10, "w"=>5);// }
$images[124] = array("x"=>161, "y"=>10, "w"=>3);// |
$images[59] = array("x"=>164, "y"=>10, "w"=>4);// ;
$images[58] = array("x"=>168, "y"=>10, "w"=>3);// :
$images[39] = array("x"=>171, "y"=>10, "w"=>3);// '
$images[34] = array("x"=>174, "y"=>10, "w"=>5);// "
$images[44] = array("x"=>179, "y"=>10, "w"=>4);// ,
$images[46] = array("x"=>183, "y"=>10, "w"=>3);// .
$images[47] = array("x"=>186, "y"=>10, "w"=>5);// /
$images[60] = array("x"=>191, "y"=>10, "w"=>5);// <
$images[62] = array("x"=>196, "y"=>10, "w"=>5);// >
$images[63] = array("x"=>201, "y"=>10, "w"=>6);// ?
$images[61] = array("x"=>207, "y"=>10, "w"=>5);// =


$letters = imagecreatefrompng($lettersPath);
$rgb = getRGB($leftTextColor);

$index = imagecolorexact($letters, 0, 0, 0);
imagecolorset ($letters, $index, $rgb[0], $rgb[1], $rgb[2]);

$leftText = stripslashes(strtoupper($leftText));

$leftPos = $leftTextPosition;
for($i=0;$i<strlen($leftText);$i++){

    $c = ord($leftText[$i]);
    imagecopy ($im, $letters, $leftPos, 5, $images[$c]["x"], $images[$c]["y"], $images[$c]["w"], 6);
    $leftPos+=$images[$c]["w"];
}

$letters = imagecreatefrompng($lettersPath);
$rgb = getRGB($rightTextColor);

$index = imagecolorexact($letters, 0, 0, 0);
imagecolorset ($letters, $index, $rgb[0], $rgb[1], $rgb[2]);

$rightText = stripslashes(strtoupper($rightText));

$rightPos = $rightTextPosition;
for($i=0;$i<strlen($rightText);$i++){

    $c = ord($rightText[$i]);
    imagecopy ($im, $letters, $rightPos, 5, $images[$c]["x"], $images[$c]["y"], $images[$c]["w"], 6);
    $rightPos+=$images[$c]["w"];
}
if($save_file)
{
    $save_path =JPATH_ROOT .DS. "components".DS."com_ninjarsssyndicator".DS."assets".DS."images".DS."buttons";

    if(!_isWritable($save_path.'/'))
    {
        exit("Cannot access $save_path  directory!");
    }
    $img_name = $leftText .'-'. $rightText. '-'. time() . '.png';
    $img_name = strtolower($img_name);
    imagepng($im, $save_path .DS. $img_name);

    if(file_exists($save_path .DS. $img_name))
    {
        exit('Image saved! link: <a href="'.JURI::root().'components/com_ninjarsssyndicator/assets/images/buttons/'.$img_name.'" title="'.$img_name.'">'.JURI::root().'components/com_ninjarsssyndicator/assets/images/buttons/'.$img_name.'</a>');
    }
    else
    {
        exit("Error saving image");
    }
}
else
{
    header ("Content-type: image/png");
    imagepng ($im);
    exit();
}

function _isWritable($path) {
		if ($path{strlen($path)-1}=='/')
		return _isWritable($path.uniqid(mt_rand()).'.tmp');

		if (file_exists($path)) {
			if (!($f = @fopen($path, 'r+')))
			return false;
			fclose($f);
			return true;
		}

		if (!($f = @fopen($path, 'w')))
		return false;
		fclose($f);
		unlink($path);
		return true;
	}

?>