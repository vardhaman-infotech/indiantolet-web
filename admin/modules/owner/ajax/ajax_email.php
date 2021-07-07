<?php

include("../../../../app/conf/config.inc.php");
extract($_GET);
extract($_POST);
$obj_owner = new ownerModel();
$email = trim($email);
$Email = trim($Email);

if (isset($email)) {
    if (strtolower($email) == strtolower($Email)) {
        echo false;
    } else {
     $result = $obj_owner->checkAlreadyExist($obj_owner->tableName(), 'email_id', $email);
      
        if ($result) {
            echo true;
        } else {
            echo false;
        }
    }
}
?>
