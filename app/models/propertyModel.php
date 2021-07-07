<?php

define('PROPERTY_CONFIRM_ACTIVATE_ALL', "Are you sure you want to activate selected property record?");
define('PROPERTY_CONFIRM_DEACTIVATE_ALL', "Are you sure you want to deactivate selected property record?");
define('PROPERTY_CONFIRM_DELETE', "Are you sure you want to Delete selected property record?");
define('PROPERTY_ACTIVE', "1");
define('PROPERTY_DEACTIVE', "0");
define('PROPERTY_DELETE', "Deleted");
define('PROPERTY_SUCCESS_ACTIVATE_MESSAGE', "Record activated successfully");
define('PROPERTY_SUCCESS_DEACTIVATE_MESSAGE', "Record deactivated successfully");
define('PROPERTY_SUCCESS_DELETE_MESSAGE', "Record deleted successfully");
define('PROPERTY_SUCCESS_UPDATE_MESSAGE', "Record updated successfully");
define('PROPERTY_SUCCESS_ADD_MESSAGE', "Record Added successfully");
define('PROPERTY_ALL_SUCCESS_ACTIVATE_MESSAGE', "All selected property activated successfully");
define('PROPERTY_ALL_SUCCESS_DEACTIVATE_MESSAGE', "All selected property deactivated successfully");
define('PROPERTY_ALL_SUCCESS_DELETE_MESSAGE', "All selected property deleted successfully");

class propertyModel extends dbModel { 

    function tableName() {
        return $this->tableName = "tbl_property";
    }

}
?>



