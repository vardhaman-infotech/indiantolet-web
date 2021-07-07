<?php
/**
 * Define document paths
 */
 
 
error_reporting(E_ALL);
ini_set('display_errors', 1);
//echo"<b>Coming Soon ...</b>";die;
define('SERVER_ROOT', $_SERVER["DOCUMENT_ROOT"] . '/app');
//define('SITE_ROOT' , 'http://192.168.2.14/dialog/protected');
//echo SERVER_ROOT;die;
/**
 * Fetch the router
 */
require_once(SERVER_ROOT . '/controllers/router.php');

?>