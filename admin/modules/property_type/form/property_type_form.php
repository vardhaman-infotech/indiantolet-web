<style type="text/css">
    #s2id_country_code{
        width:80px;
    }
</style>
<div class="page-content">
    <div class="col-sm-12">
        <div class="page-head">
            <div class="container">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1> Property type <?php echo (isset($action) && $action == "editProperty_type") ? "Edit" : "Add" ?> <small>create & edit property type</small></h1>

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
                                <form class='form-horizontal' name='property_typeForm' id='property_typeForm' method='post' action='' enctype='multipart/form-data'>
                                    <div class="portlet light">                                        
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-property_type font-green-sharp"></i>
                                                <span class="caption-subject font-green-sharp bold uppercase">
                                                    <?php echo (isset($action) && $action == "editProperty_type") ? "Edit" : "Add" ?> Property type </span>

                                            </div>

                                            <div class="actions btn-set">

                                                <button type="button" name="back" class="btn btn-default btn-circle" onclick="javascript:history.go(-1)">
                                                    <i class="fa fa-angle-left"></i> Back
                                                </button>
                                                <button class="btn btn-default btn-circle " type="reset">
                                                    <i class="fa fa-reply"></i> Reset
                                                </button>
                                                <input type="submit" name="submitProperty_type" class="btn green-haze btn-circle" value="Save">

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
                                                    <label class="col-md-3 control-label"> Name</label> 
                                                    <div class="col-md-5"> 
                                                        <input type="text" placeholder="Name" class="form-control validate[required]" name="name" id="name" value="<?php echo (isset($name) ? $name : "") ?>">
                                                        <input  type='hidden' name='Name' id='Name' value='<?php echo (isset($name) ? $name : "") ?>'>
                                                        <div class="clearBoth"></div>
                                                        <span id='AlreadyExists' style='color: red; display: none;'>Property Type Already Exists</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Status</label>
                                                    <div class="col-md-5">
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
                                                        <input type="hidden" name="property_typeID" id="property_typeID" value="<?= isset($property_typeId) ? $property_typeId : '' ?>">
                                                        <input type="submit" class="btn btn-primary green" value="Save" name="submitProperty_type" id="submitProperty_type">
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
    $(function () {
        $('input[type="text"]:first').focus();
        $("#property_typeForm").validationEngine();
    });

    jQuery(document).ready(function ($) {
        var date = new Date();
        var edate = new Date();
        var enabl = 64 * 365;
        var enabl1 = 18 * 365;
        date.setDate(date.getDate() - enabl);
        edate.setDate(date.getDate() - enabl1);
        $('#birth_date').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            //startDate: date,
            //endDate: edate,
            endDate: '+0d',
        });
    });

</script>
<script type='text/javascript'>



    jQuery(document).ready(function ($) {
        $('#name, input[type="reset"]').bind("keyup click change", function () {

            var name = $(this).val();
            var Name = $('#Name').val();
            $.post("<?php echo ADMIN_URL ?>/modules/property_type/ajax/ajax_name.php",
                    {
                        name: name,
                        Name: Name
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
