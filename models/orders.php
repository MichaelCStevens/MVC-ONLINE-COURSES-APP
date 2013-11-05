<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

/**
 * Paybook Model
 */
class myaccountModelOrders extends JModelItem {

    /**
     * @var object item
     */
    function __construct() {

        $this->user = & JFactory::getUser();
        //print_r($this->user->guest);
        $this->db = JFactory::getDBO();
        parent::__construct();
    }

    public function getUser() {
        $query = "SELECT * FROM user_info WHERE user_id = '" . $this->user->id . "';";
        $this->db->setQuery($query);
        $result = $this->db->loadObject();
        return $result;
    }

    public function getUsers() {
        $query = "SELECT * FROM user_info as a
            LEFT JOIN #__users as b on a.user_id=b.id;";
        $this->db->setQuery($query);
        $result = $this->db->loadObjectList();
        return $result;
    }

    public function getCats() {
        $query = "SELECT * FROM cat;";
        $this->db->setQuery($query);
        $result = $this->db->loadObjectList();
        return $result;
    }
    public function getCourses() {
        $query = "SELECT * FROM courses;";
        $this->db->setQuery($query);
        $result = $this->db->loadObjectList();
        return $result;
    }
    public function getOrders() {
        $query = "SELECT *, a.id orderid FROM orders as a 
            LEFT JOIN user_info as c on a.user_id=c.user_id";
        $this->db->setQuery($query);
        $result = $this->db->loadObjectList();
        return $result;
    }
   public function getOrderItems($orderID) {
        $query = "SELECT * FROM order_items WHERE order_id='$orderID'";
       // echo $query;
        $this->db->setQuery($query);
        $result = $this->db->loadObjectList();
        return $result;
    }
    
}
