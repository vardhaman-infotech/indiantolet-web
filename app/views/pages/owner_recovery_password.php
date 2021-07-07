<?php
if (isset($data)) {
    $data = (array) $data;
    extract($data);
}
?>
<!--<script src="<?php echo JS_DIR; ?>/jquery-1.11.3.min.js"></script>-->
<script src="<?php echo JS_DIR; ?>/jquery.min.js"></script> 
<!--<script src="<?php echo JS_DIR; ?>/validate.min.js"></script>-->
<script src="<?php echo JS_DIR; ?>/jquery.validate.min.js"></script>
<html>
    <body class="login">
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <div class="menu-toggler sidebar-toggler"></div>
        <!-- END SIDEBAR TOGGLER BUTTON -->
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="javascript:void(0);"> 
                <!--
                <div class="logo_login">
                    <h2 style="color: #fff;">Marketing Tracker</h2>
                </div>-->

                <div class="logo_login">
                    <img src="<?php echo IMAGE_DIR; ?>/logo.png" height="" width="" alt="logo_login" class="logo-default">
                    <!--                     <h2 style="color: #000;">Fresh Pro</h2>-->
                </div>
            </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <div id="loginDiv">
                <form id="resetPass_form" name="resetPass_form" class="login-form" accept-charset="utf-8" method="post" action="<?php echo DEFAULT_URL; ?>/farmer/resetpassword">
                    <h3 class="form-title">Reset Password</h3>
                    <h5>You need to enter 6-digit code to reset password sent on your registered mobile number.</h5>
                    <div>
                        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                        <p>New Password</p> 
                        <input class="" type="password" autocomplete="off" placeholder="New Password" name="new_pass" id="new_pass">
                    </div>
                    <div>
                        <p> Confirm Password</p>
                        <input class="" type="password" autocomplete="off" placeholder="Confirm Password" name="con_password" id="con_password">
                    </div>
                    <div class="ForOtp" style="display: block">
                        <p> Enter Otp ( Your Otp:- <?php echo (isset($otp) ? $otp : "") ?>)</p>
                        <input class="" type="text" autocomplete="off" placeholder="Enter Otp" name="otp" id="otp">


                        <div class="form-actions text-center"> 
                            <input type="hidden" id="farmerID" name="farmerID" value="<?php echo (isset($farmer_id) ? $farmer_id : ""); ?>">
                            <input type="submit" id="Submit" name="Submit" value="Submit" class="btn btn-success uppercase">
                            <!--                        <button type="submit" id="Submit" name="Submit" value="submit" class="btn btn-success uppercase">Submit</button>-->
                        </div>
                    </div>
<!--                    <div class="form-actions text-center otpButton"> 
                        <a href="javascript:" class="btn btn-success uppercase" id="enterotp" name="enterotp">Submit</a>
                        

                    </div>-->

                </form>
            </div>

            <script>
                $('#enterotp').click(function () {
                    $('.otpButton').css('display', 'none');
                    $('.ForOtp').css('display', 'block');
                });
            </script>
            <!-- END LOGIN FORM -->

        </div>




    </body>
</html>

<script>
    $().ready(function () {
        jQuery("#resetPass_form").validate({
            rules: {
                new_pass: {
                    required: true,
                },
                con_password: {
                    required: true,
                    equalTo: "#new_pass"
                },
                otp: {
                    required: true
                }
            },
            submitHandler: function (form) {
                form.submit();
                //$("#forgetForm").submit();
            }
        });
    })
</script>

<style>
      h5{font-size: 15px;
    text-align: center;    
    color: #429473;
}
    .error{color: red}
    .login .logo {
        margin: 60px auto 45px;
        padding: 15px;
        text-align: center;
    }
    .login .logo {
        margin: 60px auto 45px;
        padding: 15px;
        text-align: center;
    }
    .login .content {
        -webkit-border-radius: 7px;
        -moz-border-radius: 7px;
        -ms-border-radius: 7px;
        -o-border-radius: 7px;
        border-radius: 7px;
        width: 400px;
        margin: -60px auto 10px auto;
        padding: 30px;
        padding-top: 10px;
        overflow: hidden;
        position: relative;
    }
    .login .content .login-form, .login .content .forget-form {
        padding: 0px;
        margin: 0px;
    }
    .login .content h3 {
        color: #4db3a5;
        text-align: center;
        font-size: 28px;
        font-weight: 400 !important;
    }
    #loginDiv{text-align: left}
    #loginDiv input{ height: 45px;
                     border-radius: 0px;
                     padding: 6px 132px 6px 12px;
                     margin: 0px 0 4px;
                     border: 1px solid #dadada;
                     box-shadow: none;
                     background: #fff;
                     font-size: 14px;
                     width: 100%;}
    #loginDiv p{ text-align: left;
                 margin-bottom: 9px;}
    #loginDiv .btn-success{    background: #6cbd47;
                               border-radius: 4px;
                               padding: 7px 27px;
                               font-size: 21px;
                               color: #fff;
                               border: none;
                               text-align: center;
                               margin: 0 auto;
                               margin-top: 20px;
    }
    .otpButton .btn-success{
        position: relative;
        top: 20px;
        text-decoration: none;
    }
</style>