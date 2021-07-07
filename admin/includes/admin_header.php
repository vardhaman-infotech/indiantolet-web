

<!--/* ==================================================================*\
       Coder: Ankit Sharma
       Date : 10-May-2017
       Purpose : This is header for admin
       \*================================================================== */-->
<?php
$obj_admin = new adminModel();
$headerProfile='';
if (isset($_SESSION['admin_Id']) && !empty($_SESSION['admin_Id'])) {
    $headerProfile = $obj_admin->selectByPk($_SESSION['admin_Id']);
}

 

////////////Active Page 
$currentPageName = basename($_SERVER['PHP_SELF']);
$masterCollapse = $countryCollapse = '';
$homeActive = "";
$emailsActive = ""; 
$usersActive = "";
$ownerActive = "";
//$masterActive="";







/////////////////Active Page Selected
if ($currentPageName == "home.php") {
    $homeActive = "active";
} else if ($currentPageName == "emails.php") {
    $emailsActive = "active";
} else if ($currentPageName == "users.php") {
    $usersActive = "active";
} else if ($currentPageName == "owner.php") {
    $ownerActive = "active";
}  
?>
<!-----------------Html---------------------------->
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title> <?php echo ucfirst(MAIN_SITE_NAME); ?> </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <script src="<?= ASSETS_PATH ?>/global/plugins/jquery.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>/css/validationEngine.jquery.css" type="text/css"/>

        <script src="<?php echo ADMIN_URL ?>/js/jquery.validationEngine.js"></script>
        <script src="<?php echo ADMIN_URL ?>/js/jquery.validationEngine-en.js"></script>
        <script src="<?php echo ADMIN_URL ?>/js/moment.min.js"></script>
        <script src="<?php echo ADMIN_URL ?>/js/daterangepicker.js"></script>
        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>/css/daterangepicker.css" type="text/css"/>
        <script src="<?php echo ADMIN_URL ?>/js/jscolor.js"></script>
        <script src="<?php echo ADMIN_URL ?>/js/bootstrap-multiselect.js"></script>
        <script src="<?php echo JS_DIR ?>/bootbox.js"></script>

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
        <link href="<?= ASSETS_PATH ?>/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="<?= ASSETS_PATH ?>/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
        <link href="<?= ASSETS_PATH ?>/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?= ASSETS_PATH ?>/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link rel="stylesheet" type="text/css" href="<?= ASSETS_PATH ?>/global/plugins/select2/select2.css"/>
        <link rel="stylesheet" type="text/css" href="<?= ASSETS_PATH ?>/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="<?= ASSETS_PATH ?>/global/plugins/bootstrap-datepicker/css/datepicker.css"/>
        <link rel="stylesheet" type="text/css" href="<?= ASSETS_PATH ?>/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
        <link href="<?= ASSETS_PATH ?>/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME STYLES -->
        <link href="<?= ASSETS_PATH ?>/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css">
        <link href="<?= ASSETS_PATH ?>/global/css/plugins.css" rel="stylesheet" type="text/css">
        <link href="<?= ASSETS_PATH ?>/admin/layout/css/layout.css" rel="stylesheet" type="text/css">
        <link href="<?= ASSETS_PATH ?>/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
        <link href="<?= ASSETS_PATH ?>/admin/layout/css/custom.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="<?= ASSETS_PATH ?>/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
        <link href="<?= ASSETS_PATH ?>/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="favicon.ico"/>   


        <script>

            function footerAlign() {
                $('.page-footer ').css('display', 'block');
                $('.page-footer ').css('height', 'auto');
                var footerHeight = $('.page-footer ').outerHeight();
                $('body').css('padding-bottom', footerHeight);
                $('.page-footer ').css('height', footerHeight);
            }
            $(document).ready(function () {
                footerAlign();
            });

            $(window).resize(function () {
                footerAlign();
            });
        </script>
    </head>
    <body>
        <?php
        //print_r($_SESSION);
        $clsS = "";
        $clsO = "";
        if (isset($_SESSION['small'])) {
            $clsS = $_SESSION['small'];
            $clsO = $_SESSION['large'];
        }
        ?>
        <script type="text/javascript">
        </script>    
        <!-- BEGIN HEADER -->
        <div class="page-header">
            <!-- BEGIN HEADER TOP -->
            <div id="small" class="page-header-top <?php echo $clsS; ?>">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <div class="container-fluid">
                        <a href="<?php echo ADMIN_URL ?>/home.php">
                            <!--                            <h3 style="font-size: 20px; margin-left: 40px; margin-top: 17px;">Food Delivery</h3>-->
                            <img src="<?php echo IMAGE_DIR; ?>/logo.png" height="45px" width="150px" alt="logo" class="logo-default">
                        </a>
                        <a id="openclose" class="menu-toggler"></a>
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <ul class="nav navbar-nav pull-left">
                    <p class="pull-left" style="padding: 0 15px 0;margin: 12px;font-size:15px;color:green;"><b><?php echo ucfirst(MAIN_SITE_NAME); ?></b></p>
                </ul> 
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <div class="container-fluid">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <!-- END TODO DROPDOWN -->
                            <li class="droddown dropdown-separator">
                                <span class="separator"></span>                            
                            </li>
                            <!-- BEGIN INBOX DROPDOWN -->
                            <!-- END INBOX DROPDOWN -->
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"data-close-others="true">
                                    <!--------------------Admin Name---------------------->
                                    <span class="username username-hide-mobile">
                                        <?php echo ucfirst($headerProfile->admin_fullname); ?>
                                    </span>
                                    <!--------------------End Admin Name---------------------->    
                                </a>
                                <!--------------------Admin Link ---------------------->
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="<?php echo ADMIN_URL ?>/profile.php">
                                            <i class="icon-user"></i> My Profile </a>
                                    </li>                               
                                    <li class="divider">
                                    </li>
                                    <li>
                                        <a href="<?php echo ADMIN_URL ?>/login.php?action=logout">
                                            <i class="icon-key"></i> Log Out </a>
                                    </li>
                                </ul>
                                <!--------------------End Admin Link ---------------------->            
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                        </ul>
                    </div>
                </div>
                <!-- END TOP NAVIGATION MENU -->

            </div>
            <!-- END HEADER TOP -->
            <!-- BEGIN HEADER MENU -->
            <div id="open" class="page-container <?php echo $clsO; ?>">

                <div class="page-header-menu">
                    <div class="hor-menu ">
                        <ul class="nav navbar-nav">

                            <li class="start <?php echo $homeActive; ?>">
                                <a href="<?php echo ADMIN_URL ?>/home.php">
                                    <i class="icon-home"></i>
                                    <span class="title">Dashboard</span>
                                </a>
                            </li>

                            <li class="start menu-dropdown classic-menu-dropdown parent_users <?php echo $masterActive; ?>">
                                <a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;">
                                    <i class="fa fa-folder" aria-hidden="true"></i>
                                    <span class="title">Master Management</span>
                                    <span class="arrow"> </span>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <!------Email Model ----------> 
                                    <li class="dropdown-submenu <?php echo $emailsActive; ?>">
                                        <a  href="javascript:;"><i class="fa fa-envelope"></i>
                                            Email Templates
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="<?php echo ADMIN_URL ?>/emails.php">
                                                    Manage Email Templates
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo ADMIN_URL ?>/emails.php?action=addEmails">
                                                    Add Email Templates
                                                </a>
                                            </li>
                                        </ul>
                                    </li> 
                                     
<!--                                    <li class="dropdown-submenu <?php echo $property_typeActive; ?>">
                                        <a  href="javascript:;"><i class="fa fa-envelope"></i>
                                            Property Type
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="<?php echo ADMIN_URL ?>/property_type.php">
                                                    Manage Property Type
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo ADMIN_URL ?>/property_type.php?action=addProperty_type">
                                                    Add Property Type
                                                </a>
                                            </li>
                                        </ul>
                                    </li> -->
                                    <!--------------End Loan Link-------------------->

                                </ul>
                            </li>  
                            <!--------------User Link-------------------->
                            <li class="start menu-dropdown classic-menu-dropdown parent_users <?php echo $usersActive; ?>">
                                <a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                    <span class="title">Users</span>
                                    <span class="arrow"> </span>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <!--end-->
                                    <li>
                                        <a href="<?php echo ADMIN_URL ?>/users.php">
                                            Manage User
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo ADMIN_URL ?>/users.php?action=addUser">
                                            Add New User
                                        </a>
                                    </li>                                        
                                </ul>
                            </li> 
                            <li class="start menu-dropdown classic-menu-dropdown parent_users <?php echo $ownerActive; ?>">
                                <a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;">
                                    <i class="fa fa-sellsy" aria-hidden="true"></i>
                                    <span class="title">Owner</span>
                                    <span class="arrow"> </span>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <!--end-->
                                    <li>
                                        <a href="<?php echo ADMIN_URL ?>/owner.php">
                                            Manage Owner
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo ADMIN_URL ?>/owner.php?action=addOwner">
                                            Add New Owner
                                        </a>
                                    </li>                                        
                                </ul>
                            </li> 
                            <li class="start menu-dropdown classic-menu-dropdown parent_users <?php echo $propertyActive; ?>">
                                <a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;">
                                    <i class="fa fa-sellsy" aria-hidden="true"></i>
                                    <span class="title">Property</span>
                                    <span class="arrow"> </span>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <!--end-->
                                    <li>
                                        <a href="<?php echo ADMIN_URL ?>/property.php">
                                           List Of Property
                                        </a>
                                    </li>
                                                                      
                                </ul>
                            </li> 
                              
                            <!--------------End User Link-------------------->
                            <!--------------View Loan Request-------------------->

                            <!-- END MEGA MENU -->
                        </ul>
                    </div>
                    <!-- END HEADER MENU -->
                </div>
                <!-- END HEADER -->                   
                <script>
                    var ADMIN_URL = "<?php echo ADMIN_URL ?>";
                </script>
