<?php

/**
* @Copyright Copyright (C) 2010 Ninja Forge
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
**/

jimport('joomla.application.component.controller');

class NinjaRssSyndicatorControllerFeed extends JController
{

	var $_link = null;
	function __construct()
	{
		parent::__construct();
		$this->_link = 'index.php?option=com_ninjarsssyndicator&task=feeds';
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
		if($this->_task == 'apply')
		{
			$id = JRequest::getVar( 'id', '', 'post', 'string' );
			//die(JRequest::getVar('id' ));
			$this->_link = "index.php?option=com_ninjarsssyndicator&task=edit&cid[]=$id&controller=feed";
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
		$document = &JFactory::getDocument();
		$viewType = $document->getType();
		$view = &$this->getView('feeds',$viewType,'NinjaRssSyndicatorView');
		$model = &$this->getModel('feed');
		if(!JError::isError($model))
		{
			$view->setModel($model,true);
		}
		$view->setLayout('feeds');
		$view->display();
			
	}
	
	
	
}
?>
