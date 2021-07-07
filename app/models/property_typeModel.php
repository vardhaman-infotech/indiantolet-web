<?php

define('PROPERTY_TYPE_CONFIRM_ACTIVATE_ALL', "Are you sure you want to activate selected Property_type record?");
define('PROPERTY_TYPE_CONFIRM_DEACTIVATE_ALL', "Are you sure you want to deactivate selected Property_type record?");
define('PROPERTY_TYPE_CONFIRM_DELETE', "Are you sure you want to Delete selected Property_type record?");
define('PROPERTY_TYPE_ACTIVE', "1");
define('PROPERTY_TYPE_DEACTIVE', "0");
define('PROPERTY_TYPE_DELETE', "Deleted");
define('PROPERTY_TYPE_SUCCESS_ACTIVATE_MESSAGE', "Record activated successfully");
define('PROPERTY_TYPE_SUCCESS_DEACTIVATE_MESSAGE', "Record deactivated successfully");
define('PROPERTY_TYPE_SUCCESS_DELETE_MESSAGE', "Record deleted successfully");
define('PROPERTY_TYPE_SUCCESS_UPDATE_MESSAGE', "Record updated successfully");
define('PROPERTY_TYPE_SUCCESS_ADD_MESSAGE', "Record Added successfully");
define('PROPERTY_TYPE_ALL_SUCCESS_ACTIVATE_MESSAGE', "All selected Property_type activated successfully");
define('PROPERTY_TYPE_ALL_SUCCESS_DEACTIVATE_MESSAGE', "All selected Property_type deactivated successfully");
define('PROPERTY_TYPE_ALL_SUCCESS_DELETE_MESSAGE', "All selected Property_type deleted successfully");

class property_typeModel extends dbModel { 

    function tableName() {
        return $this->tableName = "tbl_property_type";
    }

}
?>



