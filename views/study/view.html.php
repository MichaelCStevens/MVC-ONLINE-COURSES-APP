<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Paybook class for the Paybook Component
 */
class myaccountViewStudy extends JViewLegacy {

// Overwriting JView display method
    function display($tpl = null) {

        $this->user = & JFactory::getUser();
        $app = JFactory::getApplication();
        $id = JRequest::getVar('id');
        $this->model = & $this->getModel();
        $this->userinfo = $this->model->getUser();
        $this->courses = $this->model->getCourses();
        $action = JRequest::getVar('action', '0');
        $publish = JRequest::getVar('publish', '0');
        if($publish>0&&$action!='newstudy'){
             $app->redirect('index.php?option=com_myaccount&view=study', $this->model->publishstudy($publish,JRequest::getVar('id', '0')), $msgType = 'message');
        }
        if($action=='newstudy'){
              $app->redirect('index.php?option=com_myaccount&view=study', $this->model->newstudy(JRequest::get('POST')), $msgType = 'message');
        }
                $delete = JRequest::getVar('delete', '0');
        if ($delete > 0) {
            $app->redirect('index.php?option=com_myaccount&view=study', $this->model->deleteItem($delete), $msgType = 'message');
        }


        if ($id > 0) {
            if (JRequest::getVar('save')) {

                $app->redirect('index.php?option=com_myaccount&view=study', $this->model->updatestudy($id, JRequest::get('POST')), $msgType = 'message');
            }
            $this->study = $this->model->getstudy($id);
            parent::display('edit');
        } else {
            $this->studys = $this->model->getstudys();
            parent::display($tpl);
        }
    }

}
