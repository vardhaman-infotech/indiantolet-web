<?php

/*
 * Paging
 */
// Add config file
include_once("../../../../app/conf/config.inc.php");
// Module object
$obj_emails = new emailsModel();

// Define Sort order column names
if ($_POST['order'][0]['column'] == '1') {
    $orderBy = $obj_emails->getPrimaryKey($obj_emails->tableName());
    $orderBy = $orderBy . ' ' . $_POST['order'][0]['dir'];
} elseif ($_POST['order'][0]['column'] == '2') {
    $orderBy = 'email_for';
    $orderBy = $orderBy . ' ' . $_POST['order'][0]['dir'];
} elseif ($_POST['order'][0]['column'] == '3') {
    $orderBy = 'email_subject';
    $orderBy = $orderBy . ' ' . $_POST['order'][0]['dir'];
// }elseif ($_POST['order'][0]['column'] == '4') {
//    $orderBy = 'is_active';
//    $orderBy = $orderBy . ' ' . $_POST['order'][0]['dir'];
}elseif ($_POST['order'][0]['column'] == '4') {
    $orderBy = 'created_date';
    $orderBy = $orderBy . ' ' . $_POST['order'][0]['dir'];
} elseif ($_POST['order'][0]['column'] == '5') {
    $orderBy = "";
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
    if ($length == -1) {
        $limit = '';
    } else {
        $limit = $start . ',' . $length;
    }
    $emails = $data_emails = $obj_emails->selectLimit($limit, '', '*', $orderBy);
    $iTotalRecords = count($data_emails = $obj_emails->select('', '', '*', $orderBy));
// Group action condtion    
} elseif (isset($customActionType) && $customActionType != '') {
    if (isset($customActionName) && $customActionName == EMAILS_ACTIVE) {
        $dataArr = array("is_active" => EMAILS_ACTIVE);
        $obj_emails->attributes = $dataArr;
        $obj_emails->updateAllByPk($id, $obj_emails->attributes, "email_id");
    } elseif (isset($customActionName) && $customActionName == EMAILS_DEACTIVE) {
        $dataArr = array("is_active" => EMAILS_DEACTIVE);
        $obj_emails->attributes = $dataArr;
        $obj_emails->updateAllByPk($id, $obj_emails->attributes, "email_id");
    } elseif (isset($customActionName) && $customActionName == EMAILS_DELETE) {
        $obj_emails->deleteAllByPk_status($id, "email_id");
    }
   if ($length == -1) {
        $limit = '';
    } else {
        $limit = $start . ',' . $length;
    }
    $emails = $data_emails = $obj_emails->selectLimit($limit, '', '*', $orderBy);
    $iTotalRecords = count($data_emails = $obj_emails->select('', '', '*', $orderBy));
} elseif (isset($action) && $action != '') {

   if ($length == -1) {
        $limit = '';
    } else {
        $limit = $start . ',' . $length;
    }

// Search condition 
    $condition = '';
    if (isset($status) && $status != '') {
        $condition .= ' is_active = "' . $status . '" and';
    }
    if (isset($email_for) && !empty($email_for)) {
        $condition .= ' email_for  LIKE "%' . $email_for . '%" and';
    }
    if (isset($email_subject) && !empty($email_subject)) {
        $condition .= ' email_subject LIKE "%' . $email_subject . '%" and';
    }
    if (isset($primary_id) && !empty($primary_id)) {
        $condition .= ' email_id = "' . $primary_id . '" and';
    }
    if (isset($created_date) && !empty($created_date)) {
        $condition .= ' created_date LIKE "%' . $created_date . '%" and';
    }  

    $condition = rtrim($condition, " and ");
   


    // Check if condition blank or not
    if ($condition == '') {
       if ($length == -1) {
            $Condition_limit = '';
        } else {
            $Condition_limit = $limit;
        }
        $emails = $data_emails = $obj_emails->selectLimit($Condition_limit, '', '*', $orderBy);
    } else {
        if ($length == -1) {
            $limit = ' ';
        } else {
            $limit = ' limit ' . $limit;
        }
        $emails = $data_emails = $obj_emails->select($condition, '', '*', $orderBy . $limit);

       
    }

    $iTotalRecords = count($data_emails = $obj_emails->select($condition, '', '*', $orderBy));
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
foreach ($emails as $value) {
//echo $i;
    // Status condition
    // $categoryDetail = $obj_category->selectByPk($value->category_id,'','category_name');
    if ($value->is_active == '0') {
        $status = array("success" => "Not Published");
    } else {
        $status = array("info" => "Published");
    }


    $records["data"][] = array(
       // '<input type="checkbox" name="id[]" value="' . $value->email_id . '">',
        $value->email_id,
        $value->email_for,
        $value->email_subject,
//        '<span class="label label-sm label-' . (key($status)) . '">' . (current($status)) . '</span>',
        $value->created_date,
        '<a href="' . ADMIN_URL . '/emails.php?action=editEmails&emailsId=' . encode($value->email_id) . '" class="btn default btn-xs purple"><i class="fa fa-edit"></i></a>',
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