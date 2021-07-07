<?php

include("../../../../app/conf/config.inc.php");
extract($_GET);
extract($_POST);
$obj_owner = new ownerModel();
$mobile = trim($mobile);
$Mobile = trim($Mobile);


if (isset($mobile)) {
    if (strtolower($mobile) == strtolower($Mobile)) {
        echo false;
    } else {
        $result = $obj_owner->checkAlreadyExist($obj_owner->tableName(), 'phone_number', $mobile);
        if ($result) {
            echo true;
        } else {
            echo false;
        }
    }
}

?>
