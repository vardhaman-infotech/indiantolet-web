<?php

# Coder : Ankit Sharma
# Date  : 21-Dec-2017

$currentTimestamp = getCurrentTimestamp();
$obj_property_type = new property_typeModel();


if (isset($property_typeId))
    $property_typeId = decode($property_typeId);
if (isset($action) && trim($action) == "submitForm") {
    if (isset($actionType) && $actionType == PROPERTY_TYPE_ACTIVE) {
        $dataArr = array("is_active" => PROPERTY_TYPE_ACTIVE);
        $obj_property_type->attributes = $dataArr;
        $obj_property_type->updateAllByPk($chk, $obj_property_type->attributes, "id");
        $_SESSION['successMsg'] = PROPERTY_TYPE_ALL_SUCCESS_ACTIVATE_MESSAGE;
        header("location:" . ADMIN_URL . "/property_type.php");
        exit();
    } elseif (isset($actionType) && $actionType == PROPERTY_TYPE_DEACTIVE) {
        $dataArr = array("is_active" => PROPERTY_TYPE_DEACTIVE);
        $obj_property_type->attributes = $dataArr;
        $obj_property_type->updateAllByPk($chk, $obj_property_type->attributes, "id");
        $_SESSION['successMsg'] = PROPERTY_TYPE_ALL_SUCCESS_DEACTIVATE_MESSAGE;
        header("location:" . ADMIN_URL . "/property_type.php");
        exit();
    } elseif (isset($actionType) && $actionType == PROPERTY_TYPE_DELETE) {
        $obj_property_type->deleteAllByPk($chk, "id");
        $_SESSION['successMsg'] = PROPERTY_TYPE_ALL_SUCCESS_DELETE_MESSAGE;
        header("location:" . ADMIN_URL . "/property_type.php");
        exit();
    }
} elseif (isset($action) && ($action == "editProperty_type" || $action == "addProperty_type" || $action == "viewProperty_type")) {
    if (isset($submitProperty_type) && $submitProperty_type != "") {
        unset($_POST['submitProperty_type']);
        ///////////////Edit Form Data 
        if (isset($property_typeID) && $property_typeID != "" && $action == "editProperty_type") {


            /* For Change Password */
            $obj_property_type->attributes = $_POST;
            /* End Change password */
            $_POST['modification_date'] = $currentTimestamp;
            $obj_property_type->update($obj_property_type->attributes, "id=" . $property_typeID);
            $_SESSION['successMsg'] = PROPERTY_TYPE_SUCCESS_UPDATE_MESSAGE;
            header("location:" . ADMIN_URL . "/property_type.php");
            exit();

            ///////////////Add Form Data 
        } elseif ($action == "addProperty_type") {

            $obj_property_type->attributes = $_POST;
            $property_typeID = $obj_property_type->insert($obj_property_type->attributes);
            ///////End Code
            $_SESSION['successMsg'] = PROPERTY_TYPE_SUCCESS_ADD_MESSAGE;
            header("location:" . ADMIN_URL . "/property_type.php");
            exit();

            /////Show Message    
        }
    }
    ///////End
    ////////////Show Data For Edit Time
    if (isset($property_typeId) && $property_typeId != "" && ($action == "editProperty_type" || $action == "viewProperty_type")) {
        $property_type = $obj_property_type->selectByPk($property_typeId);
        $property_type = (array) $property_type;
        extract($property_type);
    }
} elseif (isset($action) && trim($action) == "activateProperty_type" && $property_typeId != "") {
    $dataArr = array("is_active" => PROPERTY_TYPE_ACTIVE);
    $obj_property_type->attributes = $dataArr;
    $obj_property_type->update($obj_property_type->attributes, "id=" . $property_typeId);
    $_SESSION['successMsg'] = PROPERTY_TYPE_SUCCESS_ACTIVATE_MESSAGE;
    header("location:" . ADMIN_URL . "/property_type.php");
    exit();
} elseif (isset($action) && $action == "deActivateProperty_type" && $property_typeId != "") {
    $dataArr = array("is_active" => PROPERTY_TYPE_DEACTIVE);
    $obj_property_type->attributes = $dataArr;
    $obj_property_type->update($obj_property_type->attributes, "id=" . $property_typeId);
    $_SESSION['successMsg'] = PROPERTY_TYPE_SUCCESS_DEACTIVATE_MESSAGE;
    header("location:" . ADMIN_URL . "/property_type.php");
    exit();
} elseif (isset($action) && $action == "delete" && $property_typeId != "") {
    $obj_property_type->delete("id=" . $property_typeId);
    $_SESSION['successMsg'] = PROPERTY_TYPE_SUCCESS_DELETE_MESSAGE;
    header("location:" . ADMIN_URL . "/property_type.php");
    exit();
} else {
    $data_property_type = $obj_property_type->select('');
}
?>