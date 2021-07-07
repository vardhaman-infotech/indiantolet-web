<?php

# Coder : Ankit Sharma
# Date  : 21-Dec-2017

include_once("../app/conf/config.inc.php");
include_once("../app/conf/admin_session_check.inc.php");
include_once(ADMIN_ROOT . "/modules/owner/code/owner_code.php");
include_once(ADMIN_ROOT . "/includes/admin_header.php");
if(isset($action)){
    if($action == "addOwner" || $action == "editOwner"){
        include_once(ADMIN_ROOT . "/modules/owner/form/owner_form.php"); 
    }elseif($action == "viewOwner"){
     include_once(ADMIN_ROOT . "/modules/owner/form/owner_view_form.php"); 
    }
}else{
    include_once(ADMIN_ROOT . "/modules/owner/table/owner_table.php"); 
}
include_once(ADMIN_ROOT . "/includes/admin_footer.php"); 
?>