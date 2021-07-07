<div class="page-content">
    <style>
        .profile-info li {
            color: #6b6b6b;
            font-size: 13px;
            margin-right: 15px;
            margin-bottom: 5px;
            padding: 0 !important;
        }
    </style>
    <div class="">
        <div class="container-fluid">
            <div class="">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Begin: life time stats -->
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">

                                    <span class="caption-subject font-green-sharp bold uppercase">
                                        Property View </span>

                                </div>
                                <div class="actions">
                                    <button type="button" name="back" class="btn btn-default btn-circle" onclick="javascript:history.go(-1)">
                                        <i class="fa fa-angle-left"></i> Back
                                    </button>

                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="tabbable">
                                    <ul class="nav nav-tabs nav-tabs-lg">
                                        <li class="active">
                                            <a href="#tab_1" data-toggle="tab" aria-expanded="true">
                                                Details </a>
                                        </li>

                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <!--                                                    <div class="portlet yellow-crusta box">-->
                                                    <div class="portlet grey-cararra box">
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                Owner Details
                                                            </div>

                                                        </div>
                                                        <div class="portlet-body">
                                                            <?php
                                                            $obj_owner = new ownerModel();
                                                            $GetOwner = $obj_owner->selectByPk($owner_id);
                                                            ?>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name">
                                                                    Owner Name:
                                                                </div>
                                                                <div class="col-md-7 value">
                                                                    <?php echo (isset($GetOwner->name) ? $GetOwner->name : ""); ?>
                                                                </div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name">
                                                                    Email Id:
                                                                </div>
                                                                <div class="col-md-7 value">
                                                                    <?php echo (isset($GetOwner->email_id) ? $GetOwner->email_id : ""); ?>
                                                                </div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name">
                                                                    Phone Number:
                                                                </div>
                                                                <div class="col-md-7 value">
                                                                    <?php echo (isset($GetOwner->phone_number) ? $GetOwner->phone_number : ""); ?>
                                                                </div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name">
                                                                    Address:
                                                                </div>
                                                                <div class="col-md-7 value">
                                                                    <?php echo (isset($GetOwner->address_line1) ? $GetOwner->address_line1 : ""); ?>
                                                                </div>
                                                            </div>
                                                            <?php if (isset($GetOwner->adhar_card) && !empty($GetOwner->adhar_card)) { ?>
                                                                <div class="row static-info">
                                                                    <div class="col-md-5 name">
                                                                        Adhar Card:
                                                                    </div>
                                                                    <div class="col-md-7 value">
                                                                        <img height="150px" src="<?php echo UPLOAD_URL; ?>/owner_adhar_card/<?php echo (isset($GetOwner->adhar_card) ? $GetOwner->adhar_card : ""); ?>">
                                                                    </div>
                                                                </div>
                                                            <?php } ?>

                                                            <!--                                                            </div>-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="portlet grey-cararra box">
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                Property Details
                                                            </div>

                                                        </div>
                                                        <div class="portlet-body">
                                                            <?php $obj_property_type = new property_typeModel(); 
                                                            $GetPropertyType =$obj_property_type->selectByPk($property_type_id);
                                                            ?>
                                                            <ul class="list-inline">
                                                                <li>
                                                                    <i class="fa fa-map-marker"></i> <?php echo (isset($location) ? $location : ""); ?>
                                                                </li>
                                                                <li>
                                                                    <i class="fa fa-home"></i> <?php echo $GetPropertyType->name; ?>
                                                                </li>
                                                                <li>
                                                                    <i class="fa fa-area-chart"></i> <?php echo (isset($property_area) ? $property_area : ""); ?>
                                                                </li>
                                                                <li>
                                                                    <i class="fa fa-building-o" aria-hidden="true"></i>
                                                                    <?php 
                                                                    if($is_property==0){
                                                                        echo 'Residential';
                                                                    }else{
                                                                        echo 'Commercial';
                                                                    }
                                                                    ?>
                                                                </li>

                                                            </ul>

                                                            <div class="row static-info">
                                                                <div class="col-md-5 name">
                                                                    Property Name:
                                                                </div>
                                                                <div class="col-md-7 value">
                                                                    <?php echo (isset($name) ? $name : "") ?>
                                                                </div>
                                                            </div>
                                                            <!--                                                            <div class="row static-info">
                                                                                                                            <div class="col-md-5 name">
                                                                                                                                Property  Type
                                                                                                                            </div>
                                                                                                                            <div class="col-md-7 value">
                                                            <?php // echo valueNamePrimary('property_typeModel', $property_type_id, 'name'); ?>
                                                                                                                            </div>
                                                                                                                        </div>-->
                                                            <?php if (isset($floor) && $floor != '') { ?>
                                                                <div class="row static-info">
                                                                    <div class="col-md-5 name">
                                                                        Floor:
                                                                    </div>
                                                                    <div class="col-md-7 value">
                                                                        <?php echo (isset($floor) ? $floor : ""); ?>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                            if (isset($no_of_room) && $no_of_room != '') {
                                                                ?>
                                                                <div class="row static-info">
                                                                    <div class="col-md-5 name">
                                                                        No Of Room:
                                                                    </div>
                                                                    <div class="col-md-7 value">
                                                                        <?php echo (isset($no_of_room) ? $no_of_room : ""); ?>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>

                                                            <!--                                                            <div class="row static-info">
                                                                                                                            <div class="col-md-5 name">
                                                                                                                                Property Area:
                                                                                                                            </div>
                                                                                                                            <div class="col-md-7 value">
                                                            <?php echo (isset($property_area) ? $property_area : ""); ?>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="row static-info">
                                                                                                                            <div class="col-md-5 name">
                                                                                                                                Address:
                                                                                                                            </div>
                                                                                                                            <div class="col-md-7 value">
                                                            <?php echo (isset($location) ? $location : ""); ?>
                                                                                                                            </div>
                                                                                                                        </div>-->
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name">
                                                                    Rent:
                                                                </div>
                                                                <div class="col-md-7 value">
                                                                    <?php
                                                                    echo (isset($property_rent) ? $property_rent : "");
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name">
                                                                    Comment:
                                                                </div>
                                                                <div class="col-md-7 value">
                                                                    <?php
                                                                    echo (isset($additional_comment) ? $additional_comment : "");
                                                                    ?>
                                                                </div>
                                                            </div>                  
                                                            <legend>Images</legend>
                                                            <!--                                                            <div class="form-group">-->
                                                            <?php
                                                            $query = "select property_image from tbl_property_image where property_id='$id'";
                                                            $getImages = get_data($query);
                                                            foreach ($getImages as $getImagesVal) {
                                                                ?>
                                                                <!--                                                                <div class="col-md-3">-->
                                                                <div class=" static-info " style="display: inline-block;margin-right: 8px;">
                                                                    <a href="javascript:" onclick="imageZoom('property_image', '<?php echo $getImagesVal->property_image; ?>')">
                                                                        <img height="100px" width="100px" class="img-responsive" src="<?php echo UPLOAD_URL; ?>/property_image/<?php echo $getImagesVal->property_image; ?>" alt="<?php echo $getImagesVal->property_image; ?>" title="<?php echo $getImagesVal->property_image; ?>" class="img-responsive"> 
                                                                    </a> 

    <!--                                                                    <img height="100px" width="100px" class="img-responsive" src="<?php echo UPLOAD_URL; ?>/property_image/<?php echo $getImagesVal->property_image; ?>"> -->

                                                                </div>
                                                                <!--                                                                </div>-->
                                                            <?php } ?>
                                                            <!--                                                            </div>-->
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="portlet grey-cararra box">
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                Payment Details
                                                            </div> 
                                                        </div>
                                                        <div class="portlet-body">
                                                            <?php
                                                            $obj_payment = new paymentModel();
                                                            $GetPaymentDetail = $obj_payment->selectByPk($id);
                                                            if (count($GetPaymentDetail) > 0) {
                                                                ?>
                                                                <div class="row static-info">
                                                                    <div class="col-md-5 name">
                                                                        Transection Id:
                                                                    </div>
                                                                    <div class="col-md-7 value">
                                                                        <?php echo (isset($GetPaymentDetail->txn_id) ? $GetPaymentDetail->txn_id : "") ?>
                                                                    </div>
                                                                </div>
                                                                <div class="row static-info">
                                                                    <div class="col-md-5 name">
                                                                        Amount:
                                                                    </div>
                                                                    <div class="col-md-7 value">
                                                                        <?php echo (isset($GetPaymentDetail->amount) ? $GetPaymentDetail->amount : "") ?>
                                                                    </div>
                                                                </div>
                                                                <div class="row static-info">
                                                                    <div class="col-md-5 name">
                                                                        Payment Status:
                                                                    </div>
                                                                    <div class="col-md-7 value">
                                                                        <?php
                                                                        if ($GetPaymentDetail->payment_status == 0) {
                                                                            $payment_status = 'Pending';
                                                                        } elseif ($GetPaymentDetail->payment_status == 1) {
                                                                            $payment_status = 'Complete';
                                                                        } else {
                                                                            $payment_status = 'Cancelled';
                                                                        }
                                                                        echo $payment_status;
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="row static-info">
                                                                    <div class="col-md-5 name">
                                                                        Payment Type:
                                                                    </div>
                                                                    <div class="col-md-7 value">
                                                                        <?php
                                                                        if ($GetPaymentDetail->payment_type == 0) {
                                                                            $paymentType = 'Paytm';
                                                                        } elseif ($GetPaymentDetail->payment_type == 1) {
                                                                            $paymentType = 'Card';
                                                                        } else {
                                                                            $paymentType = 'Netbanking';
                                                                        }
                                                                        echo $paymentType;
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="row static-info">
                                                                    <div class="col-md-5 name">
                                                                        Payment For:
                                                                    </div>
                                                                    <div class="col-md-7 value">
                                                                        <?php
                                                                        if ($GetPaymentDetail->payment_for == 0) {
                                                                            $paymentFor = 'Owner';
                                                                        } else {
                                                                            $paymentFor = 'User';
                                                                        }
                                                                        echo $paymentFor;
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            <?php
                                                            } else {
                                                                echo '<p>Payment detail not found!</p>';
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End: life time stats -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>


