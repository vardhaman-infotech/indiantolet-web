<?php

define('OWNER_CONFIRM_ACTIVATE_ALL', "Are you sure you want to activate selected Owner record?");
define('OWNER_CONFIRM_DEACTIVATE_ALL', "Are you sure you want to deactivate selected Owner record?");
define('OWNER_CONFIRM_DELETE', "Are you sure you want to Delete selected Owner record?");
define('OWNER_ACTIVE', "1");
define('OWNER_DEACTIVE', "0");
define('OWNER_DELETE', "Deleted");
define('OWNER_SUCCESS_ACTIVATE_MESSAGE', "Record activated successfully");
define('OWNER_SUCCESS_DEACTIVATE_MESSAGE', "Record deactivated successfully");
define('OWNER_SUCCESS_DELETE_MESSAGE', "Record deleted successfully");
define('OWNER_SUCCESS_UPDATE_MESSAGE', "Record updated successfully");
define('OWNER_SUCCESS_ADD_MESSAGE', "Record Added successfully");
define('OWNER_ALL_SUCCESS_ACTIVATE_MESSAGE', "All selected Owner activated successfully");
define('OWNER_ALL_SUCCESS_DEACTIVATE_MESSAGE', "All selected Owner deactivated successfully");
define('OWNER_ALL_SUCCESS_DELETE_MESSAGE', "All selected Owner deleted successfully");

class ownerModel extends dbModel {

    public $attributeLabel = array(
        'owner_id' => 'Owner Id',
        'full_name' => 'Full Name',
        'phone_number' => 'Phone Number',
        'owner_dob' => 'Owner DOB',
        'owner_image' => 'Owner Image',
        'email_id' => 'Email Id',
        'is_gender' => 'Gender',
        'civil_register_number' => 'Civil Register Number',
        'is_active' => 'Is Active',
        'created_date' => 'Created Date',
        'modification_date' => 'Modification Date',
    );

    function tableName() {
        return $this->tableName = "tbl_owner";
    }

}
?>



