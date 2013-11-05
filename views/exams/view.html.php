<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Paybook class for the Paybook Component
 */
class myaccountViewexams extends JViewLegacy {

// Overwriting JView display method
    function display($tpl = null) {

        $this->user = & JFactory::getUser();
        $app = JFactory::getApplication();
        $id = JRequest::getVar('id');
        $this->model = & $this->getModel();
        $this->userinfo = $this->model->getUser();
        $this->courses = $this->model->getCourses();

        $this->cats = $this->model->getCats();
        $action = JRequest::getVar('action', '0');
        $publish = JRequest::getVar('publish', '0');
        if ($publish > 0 && $id == 0 && $action != 'newexam') {
            $app->redirect('index.php?option=com_myaccount&view=exams', $this->model->publishExam($publish, JRequest::getVar('id', '0')), $msgType = 'message');
        }
        if ($action == 'newexam') {
            $app->redirect('index.php?option=com_myaccount&view=exams', $this->model->newExam(JRequest::get('POST')), $msgType = 'message');
        }
        $delete = JRequest::getVar('delete', '0');
        if ($delete > 0) {
            $app->redirect('index.php?option=com_myaccount&view=exams', $this->model->deleteItem($delete), $msgType = 'message');
        }

        if ($id > 0) {
            if (JRequest::getVar('save')) {

                $app->redirect('index.php?option=com_myaccount&view=exams&id=' . $id, $this->model->updateExam($id, JRequest::get('POST')), $msgType = 'message');
            }
            $this->exam = $this->model->getexam($id);
            $this->questions = $this->model->getquestions($id);
            $this->examCourses = $this->model->getExamCourses($id);
            parent::display('edit');
        } else {
            $this->examCourses = $this->model->getExamCourses2($id);
            $this->exams = $this->model->getexams();
            parent::display($tpl);
        }
    }

}
