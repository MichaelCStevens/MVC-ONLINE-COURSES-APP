<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

/**
 * Paybook Model
 */
class GrouppaybookModelhome extends JModelItem {

    /**
     * @var object item
     */
    function __construct() {

        $this->user = & JFactory::getUser();
        $this->db = JFactory::getDBO();
        parent::__construct();
    }

    public function getUser() {
        $query = "SELECT * FROM #__league_user WHERE id = '" . $this->user->id . "';";

        $this->db->setQuery($query);
        $result = $this->db->loadObject();
        return $result;
    }

    public function getFeaturedGroups() {
        $date = date('Y-m-d H:i:s');
        $query = "SELECT * FROM #__groups WHERE featured='1'";
        //  echo $query;
        $this->db->setQuery($query);
        if ($this->db->query()) {
          
            $result = $this->db->loadObjectList();
            return $result;
        } else {
            return false;
        }
    }

}
