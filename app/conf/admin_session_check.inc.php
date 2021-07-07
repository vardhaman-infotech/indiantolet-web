<?php
if (!isset($_SESSION['admin_Id']) && $_SESSION['admin_Id'] == "") { //echo 'fdfdfd';die;
    header("Location: " . ADMIN_URL ."/login.php");
    exit();
}
 // echo $_SESSION['admin_Id'];die;
?>