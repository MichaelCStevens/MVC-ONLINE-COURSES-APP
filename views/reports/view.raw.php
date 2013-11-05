<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Paybook class for the Paybook Component
 */
class myaccountViewreports extends JViewLegacy {

    // Overwriting JView display method
    function display($tpl = null) {
        $action = JRequest::getVar('action');
        $user = JRequest::getVar('uid');
        $this->model = & $this->getModel();
        $export = JRequest::getVar('export');
        $session = & JFactory::getSession();
        if ($export >0) {
            $lastReport = $session->get('lastReport', 'empty');
            if ($lastReport != 'empty') {
//print_r($lastReport);
                if ($export == 1) { $this->model->exportPurchaseResults($lastReport);}
                  if ($export == 2) {$this->model->exportQuizResults($lastReport);}
                return;
            } else {
                echo"no last sesssion";
            }
        }
    }

}

