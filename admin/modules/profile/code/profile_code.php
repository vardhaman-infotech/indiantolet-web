<?php

$obj_admin = new adminModel();

/////////Admin Update Detail
if (isset($_POST['profileSubmit']) && $_POST['profileSubmit'] != "") {
    if(isset($_SESSION['admin_Id']) && !empty($_SESSION['admin_Id'])){
        $obj_admin->attributes = $_POST;
        $obj_admin->update($obj_admin->attributes, 'admin_id='.$_SESSION['admin_Id']);
    }
    
    $_SESSION['successMsg'] = ADMIN_SUCCESS_UPDATE_MASSAGE;
}
/////////Admin Change Password
if (isset($_POST['passwordChange']) && $_POST['passwordChange'] != "") {  
    ////Check Fields 
    if (isset($_POST['old_password']) && !empty($_POST['old_password']) && isset($_POST['new_password']) && !empty($_POST['new_password'])) {

        if(isset($_SESSION['admin_Id']) && !empty($_SESSION['admin_Id'])){
            $passCondition = "admin_id=" . $_SESSION['admin_Id'] . " AND admin_pass='" . hash("sha512", $_POST['old_password']) . "'";
            ///Check Password Is Available and Not
            $check = $obj_admin->select($passCondition);
            if (count($check) > 0) {  
                $obj_admin->attributes['admin_pass'] = hash("sha512", $_POST['new_password']);
                $obj_admin->update($obj_admin->attributes, 'admin_id="'.$_SESSION['admin_Id'].'"');
                $_SESSION['successMsg'] = ADMIN_SUCCESS_PASSWORD_UPDATE_MASSAGE;
            } else {
                $errorMsg = ADMIN_ERROR_PASSWORD;
            }
        } else {
            $errorMsg = ADMIN_ERROR_PASSWORD;
        }
       
    } else {
        $errorMsg = ADMIN_ERROR_PASSWORD;
    }
}

/*For Refund and Return policy Setting*/
if (isset($_POST['Commission_Setting']) && $_POST['Commission_Setting'] != "") {  
       if(isset($_SESSION['admin_Id']) && !empty($_SESSION['admin_Id'])){
        $obj_admin->attributes = $_POST;
        $obj_admin->update($obj_admin->attributes, 'admin_id="'.$_SESSION['admin_Id'].'"');
    }
    
    $_SESSION['successMsg'] = ADMIN_SUCCESS_UPDATE_MASSAGE;
}
//die;
//////Get Data To Show Form
$admin_data = $obj_admin->selectByPk($_SESSION['admin_Id']);

?>
