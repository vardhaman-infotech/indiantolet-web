<?php

if (isset($_SESSION['admin_Id']) && $_SESSION['admin_Id'] != "") {
    header("Location: " . ADMIN_URL . "/home.php");
    exit();
}
?>