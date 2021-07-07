<?php

# Coder : Rajuram
# Date  : 21-Nov-2014

include_once("../app/conf/config.inc.php");
include_once("../app/conf/admin_session_check.inc.php");
include_once(ADMIN_ROOT . "/modules/city/code/city_code.php");
include_once(ADMIN_ROOT . "/includes/admin_header.php");
if(isset($action)){
    if($action == "addCity" || $action == "editCity"){
        include_once(ADMIN_ROOT . "/modules/city/form/city_form.php"); 
    }
}else{
    include_once(ADMIN_ROOT . "/modules/city/table/city_table.php"); 
}
include_once(ADMIN_ROOT . "/includes/admin_footer.php"); 
?>