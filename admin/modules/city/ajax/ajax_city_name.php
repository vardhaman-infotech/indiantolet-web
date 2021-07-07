<?php

include("../../../../app/conf/config.inc.php");
extract($_GET);
extract($_POST);
//echo "suman";
// print_r($_POST);die;
$obj_city = new cityModel();

$newData = trim($newData);
$existingData = trim($existingData);
if (isset($newData)) {

    if (strtolower($newData) == strtolower($existingData)) {
        echo false;
    } else {
        echo $result = $obj_city->checkAlreadyExist($obj_city->tableName(), 'name', $newData);
//	$whereCondition = "name='$newData'";
//	$data = $obj_city->select($whereCondition);
//        if (count($result) > 0) { 
//            echo true;
//        } else {  
//            echo false;
//        }
    }
}

 
?>
