<?php

# Coder Vishnu and Rajuram
# Date  : 21-Nov-2014

$currentTimestamp = getCurrentTimestamp();
$obj_emails = new emailsModel();
$obj_import = new importModel();

if (isset($emailsId))
    $emailsId = decode($emailsId);
if (isset($action) && trim($action) == "submitForm") {
    if (isset($actionType) && $actionType == EMAILS_ACTIVE) {
        $dataArr = array("is_active" => EMAILS_ACTIVE);
        $obj_emails->attributes = $dataArr;
        $obj_emails->updateAllByPk($chk, $obj_emails->attributes, "email_id");
        $_SESSION['successMsg'] = EMAILS_ALL_SUCCESS_ACTIVATE_MESSAGE;
        header("location:" . ADMIN_URL . "/emails.php");
        exit();
    } elseif (isset($actionType) && $actionType == EMAILS_DEACTIVE) {
        $dataArr = array("is_active" => EMAILS_DEACTIVE);
        $obj_emails->attributes = $dataArr;
        $obj_emails->updateAllByPk($chk, $obj_emails->attributes, "email_id");
        $_SESSION['successMsg'] = EMAILS_ALL_SUCCESS_DEACTIVATE_MESSAGE;
        header("location:" . ADMIN_URL . "/emails.php");
        exit();
    } elseif (isset($actionType) && $actionType == EMAILS_DELETE) {
        $obj_emails->deleteAllByPk($chk, "email_id");
        $_SESSION['successMsg'] = EMAILS_ALL_SUCCESS_DELETE_MESSAGE;
        header("location:" . ADMIN_URL . "/emails.php");
        exit();
    }
} elseif (isset($action) && ($action == "editEmails" || $action == "addEmails")) {
    if (isset($submitEmails) && $submitEmails != "") {
        unset($_POST['submitEmails']);
        if (isset($emailsID) && $emailsID != "" && $action == "editEmails") {
            $_POST['date_modified'] = $currentTimestamp;
            $obj_emails->attributes = $_POST;
            $obj_emails->update($obj_emails->attributes, "email_id=" . $emailsID);
            $_SESSION['successMsg'] = EMAILS_SUCCESS_UPDATE_MESSAGE;
        } elseif ($action == "addEmails") {
            $_POST['date_created'] = $currentTimestamp;
            $obj_emails->attributes = $_POST;
            $obj_emails->insert($obj_emails->attributes);
            $_SESSION['successMsg'] = EMAILS_SUCCESS_ADD_MESSAGE;
        }
        header("location:" . ADMIN_URL . "/emails.php");
        exit();
    }
    //////////////Edit Time Show Data In Form 
    if (isset($emailsId) && $emailsId != "" && $action == "editEmails") {
        $emails = $obj_emails->selectByPk($emailsId);
        $emails = (array) $emails;
        extract($emails);
    }
    ///////////////////////////////Import File
}elseif (isset($action) && trim($action) == "activateEmails" && $emailsId != "") {
    $dataArr = array("is_active" => EMAILS_ACTIVE);
    $obj_emails->attributes = $dataArr;
    $obj_emails->update($obj_emails->attributes, "email_id=" . $emailsId);
    $_SESSION['successMsg'] = EMAILS_SUCCESS_ACTIVATE_MESSAGE;
    header("location:" . ADMIN_URL . "/emails.php");
    exit();
} elseif (isset($action) && $action == "deActivateEmails" && $emailsId != "") {
    $dataArr = array("is_active" => EMAILS_DEACTIVE);
    $obj_emails->attributes = $dataArr;
    $obj_emails->update($obj_emails->attributes, "email_id=" . $emailsId);
    $_SESSION['successMsg'] = EMAILS_SUCCESS_DEACTIVATE_MESSAGE;
    header("location:" . ADMIN_URL . "/emails.php");
    exit();
} elseif (isset($action) && $action == "delete" && $emailsId != "") {
    $obj_emails->delete("email_id=" . $emailsId);
    $_SESSION['successMsg'] = EMAILS_SUCCESS_DELETE_MESSAGE;
    header("location:" . ADMIN_URL . "/emails.php");
    exit();
} else {
    $data_emails = $obj_emails->select();
}
?>