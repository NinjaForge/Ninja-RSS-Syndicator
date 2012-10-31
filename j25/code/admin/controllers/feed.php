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
 * @version		$Id: coolfeed.php 85 2011-10-25 19:24:16Z trung3388@gmail.com $
 * @copyright	JoomAvatar.com
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

class NinjaRssSyndicatorControllerFeed extends JControllerForm
{
	var $_link = null;
	function __construct()
	{
		parent::__construct();
		$this->_link = 'index.php?option=com_ninjarsssyndicator&view=feeds';
		$this->registerTask( 'add'  , 	'edit' );
		$this->registerTask( 'apply'  , 	'save' );
	}
	
	function cancel()
	{
		//$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( $this->_link );
	}
	
	function edit()
	{
		
		JRequest::setVar( 'view', 'feed' );
		JRequest::setVar( 'layout', 'feed'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}
	
	function save()
	{
		$model = $this->getModel('feed');
		
		if ($model->save($post)) {
			$msg = JText::_( 'Feed Saved!' );
		} else {
			$msg = JText::_( 'Error Saving feed' );
		}
		if($this->task == 'apply')
		{
			$id = JRequest::getVar( 'id', '', 'post', 'string' );
			//die(JRequest::getVar('id' ));
			$this->_link = "index.php?option=com_ninjarsssyndicator&task=edit&cid[]=$id&view=feed";
		}
		$this->setRedirect( $this->_link, $msg );
	}

	function publish()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to publish' ) );
		}

		$model = $this->getModel('feed');
		if(!$model->publish($cid, 1)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}
		
		$this->setRedirect($this->_link);
	}
	
	function unpublish()
	{
		
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to unpublish' ) );
		}

		$model = $this->getModel('feed');
		if(!$model->publish($cid, 0)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect($this->_link);
	}

	function remove()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to delete' ) );
		}

		$model = $this->getModel('feed');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect($this->_link);
	}
	
	function feeds()
	{
		$document = JFactory::getDocument();
		$viewType = $document->getType();
		$view = $this->getView('feeds',$viewType,'NinjaRssSyndicatorView');
		$model = $this->getModel('feed');
		if(!JError::isError($model))
		{
			$view->setModel($model,true);
		}
		$view->setLayout('feeds');
		$view->display();
			
	}
}
