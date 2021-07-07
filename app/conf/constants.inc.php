<?php

/* ==================================================================*\
  #Coder: Ankit sharma
  #Date : 25-09-2017
  \*================================================================== */
# ----------------------------------------------------------------------------------------------------
# VAC TITLE
# ----------------------------------------------------------------------------------------------------
define('VAC_TITLE', "Restaurant");

# ----------------------------------------------------------------------------------------------------
# DATE FORMAT - SET JUST ONE FORMAT
# Y - numeric representation of a year with 4 digits (xxxx)
# m - numeric representation of a month with 2 digits (01 - 12)
# d - numeric representation of a day of the month with 2 digits (01 - 31)
# ----------------------------------------------------------------------------------------------------
define('DEFAULT_DATE_FORMAT', "m/d/Y");

# ----------------------------------------------------------------------------------------------------
# FRIENDLY URL CONSTANTS
# IMPORTANT - PAY ATTENTION
# Any changes here need to be done in all .htaccess (modrewrite)
# ----------------------------------------------------------------------------------------------------
//define(FRIENDLYURL_SEPARATOR, "_");
//define(FRIENDLYURL_VALIDCHARS, "a-zA-Z0-9");
//define(FRIENDLYURL_REGULAREXPRESSION, "^[".FRIENDLYURL_VALIDCHARS.FRIENDLYURL_SEPARATOR."]{1,}$");
# ----------------------------------------------------------------------------------------------------
# IMAGE FOLDER CONSTANTS
# ----------------------------------------------------------------------------------------------------
define('IMAGE_RELATIVE_PATH', "/package/upload");
define('UPLOAD_DIR', VAC_ROOT . IMAGE_RELATIVE_PATH);
define('UPLOAD_URL', DEFAULT_URL . IMAGE_RELATIVE_PATH);
define('IMAGE_HEADER_PATH', "/images/img_logo.gif");

define('BROWSE_IMAGE_RELATIVE_PATH', "/browseImages");
define('BROWSE_IMAGE_DIR', VAC_ROOT . BROWSE_IMAGE_RELATIVE_PATH);
define('BROWSE_IMAGE_URL', DEFAULT_URL . BROWSE_IMAGE_RELATIVE_PATH);

# ----------------------------------------------------------------------------------------------------
# CONSTANTS
# ----------------------------------------------------------------------------------------------------
define('INCLUDES_DIR', VAC_ROOT . "/includes");
define('CLASSES_DIR', VAC_ROOT . "/app/models");
define('FUNCTIONS_DIR', VAC_ROOT . "/app/functions");
define('MODULES_PATH', VAC_ROOT . "/modules");
define('ADMIN_PATH', VAC_ROOT . "/" . MAIN_ADMIN_FOLDER);
define('CSS_DIR', DEFAULT_URL . "/package/css");
define('JS_DIR', DEFAULT_URL . "/package/js");
define('FONT_DIR', DEFAULT_URL . "/package/fonts");
define('IMAGE_DIR', DEFAULT_URL . "/package/images");
define('ASSETS_PATH', DEFAULT_URL . "/admin/assets");
define('LIB_PATH', DEFAULT_URL . "/package/imageScript");

# ----------------------------------------------------------------------------------------------------
# NOIMAGE
# ----------------------------------------------------------------------------------------------------
define('NOIMAGE_PATH', "/images");
define('NOIMAGE_NAME', "noimage");
define('NOIMAGE_IMGEXT', "gif");
define('NOIMAGE_CSSEXT', "css");
define('USER_PROFILE', "user");
define('PAGE_MANAGER_DETAIL_TBL', "page_manager");
define('PLEASE_SELECT', "Please Select");

# ----------------------------------------------------------------------------------------------------
# USER ATRIBUTES
# ----------------------------------------------------------------------------------------------------
//define messages for the site...
//$obj_profile=new settingModel();
//$admin=$obj_profile->selectByPk(1,'','smtp_username,smtp_password');
//print_r($admin);
//define('SMTP_USER', $admin->smtp_username);
//define('SMTP_PASSWORD', $admin->smtp_password);
?>