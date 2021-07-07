<style>
    em { color: red; }
</style>
<div class="page-content">
    <div class="col-sm-12">
        <div class="page-head">
            <div class="container">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1> Email Template <?php echo (isset($action) && $action == "editEmails") ? "Edit" : "Add" ?></h1>

                </div>
                <!-- END PAGE TITLE -->
              
            </div>
        </div>
    </div>
    <div class="">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable tabbable-custom tabbable-noborder tabbable-reversed">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <form class='form-horizontal' name='emailsForm' id='emailsForm' method='post' action='' enctype='multipart/form-data'>
                                    <div class="portlet light">                                        
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-basket font-green-sharp"></i>
                                                <span class="caption-subject font-green-sharp bold uppercase">
                                                    <?php echo (isset($action) && $action == "editEmails") ? "Edit" : "Add" ?> Email Template </span>
<!--                                                <span class="caption-helper">Man Tops</span>-->
                                            </div>
                                            <div class="actions btn-set">

                                                <button type="button" name="back" class="btn btn-default btn-circle" onclick="javascript:history.go(-1)">
                                                    <i class="fa fa-angle-left"></i> Back
                                                </button>
                                                <button class="btn btn-default btn-circle " type="reset">
                                                    <i class="fa fa-reply"></i> Reset
                                                </button>
                                                <input type="submit" name="submitEmails" class="btn green-haze btn-circle" value="Save">
                                            </div>
                                        </div>
                                        <div class="portlet-body form">    
                                            <div class="alert alert-success alert-dismissable" style="display:none;" id="successMsgDiv">
                                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                            </div>
                                            <div class="alert alert-danger alert-dismissable" style="display:none;" id="errorMsgDiv">
                                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                            </div>                                           
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Email For</label>
                                                    <div class="col-md-8">
                                                        <input type="text" placeholder="Enter Email for" class="form-control validate[required]" name="email_for" id="email_for" value="<?php echo (isset($email_for) ? $email_for : "") ?>">
                                                        <input  type='hidden' name='existingData' id='existingData' value='<?php echo (isset($email_for) ? $email_for : "") ?>'>
                                                        <div class="clearBoth"></div>
                                                        <span id='AlreadyExists' style='color: red; display: none;'>Email for Already Exists</span>
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Email Subject</label>
                                                    <div class="col-md-8">
                                                        <input type="text" placeholder="Enter Email Subject" class="form-control validate[required]" name="email_subject" id="email_subject" value="<?php echo (isset($email_subject) ? $email_subject : "") ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Email Description</label>
                                                    <div class="col-md-8">
                                                        <em>*Email Note:Please don't change the words which starts with @ sign</em>
                                                        <textarea class="ckeditor form-control" name="email_description" id="email_description" rows="6"><?php echo (isset($email_description) ? $email_description : "") ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Status</label>
                                                    <div class="col-md-8">
                                                        <div class="md-radio-inline">
                                                            <div class="md-radio">
                                                                <input type="radio" id="radio6" name="is_active" class="md-radiobtn" <?php echo isset($is_active) ? $is_active != '0' ? 'checked' : ''  : 'checked' ?> value="1">
                                                                <label for="radio6">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span>
                                                                    Active 
                                                                </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                <input type="radio" id="radio7" name="is_active" class="md-radiobtn" <?php echo isset($is_active) ? $is_active == '0' ? 'checked' : ''  : '' ?> value="0">
                                                                <label for="radio7">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span>
                                                                    Inactive 
                                                                </label>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <input type="hidden" name="action" id="action" value="<?= $action ?>">
                                                        <input type="hidden" name="emailsID" id="emailsID" value="<?= isset($emailsId) ? $emailsId : '' ?>">
                                                        <input type="submit" class="btn btn-primary green" value="Save" name="submitEmails" id="submitEmails">
                                                        <input type="reset" class="btn btn-default" value="RESET" name="reset">
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!------------------------------------------------------------------------------------------------>

<script type="text/javascript">
    $(function(){
        $('input[type="text"]:first').focus();
        $("#emailsForm").validationEngine();
    });
</script>
<script type='text/javascript'>
    jQuery(document).ready(function($) {
        $('#email_for').bind("keyup click change", function() {
            var newData = $(this).val();
            var existingData = $('#existingData').val();
            $.post("<?php echo ADMIN_URL ?>/modules/emails/ajax/ajax_email_for.php", {newData: newData, existingData: existingData}, function(data) {
                if (data == true) {
                    $('#AlreadyExists').show();
                    $('input[type=submit]').addClass("disabled");
                    $('input[type=submit]').attr("disabled", true);
                } else {
                    $('#AlreadyExists').hide();
                    $('input[type=submit]').removeClass("disabled");
                    $('input[type=submit]').attr("disabled", false);
                }
            });
        });
    });
</script>
