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

        $this->user = & JFactory::getUser();
        $app = JFactory::getApplication();
        $this->model = & $this->getModel();
        $type = JRequest::getVar('type');
        $export = JRequest::getVar('export');
        $session = & JFactory::getSession();
        $start= JRequest::getVar('start');
        $end= JRequest::getVar('end');
    


        $this->reportRecords = $this->model->getReportRecords($type,$start,$end);
        $session->set('lastReport', $this->reportRecords);

        if ($type == '1') {

            parent::display('report2');
        } else {

            parent::display($tpl);
        }
    }

}
