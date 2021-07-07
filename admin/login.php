<?php
require_once("../app/conf/config.inc.php");
if (!(isset($_GET['action'])))
    require_once("../app/conf/admin_session_check_home.inc.php");

include("modules/login/code/login_code.php");
?>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title><?php echo ucfirst(MAIN_SITE_NAME); ?> | Admin</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        <link href="<?= ASSETS_PATH ?>/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?= ASSETS_PATH ?>/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?= ASSETS_PATH ?>/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?= ASSETS_PATH ?>/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?= ASSETS_PATH ?>/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>/css/validationEngine.jquery.css" type="text/css"/>
        <!-- END PAGE LEVEL SCRIPTS -->

        <!-- BEGIN THEME STYLES -->
        <link href="<?= ASSETS_PATH ?>/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
        <link href="<?= ASSETS_PATH ?>/global/css/plugins.css" rel="stylesheet" type="text/css"/>
        <link href="<?= ASSETS_PATH ?>/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="<?= ASSETS_PATH ?>/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
        <link href="<?= ASSETS_PATH ?>/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="favicon.ico"/>
    </head>
    <body class="login">
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <div class="menu-toggler sidebar-toggler"></div>
        <!-- END SIDEBAR TOGGLER BUTTON -->
        <!-- BEGIN LOGO -->
        <div class="logo">
<!--             <h3 style="color: #000;">Food Delivery</h3>-->
    
            <a href="javascript:void(0);">  
                <div class="logo_login">
                    <img src="<?php echo IMAGE_DIR; ?>/logo.png" height="" width="" alt="logo_login" class="logo-default"> 
                </div>
            </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <?php if (isset($action) && $action == 'ChangePass') { ?>

                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Admin Forgot Password</h3>
                    </div>
                    <div class="panel-body">
                        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" accept-charset="utf-8" name="changepass_form" id="changepass_form">

                            <div class="form-group">
                                <input name="password" id="password" type="password" class="form-control validate[required] inputField" autocomplete="off" placeholder="New password"/><!---,custom[LetterNumberSpecial]------>
                            </div>
                            <div class="form-group">
                                <input name="re_pass" id="re_pass" type="password" class="form-control validate[required,equals[password]] inputField" autocomplete="off" placeholder="Confrim password"/>
                            </div>

                            <input type="hidden" value="<?= $adminId ?>" name="adminId"/>
                            <input type="hidden" value="<?= $action ?>" name="action"/>
                            <input type="hidden" value="Login" name="SubmitAdmin"/>
                            <input type="button" value="Submit"  name="SubmitAdmin1" id="SubmitAdmin1" class="btn btn-lg btn-success btn-block" style="float:left;"/>
                        </form>
                    </div>
                </div>
            <?php } else {
                ?>
                <!-- BEGIN LOGIN FORM -->
                <div  id="loginDiv">
                    <form id="login_form" name="login_form" class="login-form" accept-charset="utf-8" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                        <h3 class="form-title">Sign In</h3>
                        <div class="alert alert-danger display-hide" id="errorMsgDiv">
                            <button class="close" data-close="alert"></button>                    
                        </div>
                        <div class="alert alert-success display-hide" id="successMsgDiv">
                            <button class="close" data-close="alert"></button>                    
                        </div>
                        <div class="form-group">
                            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                            <label class="control-label visible-ie8 visible-ie9">Email</label>
                            <input class="form-control form-control-solid placeholder-no-fix validate[required]" type="text" autocomplete="off" placeholder="Username" name="admin_username" id="admin_username" />
                        </div>
                        <div class="form-group">
                            <label class="control-label visible-ie8 visible-ie9">Password</label>
                            <input class="form-control form-control-solid placeholder-no-fix validate[required]" type="password" autocomplete="off" placeholder="Password" name="password" id="password"/>
                        </div>
                       
                        <div class="form-actions text-center">
                            <input type="hidden" name="action" value="LoginAdmin">
                            <input type="hidden" name="SubmitAdmin" value="Login">
                            <button type="submit" id="SubmitAdmin2" name="SubmitAdmin2"  class="btn btn-success uppercase">Login</button>
                        </div>
                        <div class="create-account text-center">
                            <p>
                                <a href="javascript:"  class="forget-form uppercase" id="forgetpass">Forgot password</a>
                            </p>
                        </div>
                    </form>
                </div>
            <?php } ?>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM --> 
            <div  id="forgetpassdiv" style="display: none;">
             <h3 class="form-title">Forgot Password</h3>
                <form  id="forgetpass_form" name="login_form" accept-charset="utf-8" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                    <fieldset>
                        <div class="form-group">

                            <input name="email" id="email" type="email" class="form-control form-control-solid placeholder-no-fix validate[required,custom[email]] inputField" placeholder="E-mail Id" autocomplete="off" autofocus/>

                        </div>
                       
                        <!-- Change this to a button or input when using this as a form -->
                        <input type="hidden" name="action" value="ForgetPass"/>
                        <input type="hidden" name="SubmitAdmin" value="Submit"/>
                        <button class="btn btn-success" name="SubmitAdmin" id="SubmitAdmin" type="submit" value="SubmitAdmin">Submit</button>
                        <button class="btn btn-link" type="button" name="back" id="back">Back</button>

                    </fieldset>
                </form>
            </div>
            <!-- END FORGOT PASSWORD FORM -->            
        </div>

        <!-- END LOGIN -->
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        <!-- BEGIN CORE PLUGINS -->
        <!--[if lt IE 9]>
        <script src="assets/global/plugins/respond.min.js"></script>
        <script src="assets/global/plugins/excanvas.min.js"></script> 
        <![endif]-->
        <script src="<?= ASSETS_PATH ?>/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?= ASSETS_PATH ?>/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
        <script src="<?= ASSETS_PATH ?>/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?= ASSETS_PATH ?>/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?= ASSETS_PATH ?>/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="<?= ASSETS_PATH ?>/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->      

        <script src="<?php echo ADMIN_URL ?>/js/jquery.validationEngine.js"></script>
        <script src="<?php echo ADMIN_URL ?>/js/jquery.validationEngine-en.js"></script>
        <!-- BEGIN PAGE LEVEL SCRIPTS -->        
        <script src="<?= ASSETS_PATH ?>/global/scripts/metronic.js" type="text/javascript"></script>
        <script src="<?= ASSETS_PATH ?>/admin/layout/scripts/layout.js" type="text/javascript"></script>
        <script src="<?= ASSETS_PATH ?>/admin/layout/scripts/demo.js" type="text/javascript"></script>
        <script src="<?= ASSETS_PATH ?>/admin/pages/scripts/login.js" type="text/javascript"></script>

        <!-- END PAGE LEVEL SCRIPTS -->
<!--        <script>
            jQuery(document).ready(function() {
                Metronic.init(); // init metronic core components
                Layout.init(); // init current layout
                Demo.init();                
            });
            $(function() {
                $(document).keypress(function(e) {
                    if(e.which == 13) {
                        $('#login_form').submit();
                    }
                });
            });
        </script>-->
        <!-- END JAVASCRIPTS -->
    </body>
    <script type="text/javascript">
        $(function () {
            // $("#login_form").validationEngine();
            function showMessage(message) {
                $('#successMsgDiv').show().append(message);
                setTimeout(function () {
                    $('#successMsgDiv').slideUp('slow');
                }, 3000);
            }
            function errorMessage(message) {
                $('#errorMsgDiv').show().append(message);
                setTimeout(function () {
                    $('#errorMsgDiv').slideUp('slow');
                }, 3000);
            }
            $("#forgetpass_form").validationEngine();
            $("#login_form").validationEngine();
            $("#changepass_form").validationEngine();

            $("#forgetpass").click(function () {

                $("#loginDiv").fadeOut("slow", function () {
                    $("#forgetpassdiv").fadeIn("slow");
                });
            });

            $("#back").click(function () {
                $("#forgetpassdiv").fadeOut("slow", function () {
                    $("#loginDiv").fadeIn("slow");
                });
            });

            $("body").delegate('.formError', "click", function () {
                $(this).fadeOut(150, function () {
                    // remove prompt once invisible
                    $(this).remove();
                });
            });
            $('.forgot').click(function () {
                $('#login_form').validationEngine('hideAll');
            });
            $('#SubmitAdmin2').click(function () {
                $('#login_form').submit();
            });
            $('#SubmitAdmin').click(function () {
                $('#forgetpass_form').submit();
            });
            $('#SubmitAdmin1').click(function () {
                $('#changepass_form').submit();
            });

            $(document).keypress(function (e) {
                if (e.which == 13) {
                    if ($("#loginDiv").is(":visible"))
                        $('#login_form').submit();
                    else if ($("#forgetpassdiv").is(":visible"))
                        $('#forgetpass_form').submit();
                    else
                        $('#changepass_form').submit();

                }
            });

<?php
if (isset($successMsg)) {
    echo "showMessage('$successMsg');";
} else if (isset($errorMsg)) {
    echo "errorMessage('$errorMsg');";
}
?>
        });
    </script>
</html>
