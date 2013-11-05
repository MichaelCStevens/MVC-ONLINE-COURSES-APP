<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

/**
 * Paybook Model
 */
class myaccountModelcourses extends JModelItem {

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

    public function deleteItem($id) {
        $query = "DELETE FROM courses WHERE id='$id'";
        $this->db->setQuery($query);
        $this->db->query();

        $query = "DELETE FROM courses_users WHERE course_id='$id'";
        $this->db->setQuery($query);
        $this->db->query();
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
        $query = "SELECT a.*, b.title as catTitle FROM courses as a
            LEFT JOIN cat as b ON a.cat=b.id ";
        $this->db->setQuery($query);
        $result = $this->db->loadObjectList();
        return $result;
    }

    public function getCourse($id) {
        $query = "SELECT * FROM courses WHERE id='$id'";
        $this->db->setQuery($query);
        $result = $this->db->loadObject();
        return $result;
    }

    public function updateCourse($id, $post) {
        $material = $this->uploadFile($post['material'], '/components/com_myaccount/uploads/courses/');

        if ($material != 'ERROR NO FILE') {
            $mat = ", material='$material' ";
        } else {
            $mat = '';
        }
        if (!isset($post['publish'])) {
            $publish = ", publish='0'";
        } else {
            $publish = ", publish='1'";
        }
        $query = "UPDATE courses 
           SET cat='" . $post['cat'] . "',  course_ext_id='" . $post['ext'] . "',title='" . addslashes($post['title']) . "', hours='" . $post['hours'] . "',description='" . addslashes($post['description']) . "',
           price='" . $post['price'] . "' $mat $publish
           WHERE id='$id'";
        $this->db->setQuery($query);
        $this->db->query();
        return 'Course Updated';
    }

    public function publishCourse($p, $id) {
        if ($p == 2) {
            $p = 0;
        }
        $query = "UPDATE courses SET publish='$publish' WHERE id='$id'";
        $this->db->setQuery($query);
        $this->db->query();
        return 'Course Updated';
    }

    public function newCourse($post) {


        $material = $this->uploadFile($post['material'], '/components/com_myaccount/uploads/courses/');
        if ($material != 'ERROR NO FILE') {
            $mat = "material='$material', ";
        } else {
            $mat = '';
        }
        $query = "INSERT INTO  courses 
           SET cat='" . $post['cat'] . "', course_ext_id='" . $post['ext'] . "', title='" . addslashes($post['title']) . "', hours='" . $post['hours'] . "',price='" . $post['price'] . "',description='" . addslashes($post['description']) . "', $mat publish='" . $post['publish'] . "'";
        $this->db->setQuery($query);
        $this->db->query();
        return 'Course "' . $post['title'] . '" created';
    }

    public function uploadFile($input, $location) {
        //import joomlas filesystem functions, we will do all the filewriting with joomlas functions,
//so if the ftp layer is on, joomla will write with that, not the apache user, which might
//not have the correct permissions
        jimport('joomla.filesystem.file');
        jimport('joomla.filesystem.folder');

//this is the name of the field in the html form, filedata is the default name for swfupload
//so we will leave it as that
        $fieldName = 'material';

//any errors the server registered on uploading
        $fileError = $_FILES[$fieldName]['error'];
        if ($fileError > 0) {
            switch ($fileError) {
                case 1:
                    echo JText::_('FILE TO LARGE THAN PHP INI ALLOWS');
                    return JText::_('FILE TO LARGE THAN PHP INI ALLOWS');

                case 2:
                    echo JText::_('FILE TO LARGE THAN HTML FORM ALLOWS');
                    return JText::_('FILE TO LARGE THAN HTML FORM ALLOWS');

                case 3:
                    echo JText::_('ERROR PARTIAL UPLOAD');
                    return JText::_('ERROR PARTIAL UPLOAD');

                case 4:
                    echo JText::_('ERROR NO FILE');
                    return JText::_('ERROR NO FILE');
            }
        }
//print_r($_FILES);
//check for filesize
        $fileSize = $_FILES[$fieldName]['size'];
        if ($fileSize > 20000000000) {
            echo JText::_('FILE BIGGER THAN 2MB');
        }

//check the file extension is ok
        $fileName = $_FILES[$fieldName]['name'];
        $uploadedFileNameParts = explode('.', $fileName);
        $uploadedFileExtension = array_pop($uploadedFileNameParts);

        $validFileExts = explode(',', 'jpeg,jpg,png,gif,JPG,pdf');

//assume the extension is false until we know its ok
        $extOk = false;

//go through every ok extension, if the ok extension matches the file extension (case insensitive)
//then the file extension is ok
        foreach ($validFileExts as $key => $value) {
            if (preg_match("/$value/i", $uploadedFileExtension)) {
                $extOk = true;
            }
        }

        if ($extOk == false) {
            echo JText::_('INVALID EXTENSION');
            return JText::_('INVALID EXTENSION') . ' -' . $uploadedFileExtension . $fileName;
        }

//the name of the file in PHP's temp directory that we are going to move to our folder
        $fileTemp = $_FILES[$fieldName]['tmp_name'];

//lose any special characters in the filename
        $fileName = preg_replace("/[^A-Za-z0-9]/i", ".", $fileName);
        $date = date('ymdhis');
//always use constants when making file paths, to avoid the possibilty of remote file inclusion
        $uploadPath = JPATH_SITE . $location . $date . '.' . $fileName;
        $uploadPath2 = $location . $date . '.' . $fileName;
        if (!JFile::upload($fileTemp, $uploadPath)) {
            echo JText::_('ERROR MOVING FILE');
            return 'Failed';
        } else {

            return $uploadPath2;
            // success, exit with code 0 for Mac users, otherwise they receive an IO Error
            exit(0);
        }
    }

}

