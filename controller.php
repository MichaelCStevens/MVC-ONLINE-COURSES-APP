<?php

/**

 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');

/**
 * Paybook Component Controller
 */
class myaccountController extends JControllerLegacy {

    static function buildHeader($x) {
        
          $html=" <link type='text/css' href='components/com_myaccount/style.css' rel='stylesheet'/><ul>";
          $html.="<li"; if($x==1){$html.=" class='selected'";}$html.="><a href='index.php?option=com_myaccount'>Management  Summary</a></li>";
          $html.="<li"; if($x==2){$html.=" class='selected'";}$html.="><a href='index.php?option=com_myaccount&view=courses'>Courses</a></li>";
          $html.="<li"; if($x==2){$html.=" class='selected'";}$html.="><a href='index.php?option=com_myaccount&view=seminars'>Live Courses</a></li>";
          $html.="<li"; if($x==3){$html.=" class='selected'";}$html.="><a href='index.php?option=com_myaccount&view=certificates'>Certificates</a></li>";
          $html.="<li"; if($x==4){$html.=" class='selected'";}$html.="><a href='index.php?option=com_myaccount&view=study'>Study Material</a></li>";
          $html.="<li"; if($x==5){$html.=" class='selected'";}$html.="><a href='index.php?option=com_myaccount&view=exams'>Exams</a></li>";
          $html.="<li"; if($x==6){$html.=" class='selected'";}$html.="><a href='index.php?option=com_myaccount&view=users'>Users</a></li>";
          $html.="<li"; if($x==7){$html.=" class='selected'";}$html.="><a href='index.php?option=com_myaccount&view=orders'>Orders</a></li>";
          $html.="<li"; if($x==8){$html.=" class='selected'";}$html.="><a href='index.php?option=com_myaccount&view=coupons'>Coupons</a></li>";
          $html.="<li"; if($x==9){$html.=" class='selected'";}$html.="><a href='index.php?option=com_myaccount&view=reports'>Reports</a></li>";
          $html.="</ul>";

        return $html;
    } 
}

