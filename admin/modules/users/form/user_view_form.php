<div class="page-content">

    <div class="">
        <div class="container-fluid">
            <div class="row">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Begin: life time stats -->
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">

                                    <span class="caption-subject font-green-sharp bold uppercase">
                                        User View </span>

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
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="portlet yellow-crusta box">
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                <i class="fa fa-cogs"></i>User Details
                                                            </div>

                                                        </div>
                                                        <div class="portlet-body">
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name">
                                                                    User Id:
                                                                </div>
                                                                <div class="col-md-7 value">
                                                                    <?php echo (isset($id) ? $id : "") ?>
                                                                </div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name">
                                                                    First Name:
                                                                </div>
                                                                <div class="col-md-7 value">
                                                                    <?php echo (isset($first_name) ? $first_name : "") ?>
                                                                </div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name">
                                                                    Last Name
                                                                </div>
                                                                <div class="col-md-7 value">
                                                                    <?php echo (isset($last_name) ? $last_name : "") ?>
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
                                                                    Email Id:
                                                                </div>
                                                                <div class="col-md-7 value">
                                                                    <?php echo (isset($email_id) ? $email_id : "") ?>
                                                                </div>
                                                            </div>
                                                             

                                                            <div class="row static-info">
                                                                <div class="col-md-5 name">
                                                                    Address:
                                                                </div>
                                                                <div class="col-md-7 value">
                                                                    <?php echo (isset($address) ? $address : ""); ?>
                                                                </div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name">
                                                                    Address(Optional):
                                                                </div>
                                                                <div class="col-md-7 value">
                                                                    <?php echo (isset($address2) ? $address2 : ""); ?>
                                                                </div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name">
                                                                    Country:
                                                                </div>
                                                                <div class="col-md-7 value">
                                                                    <?php
                                                                    echo (isset($country_name) ? $country_name:"");
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name">
                                                                    State:
                                                                </div>
                                                                <div class="col-md-7 value">
                                                                    <?php
                                                                    echo (isset($state_name) ? $state_name:"");
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name">
                                                                    City:
                                                                </div>
                                                                <div class="col-md-7 value">
                                                                    <?php
                                                                    echo (isset($city_name) ? $city_name:"");
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name">
                                                                    Zip code:
                                                                </div>
                                                                <div class="col-md-7 value">
                                                                    <?php
                                                                    echo (isset($zipcode) ? $zipcode:"");
                                                                    ?>
                                                                </div>
                                                            </div>
                                                                                                                     
<!--                                                            <legend class="font-green-sharp">Rating&Review</legend>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name">
                                                                    Rating:
                                                                </div>
                                                                <div class="col-md-7 value">
                                                                    <?php
                                                                    $obj_restaurant_reveiw = new restaurant_reviewModel();
                                                                    $GetAllReview = $obj_restaurant_reveiw->select("restaurant_id='$id'", '', 'sum(star_rating) as avg_rating', '');
                                                                    if (isset($GetAllReview[0]->avg_rating) && $GetAllReview[0]->avg_rating != '') {
                                                                        echo $GetAllReview[0]->avg_rating;
                                                                    } else {
                                                                        echo '0';
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>-->
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


