<?php

include("../../../../app/conf/config.inc.php");
extract($_GET);
extract($_POST);
$obj_user = new userModel();
$mobile = trim($mobile);
$Mobile = trim($Mobile);


if (isset($mobile)) {
    if (strtolower($mobile) == strtolower($Mobile)) {
        echo false;
    } else {
        $result = $obj_user->checkAlreadyExist($obj_user->tableName(), 'phone_number', $mobile);
        if ($result) {
            echo true;
        } else {
            echo false;
        }
    }
}

?>
