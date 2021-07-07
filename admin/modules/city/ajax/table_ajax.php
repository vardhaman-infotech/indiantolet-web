<?php

/*
 * Paging
 */
// Add config file
include_once("../../../../app/conf/config.inc.php");
// Module object
$obj_city = new cityModel();

// Define Sort order column names

if ($_POST['order'][0]['column'] == '1') {
    $orderBy = $obj_city->getPrimaryKey($obj_city->tableName());
    $orderBy = $orderBy . ' ' . $_POST['order'][0]['dir'];
} elseif ($_POST['order'][0]['column'] == '2') {
    $orderBy = 'name';
    $orderBy = $orderBy . ' ' . $_POST['order'][0]['dir'];
} elseif ($_POST['order'][0]['column'] == '3') {
    $orderBy = 'is_active';
    $orderBy = $orderBy . ' ' . $_POST['order'][0]['dir'];
}
elseif ($_POST['order'][0]['column'] == '4') {
    $orderBy = 'created_date';
    $orderBy = $orderBy . ' ' . $_POST['order'][0]['dir'];
}

// Condition for check action and set action
if (isset($action) && !empty($action)) {
    $action = $action;
} else {
    $action = '';
}
// Condition for check customActionType and set or not(groupaction)
if (isset($customActionType) && !empty($customActionType)) {
    $customActionType = $customActionType;
} else {
    $customActionType = '';
}
// Condition for check customActionType and set or not(groupaction)
//if (isset($customActionType) && !empty($customActionType)) {
//    $customActionType = $customActionType;
//} else {
//    $customActionType = '';
//}


// First time load data table if action black and group action blank
if (empty($action) && $action == '' && empty($customActionType) && $customActionType == '') {
    $limit = $start . ',' . $length; 
    if($length== -1){
    $limit='';    
    }
    $city = $data_city = $obj_city->selectLimit($limit,'','*',$orderBy,'is_delete="0"');
    $iTotalRecords = count($data_city = $obj_city->select('is_delete="0"', '', '*', $orderBy));
// Group action condtion    
} elseif (isset($customActionType) && $customActionType != '') {

    if (isset($customActionName) && $customActionName == CITY_ACTIVE) {  
        $dataArr = array("is_active" => CITY_ACTIVE);
        $obj_city->attributes = $dataArr;
        $obj_city->updateAllByPk($id, $obj_city->attributes, "id"); 
    } elseif (isset($customActionName) && $customActionName == CITY_DEACTIVE) {   
        $dataArr = array("is_active" => CITY_DEACTIVE);
        $obj_city->attributes = $dataArr;
        $obj_city->updateAllByPk($id, $obj_city->attributes, "id");  
    } elseif (isset($customActionName) && $customActionName == CITY_DELETE) {  
        $obj_city->deleteAllByPk_status($id, "id");
    }
    
    $start = '0';
     if($length == -1){
       $limit=''; 
    }else{
        $limit = $start . ',' . $length;
    }
     
    $city = $data_city = $obj_city->selectLimit($limit,'','*',$orderBy,'is_delete="0"');
    $iTotalRecords = count($data_city = $obj_city->select('is_delete="0"', '', '*', $orderBy)); 
} elseif (isset($action) && $action != '') {

  if($length == -1){
       $limit=''; 
    }else{
        $limit = $start . ',' . $length;
    }
    

// Search condition 
    $condition = '';
    if (isset($status) && $status !='') {
        $condition .= ' is_active = "' . $status . '" and';
         
    }

    if (isset($name) && !empty($name)) {
        $condition .= ' name LIKE "%' . $name . '%" and';
    }

    if (isset($primary_id) && !empty($primary_id)) {
        $condition .= ' id = "' . $primary_id . '" and';
    }
     $condition .=' is_delete="0" and';
    $condition = rtrim($condition," and ");
        
     // Check if condition blank or not
    if ($condition == '') {
         if ($length == -1) {
            $Condition_limit = '';
        } else {
            $Condition_limit = $limit;
        }
        $city = $data_city = $obj_city->selectLimit($Condition_limit,'','*',$orderBy);
    } else {  
        if ($length == -1) {
             $limit=''; 
        } else {
            $limit = ' limit ' . $limit;
        }
        $city = $data_city = $obj_city->select($condition,'','*',$orderBy. $limit);
    }

    $iTotalRecords = count($data_city = $obj_city->select($condition,'','*',$orderBy));
}


//Default parmenters

$iDisplayLength = intval($length);
$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
$iDisplayStart = intval($_REQUEST['start']);
$sEcho = intval($_REQUEST['draw']);
$records = array();
$records["data"] = array();
$end = $iDisplayStart + $iDisplayLength;
$end = $end > $iTotalRecords ? $iTotalRecords : $end;

// set the record in columns
//for ($i = $iDisplayStart; $i < $end; $i++) {
$i = 0;
//echo'<pre>';print_r($city);die;
foreach ($city as $value) {
//echo $i;
    // Status condition

    if ($value->is_active == '0') {
        $status = array("success" => "Not Published");
    } else {
        $status = array("info" => "Published");
    }


    $records["data"][] = array(
        '<input type="checkbox" name="id[]" value="' . $value->id . '">',
        $value->id,
        $value->name,
                
        '<span class="label label-sm label-' . (key($status)) . '">' . (current($status)) . '</span>',
        $value->created_date,
        '<a href="' . ADMIN_URL . '/city.php?action=editCity&cityId=' . encode($value->id) . '" class="btn default btn-xs purple"><i class="fa fa-edit"></i></a>'
        . '<a href="' . ADMIN_URL . '/city.php?action=delete&cityId=' . encode($value->id) . '" class="btn default btn-xs black  btn-danger"  id="delete_one"><i class="fa fa-trash-o"></i></a>'
//       . '<a href="' . ADMIN_URL . '/subcity.php?cityId=' . encode($value->id) . '" class="btn default btn-xs green"><i class="fa fa-plus-square"></i> Subcity</a>',
    );
    $i++;
}



if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
    $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
    $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
}

$records["draw"] = $sEcho;
$records["recordsTotal"] = $iTotalRecords;
$records["recordsFiltered"] = $iTotalRecords;
echo json_encode($records);
?>