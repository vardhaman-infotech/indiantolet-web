<?php
define('ADMIN_OFFICE_MEMBER_CONFIRM_ACTIVATE_ALL', "Are you sure you want to activate selected test record?");
define('ADMIN_OFFICE_MEMBER_CONFIRM_DEACTIVATE_ALL', "Are you sure you want to deactivate selected test record?");
define('ADMIN_OFFICE_MEMBER_CONFIRM_DELETE', "Are you sure you want to Delete selected test record?");
define('ADMIN_OFFICE_MEMBER_ACTIVE', "1");
define('ADMIN_OFFICE_MEMBER_DEACTIVE', "0");
define('ADMIN_OFFICE_MEMBER_DELETE', "Deleted");
define('ADMIN_OFFICE_MEMBER_SUCCESS_ACTIVATE_MESSAGE', "Record activated successfully");
define('ADMIN_OFFICE_MEMBER_SUCCESS_DEACTIVATE_MESSAGE', "Record deactivated successfully");
define('ADMIN_OFFICE_MEMBER_SUCCESS_DELETE_MESSAGE', "Record deleted successfully");
define('ADMIN_OFFICE_MEMBER_SUCCESS_UPDATE_MESSAGE', "Record updated successfully");
define('ADMIN_OFFICE_MEMBER_SUCCESS_ADD_MESSAGE', "Record Added successfully");
define('ADMIN_OFFICE_MEMBER_ALL_SUCCESS_ACTIVATE_MESSAGE', "All selected test activated successfully");
define('ADMIN_OFFICE_MEMBER_ALL_SUCCESS_DEACTIVATE_MESSAGE', "All selected test deactivated successfully");
define('ADMIN_OFFICE_MEMBER_ALL_SUCCESS_DELETE_MESSAGE', "All selected test deleted successfully");
define('ADMIN_SUCCESS_UPDATE_MASSAGE', "Admin profile updated successfully");
define('ADMIN_SUCCESS_PASSWORD_UPDATE_MASSAGE', "Admin passsword change successfully");
define('ADMIN_ERROR_PASSWORD', "Please enter a valid password.");
define('ADMIN_ERROR_LOGIN_MASSAGE', "Please enter a valid user name or password");
define('ADMIN_MAIL_SEND_RESET_PASSWORD_SUCCESSFULLY', "Email send successfully for reset password");

class adminModel extends dbModel {

    public $attributeLabel = array(
     
        'name' => 'admin_fname',
        'admin_lname' => 'admin_lname',
        'email' => 'admin_email',
        'admin_location' => 'admin_location',
        'is_active' => 'is_active',
        'phone_number' => 'admin_contact',
        'admiin_password' => 'password',
     
   );
   
    function tableName() {
        return $this->tableName = "tbl_admin";
    }

    function logout() {
        @session_start();
        $_SESSION['admin_In'] = false;
        unset($_SESSION['admin_In']);
        unset($_SESSION['admin_Id']);
        unset($_SESSION['admin_Name']);
        unset($_SESSION['type']);
        unset($_SESSION['small']);
        unset($_SESSION['large']);
        session_destroy();
    }      

}


?>



