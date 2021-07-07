<?php

define('CITY_CONFIRM_ACTIVATE_ALL', "Are you sure you want to activate selected City record?");
define('CITY_CONFIRM_DEACTIVATE_ALL', "Are you sure you want to deactivate selected City record?");
define('CITY_CONFIRM_DELETE', "Are you sure you want to Delete selected City record?");
define('CITY_ACTIVE', "1");
define('CITY_DEACTIVE', "0");
define('CITY_DELETE', "Deleted");
define('CITY_SUCCESS_ACTIVATE_MESSAGE', "Record activated successfully");
define('CITY_SUCCESS_DEACTIVATE_MESSAGE', "Record deactivated successfully");
define('CITY_SUCCESS_DELETE_MESSAGE', "Record deleted successfully");
define('CITY_SUCCESS_UPDATE_MESSAGE', "Record updated successfully");
define('CITY_SUCCESS_ADD_MESSAGE', "Record Added successfully");
define('CITY_ALL_SUCCESS_ACTIVATE_MESSAGE', "All selected City activated successfully");
define('CITY_ALL_SUCCESS_DEACTIVATE_MESSAGE', "All selected City deactivated successfully");
define('CITY_ALL_SUCCESS_DELETE_MESSAGE', "All selected City deleted successfully");

class cityModel extends dbModel { 

    function tableName() {
        return $this->tableName = "tbl_city";
    }

}
?>



