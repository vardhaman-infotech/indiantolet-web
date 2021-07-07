<?php

define('USER_CONFIRM_ACTIVATE_ALL', "Are you sure you want to activate selected User record?");
define('USER_CONFIRM_DEACTIVATE_ALL', "Are you sure you want to deactivate selected User record?");
define('USER_CONFIRM_DELETE', "Are you sure you want to Delete selected User record?");
define('USER_ACTIVE', "1");
define('USER_DEACTIVE', "0");
define('USER_DELETE', "Deleted");
define('USER_SUCCESS_ACTIVATE_MESSAGE', "Record activated successfully");
define('USER_SUCCESS_DEACTIVATE_MESSAGE', "Record deactivated successfully");
define('USER_SUCCESS_DELETE_MESSAGE', "Record deleted successfully");
define('USER_SUCCESS_UPDATE_MESSAGE', "Record updated successfully");
define('USER_SUCCESS_ADD_MESSAGE', "Record Added successfully");
define('USER_ALL_SUCCESS_ACTIVATE_MESSAGE', "All selected User activated successfully");
define('USER_ALL_SUCCESS_DEACTIVATE_MESSAGE', "All selected User deactivated successfully");
define('USER_ALL_SUCCESS_DELETE_MESSAGE', "All selected User deleted successfully");

class userModel extends dbModel {

    public $attributeLabel = array(
        'user_id' => 'User Id',
        'full_name' => 'Full Name',
        'phone_number' => 'Phone Number',
        'user_dob' => 'User DOB',
        'user_image' => 'User Image',
        'email_id' => 'Email Id',
        'is_gender' => 'Gender',
        'civil_register_number' => 'Civil Register Number',
        'is_active' => 'Is Active',
        'created_date' => 'Created Date',
        'modification_date' => 'Modification Date',
    );

    function tableName() {
        return $this->tableName = "tbl_user";
    }

}
?>



