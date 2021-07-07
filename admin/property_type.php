<?php

# Coder : Ankit Sharma
# Date  : 21-Dec-2017

include_once("../app/conf/config.inc.php");
include_once("../app/conf/admin_session_check.inc.php");
include_once(ADMIN_ROOT . "/modules/property_type/code/property_type_code.php");
include_once(ADMIN_ROOT . "/includes/admin_header.php");
if(isset($action)){
    if($action == "addProperty_type" || $action == "editProperty_type"){
        include_once(ADMIN_ROOT . "/modules/property_type/form/property_type_form.php"); 
    }elseif($action == "viewProperty_type"){
     include_once(ADMIN_ROOT . "/modules/property_type/form/property_type_view_form.php"); 
    }
}else{
    include_once(ADMIN_ROOT . "/modules/property_type/table/property_type_table.php"); 
}
include_once(ADMIN_ROOT . "/includes/admin_footer.php"); 
?>