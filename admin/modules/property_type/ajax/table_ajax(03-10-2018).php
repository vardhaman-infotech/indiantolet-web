<?php
/*
 * Paging
 */
// Add config file
include_once("../../../../app/conf/config.inc.php");
// Module object
$obj_property_type = new property_typeModel();

// Define Sort order column names
if ($_POST['order'][0]['column'] == '1') {    
    $orderBy = $obj_property_type->getPrimaryKey($obj_property_type->tableName());
    $orderBy = $orderBy . ' ' . $_POST['order'][0]['dir'];
} elseif ($_POST['order'][0]['column'] == '2') {
    $orderBy = 'name';    
     $orderBy = $orderBy . ' ' . $_POST['order'][0]['dir'];
} elseif ($_POST['order'][0]['column'] == '3') {
    $orderBy = 'is_active';
    $orderBy = $orderBy . ' ' . $_POST['order'][0]['dir'];
} elseif ($_POST['order'][0]['column'] == '4') {
    $orderBy = 'created_date';
    $orderBy = $orderBy . ' ' . $_POST['order'][0]['dir'];
} elseif ($_POST['order'][0]['column'] == '5') {
    $orderBy = '';
   
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

// First time load data table if action black and group action blank
if (empty($action) && $action == '' && empty($customActionType) && $customActionType == '') {
    if($length == -1){
       $limit=''; 
    }else{
        $limit = $start . ',' . $length;
    }
    
    $property_type = $data_property_type = $obj_property_type->selectLimit($limit, '', '*', $orderBy,'');
    $iTotalRecords = count($data_property_type = $obj_property_type->select('', '', '*', $orderBy));
// Group action condtion    
} elseif (isset($customActionType) && $customActionType != '') {
    if (isset($customActionName) && $customActionName == PROPERTY_TYPE_ACTIVE) {
        $dataArr = array("is_active" => PROPERTY_TYPE_ACTIVE);
        $obj_property_type->attributes = $dataArr;
        $obj_property_type->updateAllByPk($id, $obj_property_type->attributes, "id");
    } elseif (isset($customActionName) && $customActionName == PROPERTY_TYPE_DEACTIVE) {
        $dataArr = array("is_active" => PROPERTY_TYPE_DEACTIVE);
        $obj_property_type->attributes = $dataArr;
        $obj_property_type->updateAllByPk($id, $obj_property_type->attributes, "id");
    } elseif (isset($customActionName) && $customActionName == PROPERTY_TYPE_DELETE) {
        $obj_property_type->deleteAllByPk($id, "id");
    }
    if($length == -1){
       $limit=''; 
    }else{
        $limit = $start . ',' . $length;
    }
    $property_type = $data_property_type = $obj_property_type->selectLimit($limit, '', '*', $orderBy,'');
    $iTotalRecords = count($data_property_type = $obj_property_type->select('','', '*', $orderBy));
} elseif (isset($action) && $action != '') {

    if($length == -1){
       $limit=''; 
    }else{
        $limit = $start . ',' . $length;
    }
    // Search condition 
    $condition = '';
   

    if (isset($status) && $status != '') {
        $condition .= ' is_active = "' . $status . '" and';
    }
    if (isset($first_name) && !empty($first_name)) {
        $condition .= ' name LIKE "%' . $first_name . '%" and';
    }
    
    if (isset($email_id) && !empty($email_id)) {
        $condition .= ' email_id LIKE "%' . $email_id . '%" and';
    }
    if (isset($phone_number) && !empty($phone_number)) {
        $condition .= ' phone_number = "' . $phone_number . '" and';
    }
    if (isset($created_date) && !empty($created_date)) {
        $condition .= ' created_date LIKE "%' . $created_date . '%" and';
    }
    if (isset($primary_id) && !empty($primary_id)) {
        $condition .= ' id = "' . $primary_id . '" and';
    }
  

//print_r($condition);die;

    
    $condition = rtrim($condition, " and ");
    // Check if condition blank or not
    if ($condition == '') {
        if ($length == -1) {
            $Condition_limit = '';
        } else {
            $Condition_limit = $limit;
        }
        $property_type = $data_property_type = $obj_property_type->selectLimit($Condition_limit, '', '*', $orderBy,'');
    } else {
        if ($length == -1) {
             $limit=''; 
        } else {
            $limit = ' limit ' . $limit;
        }
        $property_type = $data_property_type = $obj_property_type->select($condition, '', '*', $orderBy . $limit );
       //print_r($obj_property_type);die;
    }
    $iTotalRecords = count($data_property_type = $obj_property_type->select($condition, '', '*', $orderBy));
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
$i = 0;
//print_r($property_type);die;
foreach ($property_type as $value) {

    // $stateDetail = getstate($value->state_id);
    // $countryDetail = getcountry($value->country_id);
   
    if ($value->is_active == '0') {
        $status = array("success" => "Not Published");
    } else {
        $status = array("info" => "Published");
    }
    

    $records["data"][] = array(
        '<input type="checkbox" name="id[]" value="' . $value->id . '">',
        $value->id,
        $value->name,   
        '<span class="btn btn-xs btn-' . (key($status)) . '">' . (current($status)) . '</span>',
        $value->created_date,
        '<a href="' . ADMIN_URL . '/property_type.php?action=editProperty_type&property_typeId=' . encode($value->id) . '" class="btn default btn-xs purple"><i class="fa fa-edit"></i></a>'
        . '<a href="' . ADMIN_URL . '/property_type.php?action=delete&property_typeId=' . encode($value->id) . '" class="btn default btn-xs black  btn-danger"  id="delete_one"><i class="fa fa-trash-o"></i> </a>',
       // . '<a href="' . ADMIN_URL . '/property_type.php?action=viewProperty_type&property_typeId=' . encode($value->id) . '" class="btn default btn-xs blue"  id="delete_one"><i class="fa fa-eye"></i></a>',
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