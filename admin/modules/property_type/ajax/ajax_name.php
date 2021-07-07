<?php

include("../../../../app/conf/config.inc.php");
extract($_GET);
extract($_POST);
$obj_propertyType = new property_typeModel();
$name = trim($name);
$Name = trim($Name);


if (isset($name)) {
    if (strtolower($name) == strtolower($Name)) {
        echo false;
    } else {
        $result = $obj_propertyType->checkAlreadyExist($obj_propertyType->tableName(), 'name', $name);
        if ($result) {
            echo true;
        } else {
            echo false;
        }
    }
}

?>
