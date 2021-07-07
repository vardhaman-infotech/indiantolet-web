<?php

/* ==================================================================
  Coder:vikram solanki
  Date :29/10/2016
  ================================================================== */
# ----------------------------------------------------------------------------------------------------
# VAC ADMINISTRATOR EMAIL
# ----------------------------------------------------------------------------------------------------
@session_start();
@ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
@define('SITE_ADMIN_EMAIL', "info@indiantolet.com");
define('SITE_MAIL_SENDER_NAME', "INDIAN TO-LET");
define('ADMIN_NO_REPLY', "noreply@indiantolet.com");

date_default_timezone_set("Asia/Kolkata");
# ----------------------------------------------------------------------------------------------------
# DATABASE CONNECTION PARAMETERS
# ----------------------------------------------------------------------------------------------------

$server = $_SERVER['SERVER_ADDR'];

/*  Updated by Abhishek */
switch ($server) {
    // for 192.168.2.19
    case '192.168.2.145':
        define('VACDB_HOST', "localhost");
        define('VACDB_USER', "root");
        define('VACDB_PASS', "");
        define('VACDB_NAME', "house_rental");

        break;

    // For 192.168.2.169
    case '192.168.2.169':
        define('VACDB_HOST', "localhost");
        define('VACDB_USER', "root");
        define('VACDB_PASS', "");
        define('VACDB_NAME', "house_rental");
        break;

    default :
        define('VACDB_HOST', "localhost");
        define('VACDB_USER', "mydemurc_house_rental");
        define('VACDB_PASS', "sHgmM&dB~fu{");
        define('VACDB_NAME', "mydemurc_house_rental");
}
define('VACDB_EMAIL', 'SITE_ADMIN_EMAIL');


# ----------------------------------------------------------------------------------------------------
# DEFINE VAC FOLDER
# ----------------------------------------------------------------------------------------------------
define('VAC_FOLDER', "");
# ----------------------------------------------------------------------------------------------------
# Site Name
# ----------------------------------------------------------------------------------------------------
define('MAIN_SITE_NAME', "INDIAN TO-LET");
# ----------------------------------------------------------------------------------------------------
# Site Title
# ----------------------------------------------------------------------------------------------------
define('MAIN_SITE_TITLE', "INDIAN TO-LET");
# ----------------------------------------------------------------------------------------------------
# Admin Folder
# ----------------------------------------------------------------------------------------------------
define('MAIN_ADMIN_FOLDER', "admin");

    
# ----------------------------------------------------------------------------------------------------
# DEFINE MODULE FOLDER
# ----------------------------------------------------------------------------------------------------
define('MODULE_FOLDER', "/modules");
# ----------------------------------------------------------------------------------------------------
# DEFINE SCRIPT FOLDER
# ----------------------------------------------------------------------------------------------------
define('SCRIPT_FOLDER', "/js");
# ----------------------------------------------------------------------------------------------------
# DEFINE CSS FOLDER
# ----------------------------------------------------------------------------------------------------
define('CSS_FOLDER', "/css");
# ----------------------------------------------------------------------------------------------------
# ----------------------------------------------------------------------------------------------------
# DEFINE VAC ROOT
# ----------------------------------------------------------------------------------------------------
//checking if last char in DOCUMENT_ROOT is '/' than remove it
$lastchar = substr($_SERVER["DOCUMENT_ROOT"], -1, 1);
if ($lastchar == '/') {
    $rest = substr($_SERVER["DOCUMENT_ROOT"], 0, -1);
    define('VAC_ROOT', $rest . VAC_FOLDER);
    define('INV_ROOT', $rest . VAC_FOLDER);
} else {
    define('VAC_ROOT', $_SERVER["DOCUMENT_ROOT"] . VAC_FOLDER);
    define('INV_ROOT', $_SERVER["DOCUMENT_ROOT"] . VAC_FOLDER);
}
#----------------------------------------------------------------
# management_panel root
#----------------------------------------------------------------
define('ADMIN_ROOT', VAC_ROOT . "/" . MAIN_ADMIN_FOLDER);

    
# ----------------------------------------------------------------------------------------------------
# DEFAULT URL
# ----------------------------------------------------------------------------------------------------

if (!isset($_SERVER['HTTPS']) || ($_SERVER['HTTPS'] == "off")) {
    define('HTTPS_MODE', "off");
    define('DEFAULT_URL', "http://" . $_SERVER["HTTP_HOST"] . VAC_FOLDER);
    define('MAIN_URL', "https://" . $_SERVER["HTTP_HOST"]);
} else {
    define('HTTPS_MODE', "on");
    define('DEFAULT_URL', "https://" . $_SERVER["HTTP_HOST"] . VAC_FOLDER);
    define('MAIN_URL', "https://" . $_SERVER["HTTP_HOST"]);
}


# ----------------------------------------------------------------------------------------------------
# DEFINE HOST NAME
# ----------------------------------------------------------------------------------------------------
define('HOST_NAME', $_SERVER["HTTP_HOST"]);
# ----------------------------------------------------------------------------------------------------
# DEFINE MODULE URL
# ----------------------------------------------------------------------------------------------------
define('MODULE_URL', "https://" . $_SERVER["HTTP_HOST"] . VAC_FOLDER . MODULE_FOLDER);
# ----------------------------------------------------------------------------------------------------
# DEFINE MODULE URL
# ----------------------------------------------------------------------------------------------------
define('ADMIN_URL', "https://" . $_SERVER["HTTP_HOST"] . VAC_FOLDER . "/" . MAIN_ADMIN_FOLDER);

    
# ----------------------------------------------------------------------------------------------------
# SECURE URL
# ----------------------------------------------------------------------------------------------------
define('SECURE_URL', "https://" . $_SERVER["HTTP_HOST"] . VAC_FOLDER);
# ----------------------------------------------------------------------------------------------------
# NON_SECURE_URL
# ----------------------------------------------------------------------------------------------------
define('NON_SECURE_URL', "http://" . $_SERVER["HTTP_HOST"] . VAC_FOLDER);
# ----------------------------------------------------------------------------------------------------
# DEFINE SCRIPT URL
# ----------------------------------------------------------------------------------------------------
define('SCRIPT_URL', DEFAULT_URL . SCRIPT_FOLDER);
# ----------------------------------------------------------------------------------------------------
# DEFINE CSS URL
# ----------------------------------------------------------------------------------------------------
define('CSS_URL', DEFAULT_URL . CSS_FOLDER);
# ----------------------------------------------------------------------------------------------------
# INCLUDE GLOBAL INCLUDES
# ----------------------------------------------------------------------------------------------------
// here we are taking screen display area from cookie

if (isset($_COOKIE["users_resolution"])) {
    $screen_resolution = explode('x', $_COOKIE["users_resolution"]);
    $screenwidth = $screen_resolution[0];
    $screenheight = $screen_resolution[1];
}

if (strstr($_SERVER['PHP_SELF'], 'admin')) { 
    include(VAC_ROOT . "/app/conf/admin_includes.inc.php");
} else {
    include(VAC_ROOT . "/app/conf/includes.inc.php");
}
extract($_GET);
extract($_POST);
