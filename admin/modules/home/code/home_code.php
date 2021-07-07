<?php

/* =======================================================================
 * Coder    : Vikram Solanki
 * Date     : 16-July-2018
 * =======================================================================
 */


$obj_admin = new adminModel();
if (isset($_POST['action']) && $_POST['action'] == 'SubmitAdminDetail') {
    $obj_admin->attributes = $_POST;
    $obj_admin->save($_SESSION['admin_Id']);
    $successMsg = ADMIN_SUCCESS_UPDATE_MASSAGE;
    $action = '';
} elseif (isset($_POST['action']) && $_POST['action'] == 'SubmitPass' && isset($SubmitAdmin) && $SubmitAdmin == "SAVE") {
    $_POST['admin_password'] = hash("sha512", $_POST['admin_pass']);
    $obj_admin->attributes = $_POST;
    $obj_admin->save($_SESSION['admin_Id']);
    $successMsg = ADMIN_SUCCESS_PASSWORD_UPDATE_MASSAGE;
    $action = '';
} 
$data_admin = $obj_admin->select('admin_id=' . $_SESSION['admin_Id']);
?>