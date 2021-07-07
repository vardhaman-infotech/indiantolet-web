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
                    <h1> Owner <?php echo (isset($action) && $action == "editOwner") ? "Edit" : "Add" ?> <small>create & edit owner</small></h1>

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
                                <form class='form-horizontal' name='ownerForm' id='ownerForm' method='post' action='' enctype='multipart/form-data'>
                                    <div class="portlet light">                                        
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-owner font-green-sharp"></i>
                                                <span class="caption-subject font-green-sharp bold uppercase">
                                                    <?php echo (isset($action) && $action == "editOwner") ? "Edit" : "Add" ?> Owner </span>

                                            </div>

                                            <div class="actions btn-set">

                                                <button type="button" name="back" class="btn btn-default btn-circle" onclick="javascript:history.go(-1)">
                                                    <i class="fa fa-angle-left"></i> Back
                                                </button>
                                                <button class="btn btn-default btn-circle " type="reset">
                                                    <i class="fa fa-reply"></i> Reset
                                                </button>
                                                <input type="submit" name="submitOwner" class="btn green-haze btn-circle" value="Save">

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
                                                    <div class="col-md-5">
                                                        <label class="control-label">Full Name</label> 
                                                        <input type="text" placeholder="Name" class="form-control validate[required]" name="name" id="name" value="<?php echo (isset($name) ? $name : "") ?>">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label class="control-label">Email Id</label>

                                                        <input type="text" placeholder="Enter Email Id" class="form-control validate[required,custom[email]]" name="email_id" id="email_id" value="<?php echo (isset($email_id) ? $email_id : "") ?>">
                                                        <input  type='hidden' name='Email' id='Email' value='<?php echo (isset($email_id) ? $email_id : "") ?>'>
                                                        <div class="clearBoth"></div>
                                                        <span id='AlreadyExists' style='color: red; display: none;'>Email Id Already Exists</span>
                                                    </div>                                        
                                                </div>

                                                <div class="form-group">

                                                    <div class="col-md-5">
                                                        <label class="control-label">Phone Number</label>

                                                        <input type="text" onkeypress="return isNumberKey(event);" placeholder="Enter Phone Number" class="form-control validate[required]" name="phone_number" id="phone_number" value="<?php echo (isset($phone_number) ? $phone_number : "") ?>">

                                                    </div> 
                                                    <div class="col-md-5">
                                                        <label class="control-label">Address</label>

                                                        <textarea type="text" rows="3" placeholder="Enter Address" class="form-control validate[required]" name="address_line1" id="address_line1"><?php echo (isset($address_line1) ? $address_line1 : "") ?></textarea>

                                                    </div>
                                                </div>  

                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <label class="control-label">Owner Image</label>

                                                        <input type="file" class="form-control " name="image" id="image">

                                                    </div>
                                                    <div class="col-md-5">
                                                        <label class="control-label">Adhar Card Image</label>

                                                        <input type="file" class="form-control " name="adhar_card" id="adhar_card">

                                                    </div>


                                                </div>
                                                <div class="form-group">

                                                    <?php
                                                    if ($action == 'editOwner') {
                                                       
                                                            ?>
                                                            <div class="col-md-5">
                                                                <!--                                                        <label class="control-label">Image</label>-->
                                                                <img height="100px" width="100px" src="<?php echo UPLOAD_URL; ?>/owner_image/<?php echo (isset($image) && !empty($image) ? $image:"default.png"); ?>">
                                                            </div>
                                                        
                                                     <div class="col-md-5">
                                                                <!--                                                        <label class="control-label">Image</label>-->
                                                                <img height="100px" width="100px" src="<?php echo UPLOAD_URL; ?>/owner_adhar_card/<?php echo (isset($adhar_card) && !empty($adhar_card) ? $adhar_card:"default.png"); ?>">
                                                            </div>
                                                   <?php }
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-5">                                                
                                                        <label class="control-label">Status</label>

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
                                            <div class="form-body">
                                                <?php if ($action == "editOwner") { ?>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Change Password</label>
                                                        <div class="col-md-8" style="margin-top: 11px">
                                                            <input type="checkbox"  class="form-control" name="Chk_chage_pass" id="Chk_chage_pass" value="1" >
                                                        </div>
                                                    </div> 
                                                <?php } ?>
                                                <div id="chk_pass_div"  style="display: none">
                                                    <div class="form-group"> 
                                                        <label class="col-md-2 control-label"> </label>
                                                        <div class="col-md-4">
                                                            <input name="n_pass" id="n_pass" type="password" class="form-control validate[required] inputField" autocomplete="off" placeholder="New password"/>
                                                        </div>
                                                    </div> 
                                                    <div class="form-group"> 
                                                        <label class="col-md-2 control-label"> </label>
                                                        <div class="col-md-4">
                                                            <input name="re_pass" id="re_pass" type="password" class="form-control validate[required,equals[n_pass]] inputField" autocomplete="off" placeholder="Confirm password"/>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <script>
                                                    $('#Chk_chage_pass').click(function () {
                                                        $("#chk_pass_div").toggle('slow');
                                                    });
                                                </script>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <input type="hidden" name="action" id="action" value="<?= $action ?>">
                                                        <input type="hidden" name="ownerID" id="ownerID" value="<?= isset($ownerId) ? $ownerId : '' ?>">
                                                        <input type="submit" class="btn btn-primary green" value="Save" name="submitOwner" id="submitOwner">
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
<!--<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyBbhCdKStQ31gW0qw5qIQQOER4ckfj8in4"></script>
<script type="text/javascript">
                                                    google.maps.event.addDomListener(window, 'load', function () {
                                                        var places = new google.maps.places.Autocomplete(document.getElementById('address'));
                                                        google.maps.event.addListener(places, 'place_changed', function () {
                                                            var place = places.getPlace();
                                                            var address = place.formatted_address;
                                                            var latitude = place.geometry.location.lat();
                                                            var longitude = place.geometry.location.lng();
                                                            /*  var mesg = "Address: " + address;
                                                             mesg += "\nLatitude: " + latitude;
                                                             mesg += "\nLongitude: " + longitude;*/
                                                            document.getElementById('latitude').value = latitude;
                                                            document.getElementById('longitude').value = longitude;
                                                            // alert(mesg);
                                                        });
                                                    });
</script>-->

<script type="text/javascript">
    $(function () {
        $('input[type="text"]:first').focus();
        $("#ownerForm").validationEngine();
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
        $('#email_id, input[type="reset"]').bind("keyup click change", function () {

            var email = $(this).val();
            var Email = $('#Email').val();

            $.post("<?php echo ADMIN_URL ?>/modules/owner/ajax/ajax_email.php",
                    {
                        email: email,
                        Email: Email
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

    jQuery(document).ready(function ($) {
        $('#phone_number, input[type="reset"]').bind("keyup click change", function () {

            var mobile = $(this).val();
            var Mobile = $('#Mobile').val();
            $.post("<?php echo ADMIN_URL ?>/modules/owner/ajax/ajax_phone_no.php",
                    {
                        mobile: mobile,
                        Mobile: Mobile
                    }, function (data) {
                if (data == true) {
                    $('#Alreadymobile').show();
                    $('input[type=submit]').addClass("disabled");
                    $('input[type=submit]').attr("disabled", true);
                } else {
                    $('#Alreadymobile').hide();
                    $('input[type=submit]').removeClass("disabled");
                    $('input[type=submit]').attr("disabled", false);
                }
            });
        });
    });


</script>
