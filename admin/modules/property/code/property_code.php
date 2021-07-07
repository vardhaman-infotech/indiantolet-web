<?php

# Coder : Ankit Sharma
# Date  : 21-Dec-2017

$currentTimestamp = getCurrentTimestamp();
$obj_property = new propertyModel();


if (isset($propertyId))
    $propertyId = decode($propertyId);
if (isset($action) && trim($action) == "submitForm") {
    if (isset($actionType) && $actionType == PROPERTY_ACTIVE) {
        $dataArr = array("is_active" => PROPERTY_ACTIVE);
        $obj_property->attributes = $dataArr;
        $obj_property->updateAllByPk($chk, $obj_property->attributes, "id");
        $_SESSION['successMsg'] = PROPERTY_ALL_SUCCESS_ACTIVATE_MESSAGE;
        header("location:" . ADMIN_URL . "/property.php");
        exit();
    } elseif (isset($actionType) && $actionType == PROPERTY_DEACTIVE) {
        $dataArr = array("is_active" => PROPERTY_DEACTIVE);
        $obj_property->attributes = $dataArr;
        $obj_property->updateAllByPk($chk, $obj_property->attributes, "id");
        $_SESSION['successMsg'] = PROPERTY_ALL_SUCCESS_DEACTIVATE_MESSAGE;
        header("location:" . ADMIN_URL . "/property.php");
        exit();
    } elseif (isset($actionType) && $actionType == PROPERTY_DELETE) {
        $obj_property->deleteAllByPk($chk, "id");
        $_SESSION['successMsg'] = PROPERTY_ALL_SUCCESS_DELETE_MESSAGE;
        header("location:" . ADMIN_URL . "/property.php");
        exit();
    }
} elseif (isset($action) && $action == "viewProperty") { 
    ////////////Show Data For Edit Time
    if (isset($propertyId) && $propertyId != "" && $action == "viewProperty") {
        $property = $obj_property->selectByPk($propertyId);
        $property = (array) $property;
        extract($property);
    }
} elseif (isset($action) && trim($action) == "activateProperty" && $propertyId != "") {
    $dataArr = array("is_active" => PROPERTY_ACTIVE);
    $obj_property->attributes = $dataArr;
    $obj_property->update($obj_property->attributes, "id=" . $propertyId);
    $_SESSION['successMsg'] = PROPERTY_SUCCESS_ACTIVATE_MESSAGE;
    header("location:" . ADMIN_URL . "/property.php");
    exit();
} elseif (isset($action) && $action == "deActivateProperty" && $propertyId != "") {
    $dataArr = array("is_active" => PROPERTY_DEACTIVE);
    $obj_property->attributes = $dataArr;
    $obj_property->update($obj_property->attributes, "id=" . $propertyId);
    $_SESSION['successMsg'] = PROPERTY_SUCCESS_DEACTIVATE_MESSAGE;
    header("location:" . ADMIN_URL . "/property.php");
    exit();
} elseif (isset($action) && $action == "delete" && $propertyId != "") {
    $obj_property->delete("id=" . $propertyId);
    $_SESSION['successMsg'] = PROPERTY_SUCCESS_DELETE_MESSAGE;
    header("location:" . ADMIN_URL . "/property.php");
    exit();
} else {
    $data_property = $obj_property->select('');
}
?>