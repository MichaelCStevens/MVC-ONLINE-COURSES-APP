<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Paybook class for the Paybook Component
 */
class myaccountViewseminars extends JViewLegacy {

// Overwriting JView display method
    function display($tpl = null) {

        $this->user = & JFactory::getUser();
        $app = JFactory::getApplication();
        $id = JRequest::getVar('id');
        $this->model = & $this->getModel();
        $this->userinfo = $this->model->getUser();
        $this->cats = $this->model->getCats();
        $action = JRequest::getVar('action', '0');
        $publish = JRequest::getVar('publish', '0','GET');
        if($publish>0){
             $app->redirect('index.php?option=com_myaccount&view=courses', $this->model->publishCourse($publish,JRequest::getVar('id', '0')), $msgType = 'message');
        }
        if($action=='newseminar'){
          //  $this->model->newseminar(JRequest::get('POST'));
            
              $app->redirect('index.php?option=com_myaccount&view=seminars', $this->model->newseminar(JRequest::get('POST',JREQUEST_ALLOWHTML)), $msgType = 'message');
        }
        $delete = JRequest::getVar('delete', '0');
        if ($delete > 0) {
            $app->redirect('index.php?option=com_myaccount&view=seminars', $this->model->deleteItem($delete), $msgType = 'message');
        }

        if ($id > 0) {
            if (JRequest::getVar('save')) {

                $app->redirect('index.php?option=com_myaccount&view=seminars', $this->model->updateseminar($id, JRequest::get('POST',JREQUEST_ALLOWHTML)), $msgType = 'message');
            }
            $this->seminar = $this->model->getSeminar($id);
            parent::display('edit');
        } else {
            $this->seminars = $this->model->getSeminars();
            parent::display($tpl);
        }
    }

}
