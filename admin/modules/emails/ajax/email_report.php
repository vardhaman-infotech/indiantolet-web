<?php  
 //Coder : Likhama Hudda
//Date   : 07-March-2017

  ///////////
include_once("../../../../app/conf/config.inc.php");

$obj_emails = new emailsModel();
$getemail=$obj_emails->select("is_active='1'");

foreach ($getemail as $value) {
  
      $data[] =  array(       
      'Record#'=> $value->email_id,
      'Email For'=> $value->email_for,
      'Subject'=>$value->email_subject,
 );
}
  
ob_clean();

function cleanData(&$str) {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"'))
        $str = '"' . str_replace('"', '""', $str) . '"';
}
 
    $filename = "Email.csv";

    header('Content-type: application/csv');
    header('Content-Disposition: attachment; filename=' . $filename);
    header("Content-Transfer-Encoding: UTF-8");

    $f = fopen('php://output', 'a');
    fputcsv($f, array_keys($data[0]));

    foreach ($data as $row) 
    {
        fputcsv($f, $row);
    }
    fclose($f);
 
exit;
ob_clean();

?>