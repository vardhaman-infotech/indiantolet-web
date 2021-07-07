<div class="page-content">
    <!-- BEGIN PAGE HEAD -->
    <div class="col-sm-12">
    <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>User Account </h1>
            </div>
            <!-- END PAGE TITLE -->
            <!-- BEGIN PAGE TOOLBAR -->
            <div class="page-toolbar">
                <!-- BEGIN THEME PANEL -->
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <a href="javascript:;">Home</a><i class="fa fa-circle"></i>
                    </li>
                    <li class="active">
                        User Account
                    </li>
                </ul>
                <!-- END THEME PANEL -->
            </div>
            <!-- END PAGE TOOLBAR -->
        </div>
    </div>
    </div>
    <!-- END PAGE HEAD -->
    <!-- BEGIN PAGE CONTENT -->
    <div class="">
        <div class="container-fluid">
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            Widget settings form goes here
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn blue">Save changes</button>
                            <button type="button" class="btn default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="row margin-top-10">
                <div class="col-md-12">
                    <!-- BEGIN PROFILE CONTENT -->
                    <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light">
                                    <div class="alert alert-success alert-dismissable" style="display:none;" id="successMsgDiv">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    </div>
                                    <div class="alert alert-danger alert-dismissable" style="display:none;" id="errorMsgDiv">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    </div>
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-globe theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                        </div>
                                        <ul class="nav nav-tabs">
                                        <!-------Admin Link ---------------->
                                            <li class="active">
                                                <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_2" data-toggle="tab">Setting</a>
                                            </li>
                                          <!-------End Admin Link ---------------->
                                        </ul>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tab-content">
                                            <!-- PERSONAL INFO TAB -->
                                            <div class="tab-pane active" id="tab_1_1">
                                                <form id="profile_form" name="profile_form" accept-charset="utf-8" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                                                    <div class="form-group">
                                                        <label class="control-label">Full Name </label>
                                                        <input type="text" placeholder="Name" class="form-control validate[required]" name="admin_fullname" id="name" value="<?= $admin_data->admin_fullname; ?>"/>
                                                    </div>
                                                   
                                                    <div class="form-group">
                                                        <label class="control-label">Email Address</label>
                                                        <input type="text" placeholder="email@email.com" class="form-control validate[required]" name="admin_email" id="admin_email" value="<?= $admin_data->admin_email; ?>"/>
                                                    </div>                                                    
                                                    <div class="form-group">
                                                        <label class="control-label"> Address</label>
                                                        <input type="text" placeholder="Address" class="form-control validate[required]" name="admin_address" id="admin_address" value="<?= $admin_data->admin_address; ?>"/>
                                                    </div>    
                                                       
                                                                                                  

                                                    <div class="margiv-top-10">    
                                                        <input type="hidden" value="submit" name="profileSubmit">
                                                        <button class="btn green-haze" type="submit" id="SubmitProfile" name="SubmitProfile">Save Changes</button>
                                                        <button class="btn default" type="reset">Reset</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END PERSONAL INFO TAB -->
                                            <!-- CHANGE PASSWORD TAB -->
                                            <div class="tab-pane" id="tab_1_3">
                                                
                                                <form id="change_password_form" name="change_password_form" accept-charset="utf-8" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                                                    <div class="form-group">
                                                        <label class="control-label">Current Password</label>
                                                        <input type="password" class="fild form-control validate[required]"   name="old_password" id="old_password"/>
                                                    </div>                                                        
                                                    <div class="form-group">
                                                        <label class="control-label">New Password</label>
                                                        <input type="password" class="fild form-control validate[required]" name="new_password" id="new_password"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Re-type New Password</label>
                                                        <input type="password" name="c_password" id="c_password" class="fild form-control validate[required,equals[new_password]]"/>
                                                    </div>
                                                    <div class="margin-top-10">                                                        
                                                        <input type="hidden" value="submit" name="passwordChange">
                                                        <button class="btn green-haze" type="submit" id="changePassword" name="changePassword">Change Password</button>
                                                        <button class="btn default" type="reset">Reset</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="tab_1_2">
                                                
                                                <form id="setting_form" name="setting_form" accept-charset="utf-8" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                                                    <div class="form-group">
                                                        <label class="control-label">Property Commission</label>
                                                        <input type="text" class="fild form-control validate[required,custom[number]]"   name="property_commission" id="property_commission" value="<?= $admin_data->property_commission; ?>"/>
                                                    </div>                                                        
                                                     
                                                    <div class="margin-top-10">                                                        
                                                        <input type="hidden" value="submit" name="Commission_Setting">
                                                        <button class="btn green-haze" type="submit" id="submit_setting" name="submit_setting">Submit</button>
                                                        <button class="btn default" type="reset">Reset</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END CHANGE PASSWORD TAB -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PROFILE CONTENT -->
                </div>
            </div>
            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
    <!-- END PAGE CONTENT -->
</div>

<!--------Form Validation---------------->
<script type="text/javascript">
    $(function () {
        $("#profile_form").validationEngine();
        $("#change_password_form").validationEngine();        
    });
$("body").delegate('.formError',"click", function() {
    $(this).fadeOut(150, function() {
        // remove prompt once invisible
       $(this).remove();
    });
});
</script>
<style> .fild {  width: 90% !important;   } </style>