<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Paybook class for the Paybook Component
 */
class myaccountViewcertificates extends JViewLegacy {

// Overwriting JView display method
    function display($tpl = null) {

        $this->user = & JFactory::getUser();
        $app = JFactory::getApplication();
        $id = JRequest::getVar('id', '0');
        $this->model = & $this->getModel();
        $this->userinfo = $this->model->getUser();
        $this->courses = $this->model->getCourses();
        $action = JRequest::getVar('action');
        $publish = JRequest::getVar('publish', '0');
        if($publish>0&&$id == 0&&$action!='newcertificate'){
             $app->redirect('index.php?option=com_myaccount&view=certificates', $this->model->publishcertificate($publish,JRequest::getVar('id', '0')), $msgType = 'message');
        }
        if($action=='newcertificate'){
              $app->redirect('index.php?option=com_myaccount&view=certificates', $this->model->newcertificate(JRequest::get('POST',JREQUEST_ALLOWHTML)), $msgType = 'message');
        }
        $delete = JRequest::getVar('delete', '0');
        if ($delete > 0) {
            $app->redirect('index.php?option=com_myaccount&view=certificates', $this->model->deleteItem($delete), $msgType = 'message');
        }

        if ($id > 0) {
            if (JRequest::getVar('save')) {

                $app->redirect('index.php?option=com_myaccount&view=certificates', $this->model->updatecertificate($id, JRequest::get('POST',JREQUEST_ALLOWHTML)), $msgType = 'message');
            }
            $this->certificate = $this->model->getCertificate($id);
             $this->certCourses = $this->model->getCertCourses($id);
            parent::display('edit');
        } else {
             $this->certCourses = $this->model->getCertCourses2($id);
            $this->certificates = $this->model->getCertificates();
            parent::display($tpl);
        }
    }

}
