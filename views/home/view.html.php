<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Paybook class for the Paybook Component
 */
class grouppaybookViewHome extends JViewLegacy {

    // Overwriting JView display method
    function display($tpl = null) {
        // Assign data to the view
        $this->item = $this->get('Item');
        $this->model = & $this->getModel();
        $this->featuredGroups = $this->model->getFeaturedGroups();
        // Check for errors.
//		if (count($errors = $this->get('Errors'))) 
//		{
//			JError::raiseError(500, implode('<br />', $errors));
//			return false;
//		}
        // Display the view
        parent::display($tpl);
    }

}
