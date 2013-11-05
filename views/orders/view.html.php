<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Paybook class for the Paybook Component
 */
class myaccountViewOrders extends JViewLegacy {

// Overwriting JView display method
    function display($tpl = null) {

        $this->user = & JFactory::getUser();
        $app = JFactory::getApplication();
        $id = JRequest::getVar('id');
        $this->model = & $this->getModel();
        $this->userinfo = $this->model->getUser();
        $this->orders= $this->model->getOrders();
        $action = JRequest::getVar('action', '0');
        $publish = JRequest::getVar('publish', '0');
     

        if ($id > 0) {
            if (JRequest::getVar('save')) {

                $app->redirect('index.php?option=com_myaccount&view=study', $this->model->updatestudy($id, JRequest::get('POST')), $msgType = 'message');
            }
         
            parent::display('edit');
        } else {
       
            parent::display($tpl);
        }
    }

}
