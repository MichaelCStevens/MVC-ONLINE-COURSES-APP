<?php

/**

 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

function grouppaybookBuildRoute(&$query) {
    $segments = array();
    //print_r($query);


    if (isset($query['view'])) {
        $segments[] = $query['view'];
        unset($query['view']);
    };


    if (isset($query['id'])) {
        $segments[] = $query['id'];
        unset($query['id']);
    };
    if (isset($query['action'])) {
        $segments[] = $query['action'];
        unset($query['action']);
    };
    if (isset($query['unique'])) {
        $segments[] = $query['unique'];
        unset($query['unique']);
    };

    //   echo "view: " . $item->query['action'];
    return $segments;
}

function grouppaybookParseRoute($segments) {
    //print_r($segments);
    $vars = array();
    $app = & JFactory::getApplication();
    $menu = & $app->getMenu();
    $item = & $menu->getActive();
    //print_r($menu);
    // Count segments
    $count = count($segments);
   // print_r($segments);
    //echo $count;
    //Handle View and Identifier
    // echo "view: " . $item->query['action'];
    switch ($segments[0]) {
        case 'grouppaybook':
            if ($count > 1) {
                $vars['action'] = str_replace(':', '-', $segments[1]);
            }
            break;
        case 'group':

            //print_r($segments[2]);
            $vars['view'] = 'group';

            if ($count > 1) {
                $vars['id'] = $segments[1];
            }
            if ($count > 2) {
                $vars['action'] = str_replace(':', '-', $segments[2]);
                $vars['unique'] = str_replace(':', '-', $segments[3]);
            }
       

            break;
        case 'CreateGroup':

            $vars['view'] = 'CreateGroup';
            break;
    }
    return $vars;
}
