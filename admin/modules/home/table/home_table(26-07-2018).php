<?php
$Current_date = date('Y-m-d'); ///Get Current Date YY-MM-DD Formate
$Current_month = date('Y-m'); ///Get Current Date YY-MM-DD Formate
?>

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
            <div class="row">
                
                
                <!----------Total User---------------->
                <div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="dashboard-stat yellow">
                        <div class="visual">
                            <!-- <i class="fa fa-comments"></i> -->
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
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
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
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
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
                <!--                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="dashboard-stat purple">
                                        <div class="visual">
                                            <i class="fa fa-comments"></i> 
                                        </div>
                                        <div class="details">
                
                                            <div class="number">
                                             
                
                                            </div> 
                                            <div class="desc">Delivery Boy</div>
                                        </div>
                                        <a class="more" href="javascript:"> View more
                                            <i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>-->
                <!--                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="dashboard-stat blue">
                                        <div class="visual">
                                            <i class="fa fa-comments"></i> 
                                        </div>
                                        <div class="details">
                
                                            <div class="number">
                                              
                                            </div> 
                                            <div class="desc">Total Order</div>
                                        </div>
                                        <a class="more" href="<?php echo ADMIN_URL ?>/order.php"> View more
                                            <i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>-->

                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>



            <div class="clearfix"></div> 

        </div>
    </div> 
    <div class="clearfix"></div>



    <!-- END PAGE CONTENT -->
