<?php
session_start();
include("../app/conf/config.inc.php");
header("Location:" . ADMIN_URL . "/login.php");
exit();
?>