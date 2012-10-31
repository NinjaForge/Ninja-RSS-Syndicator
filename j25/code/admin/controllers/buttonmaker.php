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

/**
 * @version		$Id: group.php 48 2011-06-25 08:22:19Z trung3388@gmail.com $
 * @copyright	JoomAvatar.com
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

class NinjaRssSyndicatorControllerButtonMaker extends JControllerForm
{
	var $_link = null;
	function __construct()
	{
		
		parent::__construct();
		$this->_link = 'index.php?option=com_ninjarsssyndicator&view=buttonmaker';
	}
	
	function save()
	{		
		$model = $this->getModel('buttonmaker');
		$msg = $model->save($post);
		
		$is_ajaxed = isset($_SERVER["HTTP_X_REQUESTED_WITH"]) ? ($_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest") : false;
		if($is_ajaxed)
			exit($msg);		
		$this->setRedirect( $this->_link, $msg );
	}	
}

