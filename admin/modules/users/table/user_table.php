<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
    <!-- BEGIN PAGE HEAD -->
    <div class="col-sm-12">
    <!-- BEGIN PAGE HEAD -->
        <div class="page-head">
            <div class="container">
                <div class="page-title">
                    <h1>Manage User </h1>
                </div>
                <div class="page-toolbar">
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="javascript:;">Home</a><i class="fa fa-circle"></i>
                        </li>
                        <li class="active">
                            User Listing 
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
                                <i class="fa fa-gift font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">User</span>
                                <span class="caption-helper">manage user...</span>
                            </div>
                            <div class="actions">
                                <a href="<?= $_SERVER['PHP_SELF'] ?>?action=addUser" class="btn btn-default btn-circle">
                                    <i class="fa fa-plus"></i>
                                    <span class="hidden-480">
                                        Add New
                                    </span>
                                </a>
<!--                                <a href="javascript:;" class="btn default btn-circle purple" id="btnExport">
                                Export to Excel </a>-->
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
                                    <span>
                                    </span>
                                    <select class="table-group-action-input form-control input-inline input-small input-sm">
                                        <option value="">Select...</option>
                                        <option value="1">Published</option>
                                        <option value="0">Not Published</option>
                                        <option value="Deleted">Delete</option>

                                    </select>
                                    <button class="btn btn-sm yellow table-group-action-submit"
                                            ><i class="fa fa-check"></i> Submit
                                    </button>
                                </div>
                                <table class="table table-striped table-bordered table-hover" id="datatable_ajax">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <th width="2%">
                                                <input type="checkbox" class="group-checkable">
                                            </th>
                                            <th width="5%">
                                                Record&nbsp;#
                                            </th>
                                            <th width="13%">
                                               First Name
                                            </th>  
                                            <th width="13%">
                                               Email Id
                                            </th>
                                            <th width="10%">
                                               Phone Number
                                            </th>
                                            <th width="10%">
                                               Otp
                                            </th>
                                            
                                            <th width="10%">
                                                Status
                                            </th>
                                            <th width="11%">
                                                Date
                                            </th>
                                            <th width="2%">
                                                Actions
                                            </th>
                                        </tr>
                                        <tr role="row" class="filter noExl">
                                            <td>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" name="primary_id">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" name="first_name">
                                            </td> 
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" name="email_id">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" name="phone_number">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" name="user_otp">
                                            </td>
                                            
                                            <td>
                                                <select name="status" class="form-control form-filter input-sm">
                                                    <option value="">Select...</option>
                                                    <option value="1">Published</option>
                                                    <option value="0">Not Published</option>
                                                </select>
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
<!---------Date Picker Search Time-------------->
<script type="text/javascript">
 $(function(){
     $('#created_date').datepicker({
        format: "yyyy-mm-dd",
            autoclose: true,
     })
 });
 document.getElementById('btnExport').addEventListener("click", function () {
        $("#datatable_ajax").table2excel({
            exclude: ".noExl",
            name: "Excel Document Name",
            filename: "User_data",
            fileext: ".xls",
            exclude_img: true,
            exclude_links: true,
            exclude_inputs: true,
            columns : [1,2,3,4,6,7],
        });
    });
</script>
<!---------End Date Picker Search Time-------------->
<!---------Show Data In Table-------------->
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
                        "url": "<?php echo ADMIN_URL; ?>/modules/users/ajax/table_ajax.php"// ajax source
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
            bootbox.confirm('<?php echo USER_CONFIRM_DELETE; ?>', function(result) {
                console.log(result);
                if (result) {                    
                    window.location.href = hrefUrl;
                }
            });
        });


    });
</script>
<!---------End  Table-------------->
