<?php
$Current_date = date('Y-m-d'); ///Get Current Date YY-MM-DD Formate
$Current_month = date('Y-m'); ///Get Current Date YY-MM-DD Formate
?>
<style>
    #chartdiv {
        width: 100%;
        height: 295px;
    }
</style>
<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
    <!-- BEGIN PAGE HEAD -->
    <div class="col-sm-12">
        <div class="page-head">
            <div class="container-fluid">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Dashboard</h1>
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
                            Dashboard
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
    <div class="full">
        <div class="col-sm-12">
            <!-- BEGIN PAGE CONTENT INNER -->
<!--            <div class="row">-->
                <div class="col-sm-6">
                    <!----------Total User---------------->
                    <div class="row">
                        <div class="col-lg-5 col-md-4 col-sm-4 col-xs-12">

                            <div class="dashboard-stat yellow">

                                <div class="visual">
                                    <i class="fa fa-comments"></i> 
                                </div>
                                <div class="details">
                                    <div class="number"> 
                                        <?php
                                        $obj_user = new userModel();
                                        $GetUser = $obj_user->select();
                                        echo count($GetUser);
                                        ?>

                                    </div> 
                                    <div class="desc"> Tenant </div>
                                </div>
                                <a class="more" href="javascript:"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-4 col-sm-4 col-xs-12">
                            <div class="dashboard-stat green">
                                <div class="visual">
                                    <i class="fa fa-comments"></i> 
                                </div>
                                <div class="details">

                                    <div class="number">
                                        <?php
                                        $obj_owner = new ownerModel();
                                        $GetOwner = $obj_owner->select();
                                        echo count($GetOwner);
                                        ?>
                                    </div> 
                                    <div class="desc"> Owner</div>
                                </div>
                                <a class="more" href="javascript:"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-md-4 col-sm-4 col-xs-12">
                            <div class="dashboard-stat light blue-madison">
                                <div class="visual">
                                    <i class="fa fa-comments"></i> 
                                </div>
                                <div class="details">

                                    <div class="number">
                                        <?php
                                        $obj_property = new propertyModel();
                                        $GetProperty = $obj_property->select();
                                        echo count($GetProperty);
                                        ?>
                                    </div> 
                                    <div class="desc"> Property  </div>
                                </div>
                                <a class="more" href="javascript:"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-4 col-sm-4 col-xs-12">
                            <div class="dashboard-stat purple">
                                <div class="visual">
                                    <i class="fa fa-comments"></i> 
                                </div>
                                <div class="details">

                                    <div class="number">
                                        <?php
                                        $obj_owner = new ownerModel();
                                        $GetUnverifyOwner = $obj_owner->select('is_active="0"');
                                        echo count($GetUnverifyOwner);
                                        ?>

                                    </div> 
                                    <div class="desc">Unverified Owner</div>
                                </div>
                                <a class="more" href="javascript:"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-home font-green-sharp"></i>
                                    <span class="caption-subject font-green-sharp bold uppercase">Total Of Independent,Flat,Villa </span>

                                </div>

                            </div>
                            <div id="chartdiv"></div>
                        </div>

                    </div>
                </div> 
                <div class="clearfix"></div>

<!--            </div>-->
            <div class="row"> 
                <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-bar-chart font-green-sharp"></i>
                                    <span class="caption-subject font-green-sharp bold uppercase">Tenant Registration per/month</span>

                                </div>

                            </div>
                <div id="TenantChart" class="chart"></div>

            </div>
            </div>
            <div class="clearfix"></div> 
            <div class="row">             
                <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-bar-chart font-green-sharp"></i>
                                    <span class="caption-subject font-green-sharp bold uppercase">Owner Registration per/month</span>

                                </div>

                            </div>
                <div id="OwnerChart" class="chart"></div>

            </div>
            </div>
        </div>
    </div> 
    <div class="clearfix"></div>
    <!-- Resources --> 
    <script src="<?= ASSETS_PATH ?>/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="<?= ASSETS_PATH ?>/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>  
    <script src="<?= ASSETS_PATH ?>/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

    <?php
    $CountQuery = "SELECT COUNT(IF( property_type_id = '1',1, NULL)) AS flat,COUNT(IF( property_type_id = '2',1, NULL)) AS vila,COUNT(IF( property_type_id = '3',1, NULL)) AS independent FROM tbl_property ";
    $GetRecord = get_data($CountQuery);
    //echo $GetRecord[0]->flat.'/'.$GetRecord[0]->vila.'/'.$GetRecord[0]->independent;  
    ?>

    <!-- Chart code -->
    <script>
        var chart = AmCharts.makeChart("chartdiv", {
            "type": "pie",
            "theme": "light",
            "dataProvider": [{
                    "propertytype": "Flat",
                    "count": <?php echo $GetRecord[0]->flat; ?>
                }, {
                    "propertytype": "Villa",
                    "count": <?php echo $GetRecord[0]->vila; ?>
                }, {
                    "propertytype": "Independent",
                    "count": <?php echo $GetRecord[0]->independent; ?>
                }],
            "valueField": "count",
            "titleField": "propertytype",
//            "balloon": {
//                "fixedPosition": true
//            },
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[count]]</b> ([[percents]]%)</span>",
            "export": {
                "enabled": true
            }
        });
    </script>
    <!--    For Tenant line chart-->
    <?php
    $sql_user = "SELECT count(id) as totaluser,DATE_FORMAT(created_date,'%Y') as year,DATE_FORMAT(created_date,'%M') as months FROM tbl_user GROUP BY DATE_FORMAT(created_date,'%Y-%m')";
    $tot_user = get_data($sql_user);
    $data = '';
    foreach ($tot_user as $req) {
        $data .= '{"date":"' . $req->months . '/' . $req->year . '","duration":"' . $req->totaluser . '","color":"#b7e021"},';
    }
    //  echo $data;
    ?>
    <script>
        /*For Map*/
        var chart = AmCharts.makeChart("TenantChart", {
            "theme": "light",
            "type": "serial",
            "dataProvider": [<?php echo $data; ?>],
            "valueAxes": [{
                    "position": "left",
                    "title": "Number Of Tenant"
                }],
            "graphs": [{
                    "bullet": "square",
                    "bulletBorderAlpha": 1,
                    "bulletBorderThickness": 1,
                    "fillAlphas": 0.3,
                    "fillColorsField": "lineColor",
                    "legendValueText": "[[value]]",
                    "lineColorField": "lineColor",
                    "title": "duration",
                    "valueField": "duration"
                }],
            "chartScrollbar": {
            },
            "chartCursor": {
                "categoryBalloonDateFormat": "YYYY MMM DD",
                "cursorAlpha": 0,
                "fullWidth": false
            },
            "categoryField": "date",
            "categoryAxis": {
                "gridPosition": "start",
                "labelRotation": 90
            },
            "export": {
                "enabled": true
            }

        });
    </script>
    <!--    For Owner line chart-->
    <?php
    $sql_user = "SELECT count(id) as totalowner,DATE_FORMAT(created_date,'%Y') as year,DATE_FORMAT(created_date,'%M') as months FROM tbl_owner GROUP BY DATE_FORMAT(created_date,'%Y-%m')";
    $tot_user = get_data($sql_user);
    $dataOwner = '';
    foreach ($tot_user as $req) {
        $dataOwner .= '{"date":"' . $req->months . '/' . $req->year . '","duration":"' . $req->totalowner . '","color":"#b7e021"},';
    }
    //  echo $data;
    ?>
    <script>
        /*For Map*/
        var chart = AmCharts.makeChart("OwnerChart", {
            "theme": "light",
            "type": "serial",
            "dataProvider": [<?php echo $dataOwner; ?>],
            "valueAxes": [{
                    "position": "left",
                    "title": "Number Of Owner"
                }],
            "graphs": [{
                    "bullet": "square",
                    "bulletBorderAlpha": 1,
                    "bulletBorderThickness": 1,
                    "fillAlphas": 0.3,
                    "fillColorsField": "lineColor",
                    "legendValueText": "[[value]]",
                    "lineColorField": "lineColor",
                    "title": "duration",
                    "valueField": "duration"
                }],
            "chartScrollbar": {
            },
            "chartCursor": {
                "categoryBalloonDateFormat": "YYYY MMM DD",
                "cursorAlpha": 0,
                "fullWidth": false
            },
            "categoryField": "date",
            "categoryAxis": {
                "gridPosition": "start",
                "labelRotation": 90
            },
            "export": {
                "enabled": true
            }

        });
    </script>
    <!-- END PAGE CONTENT -->
