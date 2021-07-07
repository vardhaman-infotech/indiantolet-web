<?php

define('EMAILS_CONFIRM_ACTIVATE_ALL', "Are you sure you want to activate selected emails record?");
define('EMAILS_CONFIRM_DEACTIVATE_ALL', "Are you sure you want to deactivate selected emails record?");
define('EMAILS_CONFIRM_DELETE', "Are you sure you want to Delete selected emails record?");
define('EMAILS_ACTIVE', "1");
define('EMAILS_DEACTIVE', "0");
define('EMAILS_DELETE', "Deleted");
define('EMAILS_SUCCESS_ACTIVATE_MESSAGE', "Record activated successfully");
define('EMAILS_SUCCESS_DEACTIVATE_MESSAGE', "Record deactivated successfully");
define('EMAILS_SUCCESS_DELETE_MESSAGE', "Record deleted successfully");
define('EMAILS_SUCCESS_UPDATE_MESSAGE', "Record updated successfully");
define('EMAILS_SUCCESS_ADD_MESSAGE', "Record Added successfully");
define('EMAILS_ALL_SUCCESS_ACTIVATE_MESSAGE', "All selected emails activated successfully");
define('EMAILS_ALL_SUCCESS_DEACTIVATE_MESSAGE', "All selected emails deactivated successfully");
define('EMAILS_ALL_SUCCESS_DELETE_MESSAGE', "All selected emails deleted successfully");

class emailsModel extends dbModel {

    public $attributeLabel = array(
        'email_id' => 'Email Id',
        'email_for' => 'Email For',
        'email_subject' => 'Email Subject',
        'email_description' => 'Email Description',
        'is_active' => 'Is Active',
        'created_date' => 'Created Date',
        'modification_date' => 'Modification Date',
    );

    function tableName() {
        return $this->tableName = "tbl_emails";
    }
}
?>



