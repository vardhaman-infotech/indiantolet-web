<?php

if (isset($_SESSION['restaurant_Id']) && $_SESSION['restaurant_Id'] != "") {
    header("Location: " . RESTAURANT_ADMIN_URL . "/home.php");
    exit();
}
?>