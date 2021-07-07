<?php

/* ==================================================================*\
  #   coder:vikram solanki
  Date : 29/01/2016
  \*================================================================== */
# ----------------------------------------------------------------------------------------------------
# INCLUDE GLOBAL CONSTANTS
# ----------------------------------------------------------------------------------------------------

require(VAC_ROOT . "/app/conf/constants.inc.php");
# ----------------------------------------------------------------------------------------------------
# INCLUDE GLOBAL CLASSES
# ----------------------------------------------------------------------------------------------------
require(CLASSES_DIR . "/PHPMailerModel.php");

spl_autoload_register(function($class) {
    $new_string = splitAtUpperCase($class);
    $suffix = end($new_string);
    if (file_exists(CLASSES_DIR . "/" . $class . ".php")) {
        include(CLASSES_DIR . "/" . $class . ".php");
    } else {
        die($class . 'Class Not exists');
    }
});


/*function __autoload($class) {
    $new_string = splitAtUpperCase($class);
    $suffix = end($new_string);
    if (file_exists(CLASSES_DIR . "/" . $class . ".php")) {
        include(CLASSES_DIR . "/" . $class . ".php");
    } else {
        die($class . 'Class Not exists');
    }
}*/

# ----------------------------------------------------------------------------------------------------
# INCLUDE GLOBAL FUNCTIONS
# ----------------------------------------------------------------------------------------------------
require(FUNCTIONS_DIR . '/system_funct.php');
require(FUNCTIONS_DIR . '/time_funct.php');
require(FUNCTIONS_DIR . '/functions.php');

function splitAtUpperCase($s) {
    return preg_split('/(?=[A-Z])/', $s, -1, PREG_SPLIT_NO_EMPTY);
}

