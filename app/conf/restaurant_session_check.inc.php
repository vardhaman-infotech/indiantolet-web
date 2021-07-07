<?php
if ($_SESSION['restaurant_Id'] == "") {
    header("Location: " . RESTAURANT_ADMIN_URL ."/login.php");
    exit();
}
  
?>