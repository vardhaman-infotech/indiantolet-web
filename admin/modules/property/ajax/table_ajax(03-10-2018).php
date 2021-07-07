<?php

/*
 * Paging
 */
// Add config file
include_once("../../../../app/conf/config.inc.php");
// Module object
$obj_property = new propertyModel();
$obj_payment = new paymentModel();

// Define Sort order column names
if ($_POST['order'][0]['column'] == '1') {
    $orderBy = $obj_property->getPrimaryKey($obj_property->tableName());
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
    if ($length == -1) {
        $limit = '';
    } else {
        $limit = $start . ',' . $length;
    }

    $property = $data_property = $obj_property->selectLimit($limit, '', '*', $orderBy, '');
    $iTotalRecords = count($data_property = $obj_property->select('', '', '*', $orderBy));
// Group action condtion    
} elseif (isset($customActionType) && $customActionType != '') {
    if (isset($customActionName) && $customActionName == PROPERTY_ACTIVE) {
        $dataArr = array("is_active" => PROPERTY_ACTIVE);
        $obj_property->attributes = $dataArr;
        $obj_property->updateAllByPk($id, $obj_property->attributes, "id");
    } elseif (isset($customActionName) && $customActionName == PROPERTY_DEACTIVE) {
        $dataArr = array("is_active" => PROPERTY_DEACTIVE);
        $obj_property->attributes = $dataArr;
        $obj_property->updateAllByPk($id, $obj_property->attributes, "id");
    } elseif (isset($customActionName) && $customActionName == PROPERTY_DELETE) {
        $obj_property->deleteAllByPk($id, "id");
    }
    if ($length == -1) {
        $limit = '';
    } else {
        $limit = $start . ',' . $length;
    }
    $property = $data_property = $obj_property->selectLimit($limit, '', '*', $orderBy, '');
    $iTotalRecords = count($data_property = $obj_property->select('', '', '*', $orderBy));
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
    if (isset($first_name) && !empty($first_name)) {
        $condition .= ' name LIKE "%' . $first_name . '%" and';
    }

    if (isset($email_id) && !empty($email_id)) {
        $condition .= ' email_id LIKE "%' . $email_id . '%" and';
    }
    if (isset($property_type_id) && !empty($property_type_id)) {
        $condition .= ' property_type_id = "' . $property_type_id . '" and';
    }
    if (isset($owner_id) && !empty($owner_id)) {
        $condition .= ' owner_id = "' . $owner_id . '" and';
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
        $property = $data_property = $obj_property->selectLimit($Condition_limit, '', '*', $orderBy, '');
    } else {
        if ($length == -1) {
            $limit = '';
        } else {
            $limit = ' limit ' . $limit;
        }
        $property = $data_property = $obj_property->select($condition, '', '*', $orderBy . $limit);
        //print_r($obj_property);die;
    }
    $iTotalRecords = count($data_property = $obj_property->select($condition, '', '*', $orderBy));
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
//print_r($property);die;
foreach ($property as $value) {
//For get property payment
    $GetPayment = $obj_payment->select('property_id=' . $value->id);

    if ($value->is_active == '0') {
        $status = array("success" => "Not Published");
    } else {
        $status = array("info" => "Published");
    }


    $records["data"][] = array(
        '<input type="checkbox" name="id[]" value="' . $value->id . '">',
        $value->id,
        $value->name,
        valueNamePrimary('property_typeModel', $value->property_type_id, 'name'),
        valueNamePrimary('ownerModel', $value->owner_id, 'name'),
        $value->property_area,
        $value->location,
        $value->property_rent,
       
        '<span class="btn btn-xs btn-' . (key($status)) . '">' . (current($status)) . '</span>',
        $value->created_date,
        //  '<a href="' . ADMIN_URL . '/property.php?action=editProperty_type&propertyId=' . encode($value->id) . '" class="btn default btn-xs purple"><i class="fa fa-edit"></i></a>'
        // . '<a href="' . ADMIN_URL . '/property.php?action=delete&propertyId=' . encode($value->id) . '" class="btn default btn-xs black  btn-danger"  id="delete_one"><i class="fa fa-trash-o"></i> </a>',
        '<a href="' . ADMIN_URL . '/property.php?action=viewProperty&propertyId=' . encode($value->id) . '" class="btn default btn-xs blue"  id="delete_one"><i class="fa fa-eye"></i></a>',
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