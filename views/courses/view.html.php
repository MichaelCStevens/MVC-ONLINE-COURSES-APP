<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Paybook class for the Paybook Component
 */
class myaccountViewcourses extends JViewLegacy {

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
        if($action=='newcourse'){
          //  $this->model->newCourse(JRequest::get('POST'));
            
              $app->redirect('index.php?option=com_myaccount&view=courses', $this->model->newCourse(JRequest::get('POST')), $msgType = 'message');
        }
        $delete = JRequest::getVar('delete', '0');
        if ($delete > 0) {
            $app->redirect('index.php?option=com_myaccount&view=courses', $this->model->deleteItem($delete), $msgType = 'message');
        }

        if ($id > 0) {
            if (JRequest::getVar('save')) {

                $app->redirect('index.php?option=com_myaccount&view=courses', $this->model->updateCourse($id, JRequest::get('POST')), $msgType = 'message');
            }
            $this->course = $this->model->getCourse($id);
            parent::display('edit');
        } else {
            $this->courses = $this->model->getCourses();
            parent::display($tpl);
        }
    }

}
