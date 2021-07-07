<?php
/*
 * Paging
 */
// Add config file
include_once("../../../../app/conf/config.inc.php");
// Module object
$obj_user = new userModel();

// Define Sort order column names
if ($_POST['order'][0]['column'] == '1') {    
    $orderBy = $obj_user->getPrimaryKey($obj_user->tableName());
    $orderBy = $orderBy . ' ' . $_POST['order'][0]['dir'];
} elseif ($_POST['order'][0]['column'] == '2') {
    $orderBy = 'name';    
     $orderBy = $orderBy . ' ' . $_POST['order'][0]['dir'];
} 
elseif ($_POST['order'][0]['column'] == '3') {
    $orderBy = 'email_id';
     $orderBy = $orderBy . ' ' . $_POST['order'][0]['dir'];
} elseif ($_POST['order'][0]['column'] == '4') {
    $orderBy = 'phone_number';
     $orderBy = $orderBy . ' ' . $_POST['order'][0]['dir'];
}elseif ($_POST['order'][0]['column'] == '5') {
    $orderBy = 'user_otp';
     $orderBy = $orderBy . ' ' . $_POST['order'][0]['dir'];
} elseif ($_POST['order'][0]['column'] == '6') {
    $orderBy = 'is_active';
    $orderBy = $orderBy . ' ' . $_POST['order'][0]['dir'];
} elseif ($_POST['order'][0]['column'] == '7') {
    $orderBy = 'created_date';
    $orderBy = $orderBy . ' ' . $_POST['order'][0]['dir'];
} elseif ($_POST['order'][0]['column'] == '8') {
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
    
    $user = $data_user = $obj_user->selectLimit($limit, '', '*', $orderBy,'');
    $iTotalRecords = count($data_user = $obj_user->select('', '', '*', $orderBy));
// Group action condtion    
} elseif (isset($customActionType) && $customActionType != '') {
    if (isset($customActionName) && $customActionName == USER_ACTIVE) {
        $dataArr = array("is_active" => USER_ACTIVE);
        $obj_user->attributes = $dataArr;
        $obj_user->updateAllByPk($id, $obj_user->attributes, "id");
    } elseif (isset($customActionName) && $customActionName == USER_DEACTIVE) {
        $dataArr = array("is_active" => USER_DEACTIVE);
        $obj_user->attributes = $dataArr;
        $obj_user->updateAllByPk($id, $obj_user->attributes, "id");
    } elseif (isset($customActionName) && $customActionName == USER_DELETE) {
        $obj_user->deleteAllByPk($id, "id");
    }
    if($length == -1){
       $limit=''; 
    }else{
        $limit = $start . ',' . $length;
    }
    $user = $data_user = $obj_user->selectLimit($limit, '', '*', $orderBy,'');
    $iTotalRecords = count($data_user = $obj_user->select('','', '*', $orderBy));
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
    if (isset($user_otp) && !empty($user_otp)) {
        $condition .= ' user_otp = "' . $user_otp . '" and';
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
        $user = $data_user = $obj_user->selectLimit($Condition_limit, '', '*', $orderBy,'');
    } else {
        if ($length == -1) {
             $limit=''; 
        } else {
            $limit = ' limit ' . $limit;
        }
        $user = $data_user = $obj_user->select($condition, '', '*', $orderBy . $limit );
       //print_r($obj_user);die;
    }
    $iTotalRecords = count($data_user = $obj_user->select($condition, '', '*', $orderBy));
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
//print_r($user);die;
foreach ($user as $value) {

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
        $value->email_id, 
        $value->phone_number,  
        $value->user_otp,  
        '<span class="btn btn-xs btn-' . (key($status)) . '">' . (current($status)) . '</span>',
        $value->created_date,
        '<a href="' . ADMIN_URL . '/users.php?action=editUser&userId=' . encode($value->id) . '" class="btn default btn-xs purple"><i class="fa fa-edit"></i></a>'
        . '<a href="' . ADMIN_URL . '/users.php?action=delete&userId=' . encode($value->id) . '" class="btn default btn-xs black  btn-danger"  id="delete_one"><i class="fa fa-trash-o"></i> </a>',
       // . '<a href="' . ADMIN_URL . '/users.php?action=viewUser&userId=' . encode($value->id) . '" class="btn default btn-xs blue"  id="delete_one"><i class="fa fa-eye"></i></a>',
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