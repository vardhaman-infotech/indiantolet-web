<div class="page-content">
    <style>
        .tile {
            display: block;
            letter-spacing: 0.02em;
            float: left;
            height: 105px;
            width: 145px !important;
            cursor: pointer;
            text-decoration: none;
            color: #ffffff;
            position: relative;
            font-weight: 300;
            font-size: 12px;
            letter-spacing: 0.02em;
            line-height: 20px;
            overflow: hidden;
            border: 4px solid transparent;
            margin: 0 10px 10px 0;
        }
        .tile .tile-body {
            height: 100%;
            vertical-align: top;
            padding: 10px 10px;
            overflow: hidden;
            position: relative;
            font-weight: 400;
            font-size: 12px;
            color: #000000;
            color: #ffffff;
            margin-bottom: 10px;
        }
        .tile .tile-object {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            min-height: 30px;
            background-color: transparent;
        }
        .tile .tile-object > .name {
            position: absolute;
            bottom: 0;
            left: 0;
            margin-bottom: 5px;
            margin-left: 10px;
            margin-right: 15px;
            font-weight: 400;
            font-size: 13px;
            color: #ffffff;
        }
        .tile .tile-object > .number {
            position: absolute;
            bottom: 0;
            right: 0;
            margin-bottom: 0;
            color: #ffffff;
            text-align: center;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 0.01em;
            line-height: 14px;
            margin-bottom: 8px;
            margin-right: 10px;
        }
        .bg-purple-sunglo {
            border-color: #8E44AD !important;
            background-image: none !important;
            background-color: #8E44AD !important;
            color: #FFFFFF !important;
        }
        .bg-red-sunglo {
            border-color: #E26A6A !important;
            background-image: none !important;
            background-color: #E26A6A !important;
            color: #FFFFFF !important;
        }
        .tile .tile-body > i {     
            display: block;
            font-size: 57px;
            line-height: 56px;
            text-align: center;
        }
        .bg-blue-steel {
            border-color: #4B77BE !important;
            background-image: none !important;
            background-color: #4B77BE !important;
            color: #FFFFFF !important;
        }
    </style>
    <div class="">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <!-- Begin: life time stats -->
                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption">

                                <span class="caption-subject font-green-sharp bold uppercase">
                                    Owner View </span>

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
                                            <div class="col-md-5 col-sm-12">
                                                <div class="portlet grey-cararra box">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            Owner Details
                                                        </div>

                                                    </div>
                                                    <div class="portlet-body">

                                                        <div class="row static-info">
                                                            <div class="col-md-5 name">
                                                                Name:
                                                            </div>
                                                            <div class="col-md-7 value">
                                                                <?php echo (isset($name) ? $name : "") ?>
                                                            </div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name">
                                                                Email Id:
                                                            </div>
                                                            <div class="col-md-7 value">
                                                                <?php echo (isset($email_id) ? $email_id : "") ?>
                                                            </div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name">
                                                                Phone Number:
                                                            </div>
                                                            <div class="col-md-7 value">
                                                                <?php echo (isset($phone_number) ? $phone_number : "") ?>
                                                            </div>
                                                        </div> 
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name">
                                                                Address:
                                                            </div>
                                                            <div class="col-md-7 value">
                                                                <?php echo (isset($address_line1) ? $address_line1 : ""); ?>
                                                            </div>
                                                        </div> 
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name">
                                                                Adhar Card:
                                                            </div>
                                                            <div class="col-md-7 value">
                                                                <img height="150px" src="<?php echo UPLOAD_URL; ?>/owner_adhar_card/<?php echo (isset($adhar_card) ? $adhar_card : ""); ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-sm-12">
                                                <div class="portlet grey-cararra box">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            Property Details
                                                        </div>

                                                    </div>
                                                    <?php
                                                    $ProQuery = "SELECT COUNT(IF( property_type_id = '1',1, NULL)) AS flat,COUNT(IF( property_type_id = '2',1, NULL)) AS vila,COUNT(IF( property_type_id = '3',1, NULL)) AS independent FROM tbl_property WHERE owner_id='$id'";
                                                    $GetProperty = get_data($ProQuery);
                                                    ?>
                                                    <div class="portlet-body">
                                                        <div class="col-xs-4">

<!--                                                                <i class="fa fa-home"></i>   -->
                                                            <div class="tile bg-red-sunglo">
                                                                <div class="tile-body">
                                                                    <i class="fa fa-home"></i>
                                                                </div>
                                                                <div class="tile-object">
                                                                    <div class="name">
                                                                        Flat
                                                                    </div>
                                                                    <div class="number">
                                                                        <?php echo (isset($GetProperty[0]->flat) ? $GetProperty[0]->flat : "0"); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-4">

<!--                                                                <i class="fa fa-home"></i>   -->
                                                            <div class="tile bg-purple-sunglo">
                                                                <div class="tile-body">
                                                                    <i class="fa fa-home"></i>
                                                                </div>
                                                                <div class="tile-object">
                                                                    <div class="name">
                                                                        Villa
                                                                    </div>
                                                                    <div class="number">
                                                                        <?php echo (isset($GetProperty[0]->vila) ? $GetProperty[0]->vila : "0"); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-4">

<!--                                                                <i class="fa fa-home"></i>   -->
                                                            <div class="tile tile bg-blue-steel">
                                                                <div class="tile-body">
                                                                    <i class="fa fa-home"></i>
                                                                </div>
                                                                <div class="tile-object">
                                                                    <div class="name">
                                                                        Independant
                                                                    </div>
                                                                    <div class="number">
                                                                        <?php echo (isset($GetProperty[0]->independent) ? $GetProperty[0]->independent : "0"); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="portlet light">
                                                            <div class="portlet-title">
                                                                <div class="caption">
                                                                    <i class="fa fa-cogs font-green-sharp"></i>
                                                                    <span class="caption-subject font-green-sharp bold uppercase">Property List Of Owner</span>
                                                                </div>
                                                                <div class="tools">
                                                                    <a href="javascript:;" class="collapse" data-original-title="" title="">
                                                                    </a>

                                                                </div>
                                                            </div>
                                                            <div class="portlet-body">
                                                                <div class="table-scrollable table-scrollable-borderless">
                                                                    <table class="table table-light table-hover">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>
                                                                                    <i class="fa fa-briefcase"></i> Name
                                                                                </th>
                                                                                <th class="hidden-xs">
                                                                                    <i class="fa fa-question"></i> Type
                                                                                </th>
                                                                                <th>
                                                                                    <i class="fa fa-bookmark"></i> Area
                                                                                </th>
                                                                                <th>
                                                                                    <i class="fa fa-bookmark"></i> Rent
                                                                                </th>
                                                                                <th>
                                                                                </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            $obj_property = new propertyModel();
                                                                            $GetOwnerProperty = $obj_property->selectLimit('10',"","*","id desc",'owner_id=' . $id);
                                                                            if (count($GetOwnerProperty) > 0) {
                                                                                foreach ($GetOwnerProperty as $GetOwnerPropertyVal) {
                                                                                    ?>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <a href="<?php echo ADMIN_URL; ?>/property.php?action=viewProperty&propertyId=<?php echo encode($GetOwnerPropertyVal->id); ?>">
                                                                                                <?php echo $GetOwnerPropertyVal->name; ?> </a>
                                                                                        </td>
                                                                                        <td class="hidden-xs">
                                                                                            <?php echo valueNamePrimary('property_typeModel', $GetOwnerPropertyVal->property_type_id, 'name'); ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php echo $GetOwnerPropertyVal->property_area; ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php echo $GetOwnerPropertyVal->property_rent; ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <a href="<?php echo ADMIN_URL; ?>/property.php?action=viewProperty&propertyId=<?php echo encode($GetOwnerPropertyVal->id); ?>" class="btn default btn-xs green-stripe">
                                                                                                View </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                <?php }
                                                                            }
                                                                            ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--                                                            <ul class="list-inline">
                                                                                                                        <li>
                                                                                                                            <i class="fa fa-map-marker"></i> 
                                                                                                                        </li>
                                                                                                                        <li>
                                                                                                                            <i class="fa fa-home"></i>  
                                                                                                                        </li>
                                                                                                                        <li>
                                                                                                                            <i class="fa fa-square"></i> 
                                                                                                                        </li>
                                                        
                                                                                                                    </ul>                                                             -->
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


