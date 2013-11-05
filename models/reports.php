<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

/**
 * Paybook Model
 */
class myaccountModelreports extends JModelItem {

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

    public function getReportRecords($type,$start,$end) {
        if ($type == 1) {
            return $this->getReportQuiz($start,$end);
        } else {
            return $this->getReportPurchases($start,$end);
        }
    }

    public function getReportQuiz($start,$end) {
             $whereExt='';
        if($start!=''){
             $whereExt.=" AND d.completed_date >= '$start'";
        }
         if($end!=''){
            $whereExt.=" AND d.completed_date <= '$end'";
         }
        $query = "SELECT * FROM  exam_scores as a
           LEFT JOIN courses as b on a.course_id=b.id
           LEFT JOIN user_info as c on a.user_id=c.user_id
           LEFT JOIN courses_users as d on a.user_id=d.user_id AND a.course_id=d.course_id
           WHERE d.completed_date!='' $whereExt;";
         echo $query;
        $this->db->setQuery($query);
        $result = $this->db->loadObjectList();
        return $result;
    }

    public function getReportPurchases($start,$end) {
         $whereExt='';
        if($start!=''){
             $whereExt.=" AND a.date >= '$start'";
        }
         if($end!=''){
            $whereExt.=" AND a.date <= '$end'";
         }
        $query = "SELECT * FROM  orders as a
           LEFT JOIN order_items as b on a.id=b.order_id
           LEFT JOIN user_info as c on a.user_id=c.user_id
           LEFT JOIN courses_users as d on a.user_id=d.user_id AND b.item_id=d.course_id
           WHERE d.completed_date!='' $whereExt;";
        //  echo $query;
        $this->db->setQuery($query);
        $result = $this->db->loadObjectList();
        return $result;
    }

    public function exportPurchaseResults($lastReport) {

        /** PHPExcel */
        include 'Classes/PHPExcel.php';

        /** PHPExcel_Writer_Excel2007 */
        include 'Classes/PHPExcel/Writer/Excel2007.php';

// Create new PHPExcel object
//        echo date('H:i:s') . " Create new PHPExcel object\n";
        $objPHPExcel = new PHPExcel();

// Set properties
//        echo date('H:i:s') . " Set properties\n";
        $objPHPExcel->getProperties()->setCreator("ADVFundamentals");
        $objPHPExcel->getProperties()->setLastModifiedBy("ADVFundamentals");
        $objPHPExcel->getProperties()->setTitle("ADVFundamentals Report" . $now);
        $objPHPExcel->getProperties()->setSubject("ADVFundamentals Report" . $now);
        $objPHPExcel->getProperties()->setDescription("ADVFundamentals Report");


// Add some data
//        echo date('H:i:s') . " Add some data\n";
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Phone');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Address');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'City');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'State');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'State license issued in');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'State Licens #');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'State Licens #2');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'State Licens #3');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Purchase Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Course Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Course #');
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Completion Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Price Paid');
        $counter = 1;
        $xx = 1;
        foreach ($lastReport as $row) {
            $lics = base64_decode($row->lic_number);
            $lics = json_decode($lics);
            $lic1 = $lics[0];
            $lic2 = $lics[1];
            $lic3 = $lics[2];
            $xx++;
            $counter++;
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $counter, $row->first .' '.$row->last );
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $counter, $row->email);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $counter, $row->phone);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $counter, $row->street1 . ' ' . $row->street2);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $counter, $row->city);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $counter, $row->state);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $counter, 'Florida');
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $counter, $lic1);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $counter, $lic2);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $counter, $lic3);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $counter, $row->date);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $counter, $row->title);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $counter, $row->item_id);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $counter, $row->completed_date);
            $objPHPExcel->getActiveSheet()->SetCellValue('O' . $counter, $row->price);
        }


//// Rename sheet
//        echo date('H:i:s') . " Rename sheet\n";
//        $objPHPExcel->getActiveSheet()->setTitle('Simple');
// Save Excel 2007 file
//        echo date('H:i:s') . " Write to Excel2007 format\n";
        $date = date('YmdHis');
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save(str_replace('.php', '-' . $date . '.xlsx', __FILE__));
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');

// It will be called file.xls
        header('Content-Disposition: attachment; filename="ADVFundamentalsPurchaseReport.xlsx"');

// Write file to the browser
        ob_get_clean();
        echo file_get_contents(dirname(__FILE__).'\reports-' . $date . '.xlsx');
        ob_end_flush();
// Echo done
    }

    
    
    
        public function exportQuizResults($lastReport) {

        /** PHPExcel */
        include 'Classes/PHPExcel.php';

        /** PHPExcel_Writer_Excel2007 */
        include 'Classes/PHPExcel/Writer/Excel2007.php';

// Create new PHPExcel object
//        echo date('H:i:s') . " Create new PHPExcel object\n";
        $objPHPExcel = new PHPExcel();

// Set properties
//        echo date('H:i:s') . " Set properties\n";
        $objPHPExcel->getProperties()->setCreator("ADVFundamentals");
        $objPHPExcel->getProperties()->setLastModifiedBy("ADVFundamentals");
        $objPHPExcel->getProperties()->setTitle("ADVFundamentals Report" . $now);
        $objPHPExcel->getProperties()->setSubject("ADVFundamentals Report" . $now);
        $objPHPExcel->getProperties()->setDescription("ADVFundamentals Report");


// Add some data
//        echo date('H:i:s') . " Add some data\n";
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Phone');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Course Completed Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Provider #');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Course #');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'State Licens #');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'State Licens #2');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'State Licens #3');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Date of Completion');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Score');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'State license issued in'); 
        $counter = 1;
        $xx = 1;
        foreach ($lastReport as $row) {
            $lics = base64_decode($row->lic_number);
            $lics = json_decode($lics);
            $lic1 = $lics[0];
            $lic2 = $lics[1];
            $lic3 = $lics[2];
            $xx++;
            $counter++;
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $counter, $row->first .' '.$row->last );
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $counter, $row->email);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $counter, $row->phone);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $counter, $row->title);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $counter, '13930');
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $counter, $row->course_id);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $counter, $lic1);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $counter, $lic2);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $counter, $lic3);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $counter, $row->completed_date);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $counter, $row->score);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $counter, 'Florida'); 
        }


//// Rename sheet
//        echo date('H:i:s') . " Rename sheet\n";
//        $objPHPExcel->getActiveSheet()->setTitle('Simple');
// Save Excel 2007 file
//        echo date('H:i:s') . " Write to Excel2007 format\n";
        $date = date('YmdHis');
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save(str_replace('.php', '-' . $date . '.xlsx', __FILE__));
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');

// It will be called file.xls
        header('Content-Disposition: attachment; filename="ADVFundamentalsQuizReport.xlsx"');

// Write file to the browser
        ob_get_clean();
        echo file_get_contents(dirname(__FILE__).'\reports-' . $date . '.xlsx');
        ob_end_flush();
// Echo done
    }
}
