<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Paybook class for the Paybook Component
 */
class myaccountViewmyaccount extends JViewLegacy {

// Overwriting JView display method
    function display($tpl = null) {

        $this->user = & JFactory::getUser();
        $action = JRequest::getVar('action', '0');
// Assign data to the view
        $app = JFactory::getApplication();

//echo $this->model->name;
        $this->model = & $this->getModel();
        $this->userinfo = $this->model->getUser();
        $this->cats = $this->model->getCats();
        $this->emailText=$this->model->getEmailOrder();
        $this->courseCopy=$this->model->getCourseCopy();
        $this->seminarCopy=$this->model->getSeminarCopy();
        if ($action == 'newcat') {
            $app->redirect('index.php?option=com_myaccount', $this->model->newCat(JRequest::get('POST')), $msgType = 'message');
        }
        if ($action == 'deletecat') {
            $app->redirect('index.php?option=com_myaccount', $this->model->deleteCat(JRequest::getVar('id', '0')), $msgType = 'message');
        }
         if ($action == 'updateEmail') {
            $app->redirect('index.php?option=com_myaccount', $this->model->updateEmail(JRequest::get('POST',JREQUEST_ALLOWHTML)), $msgType = 'message');
        }
          if ($action == 'updateCCopy') {
            $app->redirect('index.php?option=com_myaccount', $this->model->updateCourseCopy(JRequest::get('POST',JREQUEST_ALLOWHTML)), $msgType = 'message');
        }
          if ($action == 'updateSCopy') {
            $app->redirect('index.php?option=com_myaccount', $this->model->updateSeminarCopy(JRequest::get('POST',JREQUEST_ALLOWHTML)), $msgType = 'message');
        }
        parent::display($tpl);
    }

}
