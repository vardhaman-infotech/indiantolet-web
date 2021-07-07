<!-- BEGIN PRE-FOOTER -->
 
<!-- END PRE-FOOTER -->
<!-- BEGIN FOOTER -->
<div id="foter" class="page-footer">

    <div class="container">
        <?php echo date('Y'); ?> <i class="fa fa-copyright" aria-hidden="true"></i> INDIAN TO-LET. All Rights Reserved.
    </div>
</div>
<div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
    &nbsp;
</div>
</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->

<script src="<?= ASSETS_PATH ?>/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?= ASSETS_PATH ?>/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?= ASSETS_PATH ?>/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= ASSETS_PATH ?>/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?= ASSETS_PATH ?>/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?= ASSETS_PATH ?>/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?= ASSETS_PATH ?>/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?= ASSETS_PATH ?>/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?= ASSETS_PATH ?>/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?= ASSETS_PATH ?>/global/plugins/flot/jquery.flot.js" type="text/javascript"></script>
<script src="<?= ASSETS_PATH ?>/global/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
<script src="<?= ASSETS_PATH ?>/global/plugins/flot/jquery.flot.categories.js" type="text/javascript"></script>

<script type="text/javascript" src="<?= ASSETS_PATH ?>/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?= ASSETS_PATH ?>/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= ASSETS_PATH ?>/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="<?= ASSETS_PATH ?>/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>


<script type="text/javascript" src="<?= ASSETS_PATH ?>/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?= ASSETS_PATH ?>/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?= ASSETS_PATH ?>/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?= ASSETS_PATH ?>/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="<?= ASSETS_PATH ?>/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= ASSETS_PATH ?>/global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
<script src="<?= ASSETS_PATH ?>/global/plugins/plupload/js/plupload.full.min.js" type="text/javascript"></script>
<script src="<?= ASSETS_PATH ?>/admin/pages/scripts/ecommerce-products-edit.js"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?= ASSETS_PATH ?>/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?= ASSETS_PATH ?>/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?= ASSETS_PATH ?>/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?= ASSETS_PATH ?>/admin/pages/scripts/ecommerce-index.js"></script>
<script type="text/javascript" src="<?= ASSETS_PATH ?>/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript" src="<?= ASSETS_PATH ?>/global/plugins/ckeditor/ckeditor.js"></script>
<script src="<?= ASSETS_PATH ?>/global/scripts/datatable.js"></script>
<script src="<?= ASSETS_PATH ?>/admin/pages/scripts/table-ajax.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout3/scripts/demo.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/form-wizard.js"></script>
<script src="<?php echo ADMIN_URL ?>/js/ankit.table2excel.js"></script>

<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
         FormWizard.init();
        //EcommerceIndex.init();
    });
</script>


<!-- END JAVASCRIPTS -->

<!--<div class="modal fade" id="reschedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Import Data from Excel</h4>
            </div>
            <div class="modal-body">
                <fieldset>
                <div class="form-group">
                    <a class="btn btn-info" href="">Download Sample First</a>
                </div>
                <form method="post" action="" id="Importform" name="Importform" enctype="multipart/form-data">                              
                    <div class="form-group">
                        Excel File : <input accept="*.xls,*.xlsx" class="form-control validate[required]" id="excelFile" onchange="return fileValidation()" name="excelFile" type="file">
                    </div>
                    <div class="form-group">
                        <input type="submit"  class="btn btn-primary" value="Submit">
                    </div>
                </form>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 <input type="button"  class="btn btn-primary" value="OK"> 
            </div>
        </div>
        
    </div>                
</div>-->

<!--<div class="modal fade" id="customModal" style="display:none" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Image preview</h4>
            </div>
            <div class="modal-body">
                <img src="" id="imagepreview" style="width: 100%;" >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>-->
<div class="modal fade" id="modelImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="replaceModal"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>                                
    </div>                            
</div>
</body>
<!-- END BODY -->
</html>
<!-- Custom Theme JavaScript -->
<script>
    // $(function () {
    //     //Ajax Loader Function
    //     jQuery(document).ajaxStart(function () {
    //         ajaxindicatorstart('Loading..');
    //     }).ajaxStop(function () {
    //         ajaxindicatorstop();
    //     });
    // });
 
    $('body').delegate('.popup', 'click', function () {
        var src = $(this).attr('src');
        $('#imagepreview').attr("src", src);
        $('#customModal').modal('show');
    });

    // Check input time is numeric only
    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        console.log(charCode);
        if (charCode != 46 && charCode != 45 && charCode > 31
        && (charCode < 48 || charCode > 57))
         return false;

      return true;
    }
  function imageZoom(folderPath, image) {
        //alert(image);
        $('#replaceModal').html('<img src="<?php echo UPLOAD_URL; ?>/' + folderPath + '/' + image + '" alt="Profile Image" style="width: 100%;">');
        $("#modelImage").modal();
    }
    function showMessage(message) {
        $('#successMsgDiv').show().append(message);
        setTimeout(function() {
            $('#successMsgDiv').slideUp('slow');
        }, 3000);
    }
    function showMessageError(message) {
        $('#errorMsgDiv').show().append(message);
        setTimeout(function() {
            $('#errorMsgDiv').slideUp('slow');
        }, 3000);
    }
    //For Admin Class
    function setsession() {
        if(isset($_POST)){
            print_r($_POST);
            $_SESSION['small']=$_POST['small'];
            $_SESSION['large']=$_POST['large'];
        }
    }
</script>
<!--For show the alert message-->
<?php
if (isset($_SESSION['successMsg'])) {
    $message = $_SESSION['successMsg'];
    unset($_SESSION['successMsg']);
} else {
    $message = 'no';
}
if (isset($_SESSION['errorMsg'])) {
    $error_message = $_SESSION['errorMsg'];
    unset($_SESSION['errorMsg']);
} else {
    $error_message = 'no';
}
if (isset($errorMsg)) {
    $message_error = $errorMsg;
} else {
    $message_error = 'no';
}
?>
<script>
    $(document).ready(function() {
        if ('<?= $message; ?>' != 'no') {
            showMessage('<?= $message; ?>');
        }
        if ('<?= $error_message; ?>' != 'no') {
            showMessageError('<?= $error_message; ?>');
        }
        if ('<?= $message_error; ?>' != 'no') {
            showMessageError('<?= $message_error; ?>');
        }
    });

$("#openclose").click(function(){ 
    var small;
    var large;
    if ($("#small").hasClass('small-sidebar')) {
        $("#small").removeClass('small-sidebar').delay("500").fadeIn();
    } else {
        small = 'small-sidebar';
        $("#small").addClass('small-sidebar').delay("500").fadeIn();

    }

    if ($("#open").hasClass('open-sidebar')) {
        $("#open").removeClass('open-sidebar').delay("200").fadeIn();
    } else {
        large = 'open-sidebar';
        $("#open").addClass('open-sidebar').delay("200").fadeIn();

    }
    //Set Session for Sidebar
    $.ajax({
        type: "POST",
        url: "<?php echo ADMIN_URL; ?>/modules/users/ajax/sidebar_session.php",
        data: {small: small, large: large},
        success: function (data) {

        }
    });
});
</script>

 <script type="text/javascript">
    <?php
    if (isset($_GET['msg']) && !empty($_GET['msg'])) {
        echo 'errorBoot("' . $_GET['msg'] . '");';
    }
    if (isset($_GET['message']) && !empty($_GET['message'])) {
        echo 'errorBootId("' . $_GET['message'] . '");';
    }
    ?>
    function errorBoot(message)
    {
        bootbox.alert(message, function () {
            //console.log("Alert Callback");
            var url = document.URL;
            var start = url.indexOf('?');
            var new_url = url.substr(0, start);
            //window.location.href=new_url;
            history.pushState('data', '', new_url);
        });
    }

    function errorBootId(message)
    {
        bootbox.alert(message, function () {
            //console.log("Alert Callback");
            var url = document.URL;
            var start = url.indexOf('&');
            var new_url = url.substr(0, start);
            window.location.href = new_url;
        });
    }
</script>