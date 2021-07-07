<?php
/* ==================================================================*\
  #   coder:vikram solanki
  Date : 29/10/2016
  \*================================================================== */
# ----------------------------------------------------------------------------------------------------
# INCLUDE GLOBAL CONSTANTS
# ----------------------------------------------------------------------------------------------------

require(VAC_ROOT . "/app/conf/constants.inc.php");
# ----------------------------------------------------------------------------------------------------
# INCLUDE GLOBAL CLASSES
# ----------------------------------------------------------------------------------------------------

require(CLASSES_DIR . "/PHPMailerModel.php");
//require("admin_session_check.inc.php");
//include_once(CLASSES_DIR . "/db_class/db.class.php");

function __autoload($className) {
    //parse out filename where class should be located
    //echo $className;
    $new_message=splitAtUpperCase($className);
    $suffix = end($new_message);
    //echo $suffix.'<br />';
    //list($filename , $suffix) = preg_split('/_/' , $className);
    //$filename = rtrim($className, $suffix);
    $filename = $className;
    //echo $filename.'<br />';
    //select the folder where class should be located based on suffix
    switch (strtolower($suffix)) {
        case 'model':

            $folder = '/models/';

            break;

        case 'library':

            $folder = '/libraries/';

            break;

        case 'lib':

            $folder = '/libraries/db/';

            break;

        case 'driver':

            $folder = '/libraries/drivers/';

            break;
    }

    //compose file name
    //$file = SERVER_ROOT . $folder . strtolower($filename) . '.php';
    $file = SERVER_ROOT . $folder . ($filename) . '.php';
    //echo $file."<br />";
    //fetch file
    if (file_exists($file)) {
        //get file
        include_once($file);
    }
    else {
        //file does not exist!
        //die("File '$filename' containing class '$className' not found in '$folder'.");
    }
}


# ----------------------------------------------------------------------------------------------------
# INCLUDE GLOBAL FUNCTIONS
# ----------------------------------------------------------------------------------------------------
require(FUNCTIONS_DIR . '/system_funct.php');
require(FUNCTIONS_DIR . '/time_funct.php');
require(FUNCTIONS_DIR . '/functions.php');
//require(FUNCTIONS_DIR . '/common_functions.php');
require_once(VAC_ROOT . '/app/lib/class.htmlhelper.php');
require_once(VAC_ROOT . '/app/lib/class.simpleimage.php');
//require_once(VAC_ROOT . '/app/lib/class.paypal.php');
require_once(VAC_ROOT . '/app/controllers/APController.php');