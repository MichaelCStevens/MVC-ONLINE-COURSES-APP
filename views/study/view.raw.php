<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Paybook class for the Paybook Component
 */
class grouppaybookViewgrouppaybook extends JViewLegacy {

    // Overwriting JView display method
    function display($tpl = null) {
        $email = JRequest::getVar('confirm');
        $amount = JRequest::getVar('amount');
        $model = & $this->getModel();
        if ($amount > 0) {
            $senduser = $model->getUserByEmail($email);
            if ($senduser != false) {
                echo 'You are sending $' . $amount . ' to ' . $senduser->first . ' ' . $senduser->last . '. Are you sure?';
            } else {
                echo "User not found check email address";
            }
        }

        $killwelcome = JRequest::getVar('killwelcome');
        if ($killwelcome == 1) {
            $model->killWelcome();
        }
         $killinvite= JRequest::getVar('killinvite');
        if ( $killinvite >0) {
            $model->killinvite( $killinvite);
        }
    }

}

