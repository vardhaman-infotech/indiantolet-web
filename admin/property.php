<?php

# Coder : Ankit Sharma
# Date  : 21-Dec-2017

include_once("../app/conf/config.inc.php");
include_once("../app/conf/admin_session_check.inc.php");
include_once(ADMIN_ROOT . "/modules/property/code/property_code.php");
include_once(ADMIN_ROOT . "/includes/admin_header.php");
if(isset($action) && $action == "viewProperty"){
     include_once(ADMIN_ROOT . "/modules/property/form/property_view_form.php"); 
}else{
    include_once(ADMIN_ROOT . "/modules/property/table/property_table.php"); 
}

include_once(ADMIN_ROOT . "/includes/admin_footer.php"); 
?>