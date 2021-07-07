<?php

# Coder : Ankit Sharma
# Date  : 21-Dec-2017

include_once("../app/conf/config.inc.php");
include_once("../app/conf/admin_session_check.inc.php");
include_once(ADMIN_ROOT . "/modules/users/code/user_code.php");
include_once(ADMIN_ROOT . "/includes/admin_header.php");
if(isset($action)){
    if($action == "addUser" || $action == "editUser"){
        include_once(ADMIN_ROOT . "/modules/users/form/user_form.php"); 
    }elseif($action == "viewUser"){
     include_once(ADMIN_ROOT . "/modules/users/form/user_view_form.php"); 
    }
}else{
    include_once(ADMIN_ROOT . "/modules/users/table/user_table.php"); 
}
include_once(ADMIN_ROOT . "/includes/admin_footer.php"); 
?>