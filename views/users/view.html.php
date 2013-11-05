<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Paybook class for the Paybook Component
 */
class myaccountViewusers extends JViewLegacy {

// Overwriting JView display method
    function display($tpl = null) {

        $this->user = & JFactory::getUser(); 
        $app = JFactory::getApplication(); 
        $this->model = & $this->getModel();
        $this->userinfo = $this->model->getUsers();

        parent::display($tpl);
    }

}
