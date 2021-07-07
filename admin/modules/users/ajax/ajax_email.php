<?php

include("../../../../app/conf/config.inc.php");
extract($_GET);
extract($_POST);
$obj_user = new userModel();
$email = trim($email);
$Email = trim($Email);

if (isset($email)) {
    if (strtolower($email) == strtolower($Email)) {
        echo false;
    } else {
     $result = $obj_user->checkAlreadyExist($obj_user->tableName(), 'email_id', $email);
      
        if ($result) {
            echo true;
        } else {
            echo false;
        }
    }
}
?>
