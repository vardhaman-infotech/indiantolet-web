<?php

# Coder : Rajuram
# Date  : 21-Nov-2014

include_once("../app/conf/config.inc.php");
include_once("../app/conf/admin_session_check.inc.php");
include_once(ADMIN_ROOT . "/modules/emails/code/emails_code.php");
include_once(ADMIN_ROOT . "/includes/admin_header.php");
if(isset($action)){
    if($action == "addEmails" || $action == "editEmails"){
        include_once(ADMIN_ROOT . "/modules/emails/form/emails_form.php"); 
    }
}else{
    include_once(ADMIN_ROOT . "/modules/emails/table/emails_table.php"); 
}
include_once(ADMIN_ROOT . "/includes/admin_footer.php"); 
?>