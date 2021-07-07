<?php

include("../../../../app/conf/config.inc.php");
extract($_GET);
extract($_POST);
$obj_emails = new emailsModel();
$newData = trim($newData);
$existingData = trim($existingData);

if (isset($newData)) {
    if (strtolower($newData) == strtolower($existingData)) {
        echo false;
    } else {
        $result = $obj_emails->checkAlreadyExist($obj_emails->tableName(), 'email_for', $newData);
        if ($result) {
            echo true;
        } else {
            echo false;
        }
    }
}
?>
