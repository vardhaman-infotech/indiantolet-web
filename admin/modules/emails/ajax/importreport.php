<?php
include_once("../../../../app/conf/config.inc.php");

//////////////////////
$obj_emails = new emailsModel();
$obj_import = new importModel();


    if (isset($_FILES['importreport']['name']) && $_FILES['importreport']['error'] == 0) {
        $import_ext_get = explode('.', $_FILES['importreport']['name']);
         $import_ext = end($import_ext_get);
        if (($import_ext == 'xlsx' || $import_ext == 'xls') 
           && $_FILES['importreport']['size'] > 0 ){
           	$excel_name = imageUpload('importreport', 'excelfile/email');
            $record=$obj_import->attributes['importreport'] = $excel_name;
            $lastid=$obj_import->insert($obj_import->attributes);
           	// $obj_emails->attributes['importreport'] = $lastid;
           	// $obj_emails->updateAllByPk($record, $obj_emails->attributes, $lastid);
             $_SESSION['successMsg'] = EMAILS_SUCCESS_ADD_MESSAGE;
              header("location:" . ADMIN_URL . "/emails.php");
        exit();
        }else{
        	$errorMsg = "Required format xlsx,xls only!";
        }
    } else {
        $errorMsg = "Required File!";
    }


?>
