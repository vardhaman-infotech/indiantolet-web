<script language="JavaScript">
    $(document).ready(function(){
        alert("Hello");
        $('#BBT_email_admin').focus();
    });
</script>
<div id="login">
    <h1 style="color: WHITE;"><?= MAIN_SITE_NAME; ?> Admin Panel</h1>
    <div id="login_panel">
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" accept-charset="utf-8">		
            <div class="login_fields">
                <div class="field">
                    <label for="BBT_email_admin">Username</label>
                    <input type="text" name="BBT_email_admin" value="" id="BBT_email_admin" tabindex="1" placeholder="username" />		
                </div>


                <div class="field">
                    <label for="BBT_password_admin">Password <small><a href="javascript:;">Forgot Password?</a></small></label>
                    <input type="password" name="BBT_password_admin" value="" id="BBT_password_admin" tabindex="2" placeholder="password" />			
                </div>
            </div> <!-- .login_fields -->

            <div class="login_actions">
                <button name="submit_button" value="Login" type="submit" class="btn primary" tabindex="3">Login</button>

            </div>
        </form>
    </div> <!-- #login_panel -->		
</div> <!-- #login -->
