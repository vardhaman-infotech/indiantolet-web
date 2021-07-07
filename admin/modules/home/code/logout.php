<?php
require_once("../../../../app/conf/config.inc.php");

$loginSystemObj = new LoginSystem();
$loginSystemObj->logout();

header("location: ".ADMIN_URL."/modules/login/");
die();
?>