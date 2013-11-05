<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

/**
 * Paybook Model
 */
class myaccountModelmyaccount extends JModelItem {

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

    public function getCats() {
        $query = "SELECT * FROM cat;";
        $this->db->setQuery($query);
        $result = $this->db->loadObjectList();
        return $result;
    }

    public function updateEmail($post) {
        $text = $post['email_text'];
        $query = "UPDATE a_settings SET setting_val='$text' WHERE setting='order_email';";
        $this->db->setQuery($query);
        $this->db->query();
        return 'Order Email Updated';
    }

    public function getEmailOrder() {
        $query = "SELECT * FROM a_settings WHERE setting='order_email';";
        $this->db->setQuery($query);
        $result = $this->db->loadObject();
        return $result->setting_val;
    }

    public function newCat($post) {
        $query = "INSERT INTO cat SET title='" . $post['title'] . "';";
        $this->db->setQuery($query);
        $this->db->query();
        return 'Category Created';
    }

    public function deleteCat($id) {
        $query = "DELETE FROM cat WHERE id='$id'";
        $this->db->setQuery($query);
        $this->db->query();
        return 'Category Deleted';
    }

    public function updateProfile($post) {
        $post['first'];
        $query = "UPDATE user_info SET first='" . $post['first'] . "' , last='" . $post['last'] . "' , address='" . $post['address'] . "' , 
            city='" . $post['city'] . "' , country='" . $post['country'] . "' , phone='" . $post['phone'] . "' , state='" . $post['state'] . "' , 
            zip='" . $post['zip'] . "' , lic_number='" . $post['lic_number'] . "' WHERE user_id = '" . $this->user->id . "';";
        $this->db->setQuery($query);
        $this->db->query();
        return "Profile Updated Successfully";
    }

    public function getCourses() {
        $query = "SELECT * FROM courses_users AS a
                LEFT JOIN courses AS b ON a.course_id = b.id 
                WHERE a.user_id = '" . $this->user->id . "'
                ORDER BY score ASC;";



        $this->db->setQuery($query);
        $result = $this->db->loadObjectList();
        return $result;
    }

    public function getOrders() {
        $query = "SELECT * FROM orders WHERE user_id = '" . $this->user->id . "';";
        $this->db->setQuery($query);
        $result = $this->db->loadObjectlist();
        return $result;
    }

    public function getOrderItems($orderid) {
        $query = "SELECT * FROM order_items WHERE order_id = '" . $orderid . "';";
        $this->db->setQuery($query);
        $result = $this->db->loadObjectlist();
        return $result;
    }

    public function getCerts() {
        $query = "SELECT * FROM certificate_users AS a
                LEFT JOIN certificates AS b ON a.cert_id = b.id
                WHERE a.user_id = '" . $this->user->id . "';";
        $this->db->setQuery($query);
        $result = $this->db->loadObjectlist();
        return $result;
    }

    public function getStudyMaterial() {
        $query = "SELECT * FROM study_material_users AS a
                LEFT JOIN study_materials AS b ON a.sm_id = b.id
                WHERE a.user_id = '" . $this->user->id . "';";
        $this->db->setQuery($query);
        $result = $this->db->loadObjectlist();
        return $result;
    }

    public function getExams() {
        $query = "SELECT b.id AS exam_id, c.id AS cat_id, c.title AS cattitle, b.title AS examtitle
            FROM exam_users AS a
                LEFT JOIN exam AS b ON a.exam_id = b.id
                LEFT JOIN exam_cat AS c ON b.cat = c.id
                WHERE a.user_id = '" . $this->user->id . "';";
        $this->db->setQuery($query);
        $result = $this->db->loadObjectlist();
        return $result;
    }

    function getReceipt($orderID) {
        if ($this->isMyOrder($orderID) == true) {
            //$orderid belongs to user put sql for returning order info
            $query = "SELECT * FROM orders AS a
                  LEFT JOIN order_items AS b ON a.id=b.order_id
                        WHERE a.id = '$orderID'";
            $this->db->setQuery($query);
            $result = $this->db->loadObject();
            return $result;
        } else {
            //return false, userid did not place order
            return false;
        }
    }

    function isMyOrder($orderID) {
        //query database to see if user created order
        $query = "SELECT * FROM orders WHERE id='$orderID' AND user_id='" . $this->user->id . "'";
        $this->db->setQuery($query);
        $this->db->query();
        $result = $this->db->getNumRows();
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getCourseCopy() {
        $array = array();
        $query = "SELECT * FROM a_settings WHERE setting='course_text';";
        $this->db->setQuery($query);
        $result = $this->db->loadObject();
        $array[] = $result->setting_val;
        $query = "SELECT * FROM a_settings WHERE setting='course_text2';";
        $this->db->setQuery($query);
        $result = $this->db->loadObject();
        $array[] = $result->setting_val;
        return $array;
    }
        public function updateCourseCopy($post) {
        $text = $post['course_copy'];
         $text2 = $post['course_copy2'];
        $query = "UPDATE a_settings SET setting_val='$text' WHERE setting='course_text';";
        $this->db->setQuery($query);
        $this->db->query();
          $query = "UPDATE a_settings SET setting_val='$text2' WHERE setting='course_text2';";
        $this->db->setQuery($query);
        $this->db->query();
        return 'Course Copy Updated';
    }
       public function getSeminarCopy() {
        $array = array();
        $query = "SELECT * FROM a_settings WHERE setting='seminar_text';";
        $this->db->setQuery($query);
        $result = $this->db->loadObject();
        $array[] = $result->setting_val;
        $query = "SELECT * FROM a_settings WHERE setting='seminar_text2';";
        $this->db->setQuery($query);
        $result = $this->db->loadObject();
        $array[] = $result->setting_val;
        return $array;
    }
        public function updateSeminarCopy($post) {
        $text = $post['course_copy'];
         $text2 = $post['course_copy2'];
        $query = "UPDATE a_settings SET setting_val='$text' WHERE setting='seminar_text';";
        $this->db->setQuery($query);
        $this->db->query();
          $query = "UPDATE a_settings SET setting_val='$text2' WHERE setting='seminar_text2';";
        $this->db->setQuery($query);
        $this->db->query();
        return 'Seminar Copy Updated';
    }

}
