<?php

define('CONTACT_CONFIRM_ACTIVATE_ALL', "Are you sure you want to activate selected Contact record?");
define('CONTACT_CONFIRM_DEACTIVATE_ALL', "Are you sure you want to deactivate selected Contact record?");
define('CONTACT_CONFIRM_DELETE', "Are you sure you want to Delete selected Contact record?");
define('CONTACT_ACTIVE', "1");
define('CONTACT_DEACTIVE', "0");
define('CONTACT_DELETE', "Deleted");
define('CONTACT_SUCCESS_ACTIVATE_MESSAGE', "Record activated successfully");
define('CONTACT_SUCCESS_DEACTIVATE_MESSAGE', "Record deactivated successfully");
define('CONTACT_SUCCESS_DELETE_MESSAGE', "Record deleted successfully");
define('CONTACT_SUCCESS_UPDATE_MESSAGE', "Record updated successfully");
define('CONTACT_SUCCESS_ADD_MESSAGE', "Record Added successfully");
define('CONTACT_ALL_SUCCESS_ACTIVATE_MESSAGE', "All selected Contact activated successfully");
define('CONTACT_ALL_SUCCESS_DEACTIVATE_MESSAGE', "All selected Contact deactivated successfully");
define('CONTACT_ALL_SUCCESS_DELETE_MESSAGE', "All selected Contact deleted successfully");

class contactusModel extends dbModel { 

    function tableName() {
        return $this->tableName = "tbl_contact";
    }

}
?>



