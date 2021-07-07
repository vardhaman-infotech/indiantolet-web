<div class="page-content">
    <div class="col-sm-12">
        <div class="page-head">
            <div class="container">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>City <?php echo (isset($action) && $action == "editCity") ? "Edit" : "Add" ?> <small>create & edit city</small></h1>

                </div>

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
                                <form class='form-horizontal' name='cityForm' id='cityForm' method='post' action='' enctype='multipart/form-data'>
                                    <div class="portlet light">

                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-basket font-green-sharp"></i>
                                                <span class="caption-subject font-green-sharp bold uppercase">
                                                    <?php echo (isset($action) && $action == "editCity") ? "Edit" : "Add" ?> City </span>
<!--                                                <span class="caption-helper">Man Tops</span>-->
                                            </div>
                                            <div class="actions btn-set">

                                                <button type="button" name="back" class="btn btn-default btn-circle" onclick="javascript:history.go(-1)">
                                                    <i class="fa fa-angle-left"></i> Back
                                                </button>
                                                <button class="btn btn-default btn-circle " type="reset">
                                                    <i class="fa fa-reply"></i> Reset
                                                </button>
                                                <input type="submit" name="submitCity" class="btn green-haze btn-circle" value="Save">

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
                                                    <label class="col-md-3 control-label">City Name</label>
                                                    <div class="col-md-8">
                                                        <input type="text" placeholder="Enter City Name" class="form-control validate[required]" name="name" id="name" value="<?php echo (isset($name) ? $name : "") ?>">
                                                        <input  type='hidden' name='existingData' id='existingData' value='<?php echo (isset($name) ? $name : "") ?>'> 
                                                        <div class="clearBoth"></div>
                                                        <span id='AlreadyExists' style='color: red; display: none;'>City Name Already Exists</span>
                                                    </div>
                                                </div>
                                                <!--                                                 validate[required]-->


                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Status</label>
                                            <div class="col-md-8">
                                                <div class="md-radio-inline">
                                                    <div class="md-radio">
                                                        <input type="radio" id="radio6" name="is_active" class="md-radiobtn" <?php echo isset($is_active) ? $is_active != '0' ? 'checked' : '' : 'checked' ?> value="1">
                                                        <label for="radio6">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span>
                                                            Active 
                                                        </label>
                                                    </div>
                                                    <div class="md-radio">
                                                        <input type="radio" id="radio7" name="is_active" class="md-radiobtn" <?php echo isset($is_active) ? $is_active == '0' ? 'checked' : '' : '' ?> value="0">
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
                                                <input type="hidden" name="cityID" id="cityID" value="<?= isset($cityId) ? $cityId : '' ?>">
                                                <input type="submit" class="btn btn-primary green" value="Save" name="submitCity" id="submitCity">
                                                <input type="reset" class="btn btn-default" value="RESET" name="reset">
                                            </div>
                                        </div>
                                    </div>
                                    <!--                                        </form>                            -->
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('input[type="text"]:first').focus();
        $("#cityForm").validationEngine();
    });
</script>
<script type='text/javascript'>
    jQuery(document).ready(function ($) {
        $('#name, input[type="reset"]').bind("keyup click change", function () {
            var newData = $(this).val();
            var existingData = $('#existingData').val();
            $.post("<?php echo ADMIN_URL ?>/modules/city/ajax/ajax_city_name.php",
                    {
                        newData: newData,
                        existingData: existingData,
                        city_id: '<?php echo (isset($cityId) && !empty($cityId)) ? $cityId : ''; ?>',
                        field: 'city_name'
                    }, function (data) {
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

<!--  
 
<script type="text/javascript">
 function processForm() { 
    $.ajax( {
        type: 'POST',
        url: '<?php echo ADMIN_URL ?>/modules/city/ajax/check.php',
        data: { is_featured : $('input:checkbox:checked').val()},

        success: function(data) {
            $('#message').html(data);
           
        }
    } );
}
</script>-->