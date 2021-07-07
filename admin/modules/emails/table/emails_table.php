 

 <!--BEGIN PAGE CONTAINER -->
<div class="page-content">
    <div class="col-sm-12">
    <!-- BEGIN PAGE HEAD -->
        <div class="page-head">
            <div class="container">
                <div class="page-title">
                    <h1>Manage Email Templates </h1>
                </div>
                <div class="page-toolbar">
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="javascript:;">Home</a><i class="fa fa-circle"></i>
                        </li>
                        <li class="active">
                            Email Templates Listing
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE HEAD -->
    <!-- BEGIN PAGE CONTENT -->
    <div class="">
        <div class="container-fluid">


            <div class="row">
                <div class="col-md-12">

                    <!-- Begin: life time stats -->
                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-envelope font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">Email Template</span>
                                <span class="caption-helper">manage email templates...</span>
                            </div>
                             <div class="actions">
                             <!--
                              <div class="btn-group">
                                    <a class="btn btn-default btn-circle" href="javascript:;" data-toggle="dropdown">
                                    <i class="fa fa-cog"></i>
                                    <span class="hidden-480">
                                    Tools </span>
                                    <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                       <a class="btn " id="btnExport">Export to Excel </a>
                                        </li>
                                        <li>
                    <a  class="btn report_download" href="<?php echo ADMIN_URL; ?>/modules/emails/ajax/email_report.php">Export to CSV</a>   
                                        </li>
                                    </ul>
                                </div>-->
                        </div>
                        </div>
                        <div class="portlet-body">
                            <div class="alert alert-success alert-dismissable" style="display:none;" id="successMsgDiv">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            </div>
                            <div class="alert alert-danger alert-dismissable" style="display:none;" id="errorMsgDiv">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            </div>
                            <div class="table-container"> 
    
                                <div class="table-actions-wrapper">
                              
                                 </div>
                                <table class="table table-striped table-bordered table-hover report" id="datatable_ajax">
                                    <thead>
                                        <tr role="row" class="heading">
<!--                                            <th width="2%">
                                                <input type="checkbox" class="group-checkable">
                                            </th>-->
                                            <th width="5%">
                                                Record&nbsp;#
                                            </th>
                                            <th width="13%">
                                                Email For
                                            </th>                                            
                                            <th width="13%">
                                                Email Subject
                                            </th>
                                            <th width="12%">
                                                Date
                                            </th>
                                            <th width="2%">
                                                Actions
                                            </th>
                                        </tr>
                                        <tr role="row" class="filter">
<!--                                            <td>
                                            </td>-->
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" name="primary_id">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" name="email_for">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" name="email_subject">
                                            </td>
                                          
                                           <td>
                                            <input type="text" class="form-control form-filter input-sm" name="created_date" id="created_date">
                                            </td>
                                            <td>
                                                <div class="margin-bottom-5">
                                                    <button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i></button>
                                                    <button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i></button>
                                                </div>

                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End: life time stats -->
                </div>
            </div>
            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->

<script type="text/javascript">
    $(function () {
        var date = new Date();
        $('#created_date').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
        });
    });
</script>




<script>
    jQuery(document).ready(function() {
        TableAjax.init();

        var handleRecords = function() {

            var grid = new Datatable();
            grid.init({
                src: $("#datatable_ajax"),
                onSuccess: function(grid) {
                    // execute some code after table records loaded
                },
                onError: function(grid) {
                    // execute some code on network or other general error  
                },
                onDataLoad: function(grid) {
                    // execute some code on ajax data load

                },
                loadingMessage: 'Loading...',
                dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

                    // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                    // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                    // So when dropdowns used the scrollable div should be removed. 
                    //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",

                    "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                    "lengthMenu": [
                        [10, 20, 50, 100, 150, -1],
                        [10, 20, 50, 100, 150, "All"] // change per page values here
                    ],
                    "pageLength": 10, // default record count per page
                    "ajax": {
                        "url": "<?php echo ADMIN_URL ?>/modules/emails/ajax/table_ajax.php"// ajax source
                    },
                    "order": [
                        [1, "desc"]
                    ]// set first column as a default sort by asc
                }
            });

            // handle group actionsubmit button click
            grid.getTableWrapper().on('click', '.table-group-action-submit', function(e) {
                e.preventDefault();
                var action = $(".table-group-action-input", grid.getTableWrapper());
                if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                    grid.setAjaxParam("customActionType", "group_action");
                    grid.setAjaxParam("customActionName", action.val());
                    grid.setAjaxParam("id", grid.getSelectedRows());
                    grid.getDataTable().ajax.reload();
                    grid.clearAjaxParams();
                } else if (action.val() == "") {
                    Metronic.alert({
                        type: 'danger',
                        icon: 'warning',
                        message: 'Please select an action',
                        container: grid.getTableWrapper(),
                        place: 'prepend'
                    });
                } else if (grid.getSelectedRowsCount() === 0) {
                    Metronic.alert({
                        type: 'danger',
                        icon: 'warning',
                        message: 'No record selected',
                        container: grid.getTableWrapper(),
                        place: 'prepend'
                    });
                }
            });
        }
        handleRecords();


        // For single record delete fucntion
        $('body').delegate('.btn-danger', 'click', function(evt) {
            evt.preventDefault();
            var hrefUrl = $(this).attr('href');
            bootbox.confirm('<?php echo EMAILS_CONFIRM_DELETE; ?>', function(result) {
                console.log(result);
                if (result) {                    
                    window.location.href = hrefUrl;
                }
            });
        });


    });
</script>


<!---------------------------------------------------------->
 
<?php
$obj_emails = new emailsModel();
$getmarkting=$obj_emails->select("is_active='1'");
?>
<div class="portlet-body export" style="display:none;" >
                            <div class="table-responsive ">
                                <table id="exportTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            
                                            <th>Email For</th>
                                            <th>Email Subject</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   <?php foreach ($getmarkting as $value) { ?>
                                    <tr>
                                            <th><?php echo $value->email_for; ?></th>
                                            <th><?php echo $value->email_subject; ?></th>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
<!---------------------------------------------------->
<!---------------------------------------------------------->
  <script>

         $('body').delegate('#btnExport',"click", function () {
            $("#exportTable").table2excel({
                exclude: ".noExl",
                name: "Excel Document Name",
                filename: "EmailUser",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            });
        });

    </script> 
<!-------------------------------------------------------->
<!----------------------------Import File---------------------------->
<script>
function showfile()
{
    $('#importdata').show('slow');
   
}
</script>
<!-------------------------------------------------------->
