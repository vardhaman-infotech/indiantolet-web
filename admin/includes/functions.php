S<?php

function uploadfiles($xlsfile, $path) {
    $file_arr = explode('.', $xlsfile['name']);
    $file_Name = strtolower(str_replace(' ', '_', $file_arr[0]));
    $filename = $file_Name . "_" . time() . "." . $file_arr[1];
    $xlsfile['name'] = $filename;
    move_uploaded_file($xlsfile['tmp_name'], $path . $xlsfile['name']);
    return $filename;
}

function parseExcel($excel_file_name_with_path) {
    $data = new Spreadsheet_Excel_Reader();
    // Set output Encoding.
    $data->setOutputEncoding('CP1251');
    $data->read($excel_file_name_with_path);

    $colname = array('id', 'name');

    for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
        for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {

            $product[$i - 1][$j - 1] = $data->sheets[0]['cells'][$i][$j];
            $product[$i - 1][$colname[$j - 1]] = $data->sheets[0]['cells'][$i][$j];
        }
    }
    return $product;
}

function getpageinformation($id) {
    $query = "select * from `page_manager` where `page_id`='$id' limit 1";

    $result = mysql_query($query) or die("Query failed due to: " . mysql_error());
    while ($row = mysql_fetch_array($result)) {

        $pageinfo = $row;
    }
    return $pageinfo;
}

function sendmail($email_array) {
//				print_r($email_array);
    $email_count = count($email_array);


    for ($counter = 0; $counter < $email_count; $counter++) {

        $email = $email_array[$counter];

        if (tep_validate_email($email)) {


            $m = new Mail; // create the mail
            //	$m->From( "leo@isp.com" );
            $m->To($email_array[$counter]);
            $m->Subject("the subject of the mail");

            $message = "Hello world!\nthis is a test of the Mail class\nplease ignore\nThanks.";
            $m->Body($message); // set the body
            $m->Send(); // send the mail
            //			echo "mail sent";
        }
    }
    $Response = "Emails Have Been Sent";
    return $Response;
}

function tep_validate_email($email) {
    $valid_address = true;

    $mail_pat = '^(.+)@(.+)$';
    $valid_chars = "[^] \(\)<>@,;:\.\\\"\[]";
    $atom = "$valid_chars+";
    $quoted_user = '(\"[^\"]*\")';
    $word = "($atom|$quoted_user)";
    $user_pat = "^$word(\.$word)*$";
    $ip_domain_pat = '^\[([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\]$';
    $domain_pat = "^$atom(\.$atom)*$";

    if (eregi($mail_pat, $email, $components)) {
        $user = $components[1];
        $domain = $components[2];
        // validate user
        if (eregi($user_pat, $user)) {
            // validate domain
            if (eregi($ip_domain_pat, $domain, $ip_components)) {
                // this is an IP address
                for ($i = 1; $i <= 4; $i++) {
                    if ($ip_components[$i] > 255) {
                        $valid_address = false;
                        break;
                    }
                }
            } else {
                // Domain is a name, not an IP
                if (eregi($domain_pat, $domain)) {
                    /* domain name seems valid, but now make sure that it ends in a valid TLD or ccTLD
                      and that there's a hostname preceding the domain or country. */
                    $domain_components = explode(".", $domain);
                    // Make sure there's a host name preceding the domain.
                    if (sizeof($domain_components) < 2) {
                        $valid_address = false;
                    } else {
                        $top_level_domain = strtolower($domain_components[sizeof($domain_components) - 1]);
                    }
                } else {
                    $valid_address = false;
                }
            }
        } else {
            $valid_address = false;
        }
    } else {
        $valid_address = false;
    }
    if ($valid_address && ENTRY_EMAIL_ADDRESS_CHECK == 'true') {
        if (!checkdnsrr($domain, "MX") && !checkdnsrr($domain, "A")) {
            $valid_address = false;
        }
    }
    return $valid_address;
}

function getShortDescription($descVal, $limit = '') {
    $descVal = stripslashes($descVal);
    $strLen = strlen($descVal);
    if ($strLen > $limit) {
        $collespeStr = substr($descVal, 0, $limit) . '...';
        $displayStr = $collespeStr;
    } else {
        $displayStr = $descVal;
    }
    echo $displayStr;
}

function getProvince_old() {
    $psql = "select * from " . COTTAGE_PROVINCE_REGION . " where parent_id=0";

    $prs = mysql_query($psql);
    while ($prw = mysql_fetch_array($prs)) {
        echo "<option value='" . $prw['id'] . "'>" . $prw['name'] . "</option>";
    }
}

function getProvince($provinceID = '0', $direction_id = '') {

    if ($provinceID == '' || $provinceID == '0') {
        if ($direction_id == '') {
            $sql = mysql_query("SELECT * FROM `cott_province_region` WHERE `parent_id`='" . $provinceID . "'");
        } else {
            $sql = mysql_query("SELECT * FROM `cott_province_region` WHERE `parent_id`='" . $provinceID . "' AND `direction_id`='" . $direction_id . "' ORDER BY `id` DESC");
        }

        while ($row = mysql_fetch_assoc($sql)) {
            $provinceArray[$row['id']] = $row['name'];
        }
        //print_r($provinceArray);die;
        return $provinceArray;
    } else {
        $sql = mysql_query("SELECT * FROM `cott_province_region` WHERE `id`='" . $provinceID . "'");
        while ($row = mysql_fetch_assoc($sql)) {
            $provinceName = $row['name'];
        }
        echo $provinceName;
    }
}

function getProvinceRegion($provinceID = '0', $regionID = '') {

    if ($regionID == '') {

        $sql = mysql_query("SELECT * FROM `cott_province_region` WHERE `parent_id`='" . $provinceID . "'");
        while ($row = mysql_fetch_assoc($sql)) {
            $regionArray[$row['id']] = $row['name'];
        }

        return $regionArray;
    } else {
        $sql = mysql_query("SELECT * FROM `cott_province_region` WHERE `id`='" . $regionID . "'");
        if (mysql_num_rows($sql) > 0) {
            while ($row = mysql_fetch_assoc($sql)) {
                $regionName = $row['name'];
            }
        } else {
            $regionName = '-No Record-';
        }
        echo $regionName;
    }
}

function getPropertyType($prtype) {
    $prop_name = "";
    $prarr = explode(',', $prtype);
    foreach ($prarr as $property_type) {
        $ptype_sql = "select property_type from " . PROPERTY_TYPE . " where isDelete=0 and property_type_id=" . $property_type;
        $ptype_rs = mysql_query($ptype_sql);
        $ptrw = mysql_fetch_array($ptype_rs);
        //$prop_name.=$ptrw['property_type'];
        $prop_name[] = $ptrw['property_type'];
    }
    return $prop_name;
}

function getPropertyTypeList() {
    $ptype_sql = "select * from " . PROPERTY_TYPE . " where isDelete=0";
    $ptype_rs = mysql_query($ptype_sql);
    $show_property_type = "";
    while ($ptrw = mysql_fetch_array($ptype_rs)) {
        $show_property_type.="<input name='property_type' type='radio' value='" . $ptrw['property_type_id'] . "' />" . $ptrw['property_type'];
    }
    //$prop_name.=$ptrw['property_type'];
    //$prop_name[]=$ptrw['property_type'];
    return $show_property_type;
}

function getWaterTypeList() {
    $show_watertype_list.="";
    $water_type_sql = "select * from " . PROPERTY_WATER_TYPE . " where isDelete=0";
    $water_type_rs = mysql_query($water_type_sql);
    while ($water_type_row = mysql_fetch_array($water_type_rs)) {
        $water_type_column_name = strtolower($water_type_row['water_type']);
        $show_watertype_list.="<input type='checkbox' name='" . $water_type_column_name . "' value='1'/>" . $water_type_row['water_type_id'];
    }
    return $show_watertype_list;
}

function getWaterType($watype) {
    //$water_type="";
    $waarr = explode(',', $watype);
    foreach ($waarr as $wa) {
        $wtype_sql = "select water_type from " . PROPERTY_WATER_TYPE . " where isDelete=0 and water_type_id=" . $wa;
        $wtype_rs = mysql_query($wtype_sql);
        $wtrw = mysql_fetch_array($wtype_rs);
        //$prop_name.=$ptrw['property_type'];
        $water_name[] = $wtrw['water_type'];
    }
    return $water_name;
}

function getWaterDetailList() {
    $show_waterdetail_list.="";
    $water_detail_sql = "select * from " . PROPERTY_WATER_DETAIL . " where isDelete=0";
    $water_detail_rs = mysql_query($water_type_sql);
    while ($water_detail_row = mysql_fetch_array($water_detail_rs)) {
        $water_detail_column_name = strtolower($water_detail_row['water_detail']);
        $show_waterdetail_list.="<input type='checkbox' name='" . $water_detail_column_name . "' value='1'/>" . $water_detail_row['property_water_id '];
    }
    return $show_waterdetail_list;
}

function getWaterDetail($wadetail) {
    $water_detail = "";
    $wdarr = explode(',', $wadetail);
    foreach ($wdarr as $wd) {
        $wdet_sql = "select water_detail from " . PROPERTY_WATER_DETAIL . " where isDelete=0 and property_water_id=" . $wd;
        $wdet_rs = mysql_query($wdet_sql);
        $wdrw = mysql_fetch_array($wdet_rs);
        //$prop_name.=$ptrw['property_type'];
        $water_detail[] = $wdrw['water_detail'];
    }
    return $water_detail;
}

//	Return Amenit Data

function getYesNo($bval) {
    if ($bval == 1)
        $getopt = "Yes";
    else
        $getopt = "No";
    return $getopt;
}

///////////////////////////////////////////////////////////////
//	Return Plan Details

function getPlanDetails($planID) {
    //echo 'Plan Details are here';
    $getPlans = mysql_query("SELECT * FROM `plans` WHERE `id`='" . $planID . "'");
    $row = mysql_fetch_assoc($getPlans);
    return $row;
}

//	Return Property Plans

function getPropertyPlanDetails() {

    $getPlans = mysql_query("SELECT * FROM `property_plan` WHERE `status`='1' AND `plan_id`!='1' AND `plan_id`!='5'");
    while ($row = mysql_fetch_assoc($getPlans)) {
        $planDetail[] = $row;
    }
    return $planDetail;
}

//	Return plan features name

function getPlanFeaturesName($planFeatureId) {

    $getPlansFeatures = mysql_query("SELECT * FROM `plan_features` WHERE `status`='1' AND `id` IN (" . $planFeatureId . ") ORDER BY `feature_sort_order`");
    while ($row = mysql_fetch_assoc($getPlansFeatures)) {
        $plansFeaturesName[$row['id']] = $row['feature_name'];
    }
    return $plansFeaturesName;
}

//	Return plan name

function getPlanName($planId) {

    $getPlans = mysql_query("SELECT * FROM `plans` WHERE `status`='1' AND `id`='" . $planId . "'");
    while ($row = mysql_fetch_assoc($getPlans)) {
        $plansName = $row['plan_name'];
    }
    return $plansName;
}

//	Return Owner name

function getOwnerName($ownerId) {

    $getOwner = mysql_query("SELECT * FROM `" . MEMBERS_TABLE . "` WHERE `member_id`='" . $ownerId . "'");
    while ($row = mysql_fetch_assoc($getOwner)) {
        $ownerName = ucwords(stripslashes($row['member_fname']) . ' ' . stripslashes($row['member_lname']));
    }
    return $ownerName;
}

//	Return Property name

function getPropertyName($propertyId, $propertyType) {

    if ($propertyType == 1) {
        $tableName = 'property_rental';
        $fieldIDname = 'property_rental_id';
    } else {
        $tableName = 'property_sale';
        $fieldIDname = 'property_sale_id';
    }

    $getProperty = mysql_query("SELECT * FROM `" . $tableName . "` WHERE `$fieldIDname`='" . $propertyId . "'");
    while ($row = mysql_fetch_assoc($getProperty)) {
        $propertyName = ucwords($row['property_name']);
    }
    return $propertyName;
}

function getImages($id, $pro_type) {
    // echo $id.'<--id'.$pro_type.'<--proptype'.$img_type.'<--image';
    $image = new SimpleImage();

    $show.="";
    $imgsql = "select * from " . ADDITIONAL_IMAGES . " where property_type='" . $pro_type . "'  and isDelete=0 and isActive=1 and property_id=" . $id;

    $imgrs = mysql_query($imgsql);
    $i = 1;
    if (mysql_num_rows($imgrs) > 0) {

        while ($imgrw = mysql_fetch_array($imgrs)) {

            $folder = "../additional_images_small/";
            if (file_exists($folder . $imgrw['image_name'])) {

                $show.= '<div style="border:0px solid #FF0000; float:left; width:220px;">';

                $show.="&nbsp;&nbsp;&nbsp;<div style='border:0px solid #0000FF;  width:220px; height:120px;'><img src='" . $folder . $imgrw['image_name'] . "'></div>
				<p><a href='property_image_list.php?img_id=" . $imgrw['additional_image_id'] . "&proid=" . $id . "&protype=" . $pro_type . "'>Delete</a></p>";
                $show.= '</div>';
            }
            $i++;
        }
    } else {
        $show.="<div>No Images Found</div>";
    }
    return $show;
}

function sendMailToCottageAlert($id, $propType) {
    global $alert_message_mail_subject, $cottage_alert_mail_from;
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: Cottage Support<' . $cottage_alert_mail_from . '>' . "\r\n";

    if ($propType == 1) {
        $alert_message_mail_message = "New property listed in our site.<br>Please <a href='http://" . $_SERVER['HTTP_HOST'] . "/cottage/property_rental_detail.php?property_id=" . $id . "'>click here</a> to view this property.";
    } else {
        $alert_message_mail_message = "New property listed in our site.<br>Please <a href='http://" . $_SERVER['HTTP_HOST'] . "/cottage/property_sales_detail.php?property_id=" . $id . "'>click here</a> to view this property.";
    }
    $alert_sql = "select * from `cottage_alert`";
    $alert_rs = mysql_query($alert_sql);
    //echo $alert_message_mail_message;die;
    while ($alert_rw = mysql_fetch_array($alert_rs)) {
        $response = mail($alert_rw['email_address'], $alert_message_mail_subject, $alert_message_mail_message, $headers);
    }

    return $response;
}

function sendMailToCustomerPlanAlert($id, $propType) {
    global $alert_message_mail_subject, $cottage_alert_mail_from;
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//$headers .= 'To: Mary <mary@example.com>' . "\r\n";
    $headers .= 'From: Cottage Support<' . $cottage_alert_mail_from . '>' . "\r\n";


    if ($propType == 1) {
        $alert_message_mail_message = "New property listed in our site.<br>Please <a href='http://" . $_SERVER['HTTP_HOST'] . "/cottage/property_rental_detail.php?property_id=" . $id . "'>click here</a> to view this property.";
    } else {
        $alert_message_mail_message = "New property listed in our site.<br>Please <a href='http://" . $_SERVER['HTTP_HOST'] . "/cottage/property_sales_detail.php?property_id=" . $id . "'>click here</a> to view this property.";
    }
    $customer_sql = "select `customer_email` from `customers` where `all_plan`='1'";
    $customer_rs = mysql_query($customer_sql);
    while ($customer_rw = mysql_fetch_array($customer_rs)) {
        $response = mail($customer_rw['customer_email'], $alert_message_mail_subject, $alert_message_mail_message, $headers);
    }
    return $response;
}

function sendMailToCottageOwner($id, $propType) {
    global $alert_message_mail_subject, $cottage_alert_mail_from;
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: Cottage Support<' . $cottage_alert_mail_from . '>' . "\r\n";
    $alert_message_mail_message = "
				<img src='http://go4php.com/cottage/images/cottage_logo.jpg' alt='Cottage Logo'><br />
				Thank you for listing your property on OnlineCottageRental.com.<br />
				To view you listing click - ";
    if ($propType == 1) {
        $alert_message_mail_message .= "<a href='http://" . $_SERVER['HTTP_HOST'] . "/cottage/property_rental_detail.php?property_id=" . $id . "'>click here</a>";
        $customer_sql = "select `member_email` from `members`,`property_rental` where property_rental.member_id=members.member_id";
    } else {
        $alert_message_mail_message .= "<a href='http://" . $_SERVER['HTTP_HOST'] . "/cottage/property_sales_detail.php?property_id=" . $id . "'>click here</a>";
        $customer_sql = "select `member_email` from `members`,`property_sale` where property_sale.member_id=members.member_id";
    }
    $alert_message_mail_message .= "<br />
				Please feel free to use your property listing link in any other online or email communication you do.<br />
				If you would like to edit your listing or update your calendar, sign-in to your owner account.<br />
				We look forward to finding you the best renters for your property.<br />
				If you have any questions please contact us at info@onlinecottagerental.com<br />
				To unsubscribe to from future email correspondence click on the following link: Unsubscribe
			";

    //echo $alert_message_mail_message;die;


    $customer_rs = mysql_query($customer_sql);
    while ($customer_rw = mysql_fetch_array($customer_rs)) {
        $response = mail($customer_rw['member_email'], $alert_message_mail_subject, $alert_message_mail_message, $headers);
    }
    return $response;
}

/*

  function getShortDescription($descVal, $limit=''){
  $descVal = stripslashes($descVal);
  $strLen = strlen( $descVal );
  if($strLen > $limit){
  $collespeStr = substr($descVal,0,$limit).'...';
  $displayStr = $collespeStr;
  }else{
  $displayStr = $descVal;
  }
  return $displayStr;
  }

 */

function getServiceTitle($provinceID = '') {

    if ($provinceID == '') {
        $sql = mysql_query("SELECT * FROM `services_title` ORDER BY `order`");
        while ($row = mysql_fetch_assoc($sql)) {
            $provinceArray[$row['id']] = $row['title'];
        }
        //print_r($provinceArray);die;
        return $provinceArray;
    } else {
        $sql = mysql_query("SELECT `title` FROM `services_title` WHERE `isDelete`='0' AND `isActive`='1' AND `id`='" . $provinceID . "'");
        while ($row = mysql_fetch_assoc($sql)) {
            $provinceName = $row['title'];
        }
        echo $provinceName;
    }
}

function getServiceSubTitle($titleID = '', $subTitleID = '') {

    if ($titleID != '' && $subTitleID == '') {
        $sql = mysql_query("SELECT * FROM `services_sub_title` WHERE `title_id`='" . $titleID . "' ORDER BY `order`");
        while ($row = mysql_fetch_assoc($sql)) {
            $provinceArray[$row['id']] = $row['subtitle'];
        }
        //print_r($provinceArray);die;
        return $provinceArray;
    } elseif ($titleID == '' && $subTitleID == '') {
        //echo "SELECT * FROM `services_sub_title` WHERE `isDelete`='0' AND `isActive`='1' ORDER BY `order`";die;
        $sql = mysql_query("SELECT * FROM `services_sub_title` WHERE `isDelete`='0' AND `isActive`='1' ORDER BY `order`");
        while ($row = mysql_fetch_assoc($sql)) {
            $subTitleArray[$row['id']] = $row['subtitle'];
        }
        //print_r($provinceArray);die;
        return $subTitleArray;
    } else {//echo "SELECT `title` FROM `services_sub_title` WHERE `isDelete`='0' AND `isActive`='1' AND `id`='".$subTitleID."'";die;
        $sql = mysql_query("SELECT `subtitle` FROM `services_sub_title` WHERE `isDelete`='0' AND `isActive`='1' AND `id`='" . $subTitleID . "'");
        while ($row = mysql_fetch_assoc($sql)) {
            $provinceName = $row['subtitle'];
        }
        echo $provinceName;
    }
}

function sendCottageAlertMailPlanApproval($id, $propType) {
    global $alert_message_mail_subject, $cottage_alert_mail_from;
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: Cottage Support<' . $cottage_alert_mail_from . '>' . "\r\n";

    if ($propType == 1) {
        $alert_message_mail_message = "Property plan has been approved on our site.<br>Please <a href='http://" . $_SERVER['HTTP_HOST'] . "/cottage/property_rental_detail.php?property_id=" . $id . "'>click here</a> to view this property.";
    } else {
        $alert_message_mail_message = "Property plan has been approved on our site.<br>Please <a href='http://" . $_SERVER['HTTP_HOST'] . "/cottage/property_sales_detail.php?property_id=" . $id . "'>click here</a> to view this property.";
    }
    $alert_sql = "select * from `cottage_alert`";
    $alert_rs = mysql_query($alert_sql);
    //echo $alert_message_mail_message;die;
    while ($alert_rw = mysql_fetch_array($alert_rs)) {
        $response = mail($alert_rw['email_address'], $alert_message_mail_subject, $alert_message_mail_message, $headers);
    }

    return $response;
}

function sendOwnerMailPlanApproval($id, $propType) {
    global $alert_message_mail_subject, $cottage_alert_mail_from;
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: Cottage Support<' . $cottage_alert_mail_from . '>' . "\r\n";



    if ($propType == 1) {
        $getOwner = mysql_query("SELECT M.`member_email` FROM `property_rental` as PR, `members` as M WHERE PR.`property_rental_id`='" . $id . "' AND PR.`member_id`=M.`member_id`");

        $alert_message_mail_message = "Property plan has been approved on our site.<br>Please <a href='http://" . $_SERVER['HTTP_HOST'] . "/cottage/property_rental_detail.php?property_id=" . $id . "'>click here</a> to view this property.";
    } else {
        $getOwner = mysql_query("SELECT M.`member_email` FROM `property_sale` as PR, `members` as M WHERE PR.`property_sale_id`='" . $id . "' AND PR.`member_id`=M.`member_id`");
        $alert_message_mail_message = "Property plan has been approved on our site.<br>Please <a href='http://" . $_SERVER['HTTP_HOST'] . "/cottage/property_sales_detail.php?property_id=" . $id . "'>click here</a> to view this property.";
    }

    $rowgetOwner = mysql_fetch_assoc($getOwner);


    $response = mail($rowgetOwner['member_email'], $alert_message_mail_subject, $alert_message_mail_message, $headers);


    return $response;
}

function sendMailToCustomerPlanApproval($id, $propType) {
    global $alert_message_mail_subject, $cottage_alert_mail_from;
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//$headers .= 'To: Mary <mary@example.com>' . "\r\n";
    $headers .= 'From: Cottage Support<' . $cottage_alert_mail_from . '>' . "\r\n";


    if ($propType == 1) {
        $alert_message_mail_message = "Property plan has been approved on our site.<br>Please <a href='http://" . $_SERVER['HTTP_HOST'] . "/cottage/property_rental_detail.php?property_id=" . $id . "'>click here</a> to view this property.";
    } else {
        $alert_message_mail_message = "Property plan has been approved on our site.<br>Please <a href='http://" . $_SERVER['HTTP_HOST'] . "/cottage/property_sales_detail.php?property_id=" . $id . "'>click here</a> to view this property.";
    }
    $customer_sql = "select `customer_email` from `customers` where `all_plan`='1'";
    $customer_rs = mysql_query($customer_sql);
    while ($customer_rw = mysql_fetch_array($customer_rs)) {
        $response = mail($customer_rw['customer_email'], $alert_message_mail_subject, $alert_message_mail_message, $headers);
    }
    return $response;
}

function checkadmin($username, $password) {
    $query = "select * from `admin` where `username` = '$username' and `password` = '$password' and `isactive`=1 and `isdelete`=0";

    $result = mysql_query($query) or die("Query failed due to: " . mysql_error());

    $row = mysql_fetch_assoc($result);


    if ($row == null) {

        $Error = "Invalid USER NAME or PASSWORD";
    } else {
        //Site_Updated();

        $_SESSION['session_id_admin'] = $row['adminid'];
        header("location:dashboard.php");
        exit();
    }
}

function changepassword($oldpassword, $newpassword, $session_id_admin) {


    echo $oldpassword . " " . $newpassword . " " . $session_id_admin;
    $query = "select * from `admin` where `adminid` = '$session_id_admin' and `password` = '$oldpassword';";


    echo "select * from `admin` where `adminid` = '$session_id_admin' and `password` = '$oldpassword';";

    $result = mysql_query($query) or die("Query failed due to: " . mysql_error());

    $row = mysql_fetch_assoc($result);

    if ($row == null) {
        $Error = "Invalid Request";
    } else {
        $query = "update `admin` set 
										`password` = '$password_new'										
										 where adminid = " . $row['adminid'];
        $exec_query = mysql_query($query) or die("ERROR" . mysql_error());

        $Response_Message = "Password has been changed";
        echo $Response_Message;
    }
}

function checkuser() {
    
}

// Function for creating drop down
function tep_draw_pull_down_menu($name, $values, $default = '', $parameters = '', $required = false) {
    global $HTTP_GET_VARS, $HTTP_POST_VARS;

    $field = '<select name="' . tep_output_string($name) . '"';

    if (check_not_null($parameters))
        $field .= ' ' . $parameters;

    $field .= '>';

    if (empty($default) && ( (isset($HTTP_GET_VARS[$name]) && is_string($HTTP_GET_VARS[$name])) || (isset($HTTP_POST_VARS[$name]) && is_string($HTTP_POST_VARS[$name])) )) {
        if (isset($HTTP_GET_VARS[$name]) && is_string($HTTP_GET_VARS[$name])) {
            $default = stripslashes($HTTP_GET_VARS[$name]);
        } elseif (isset($HTTP_POST_VARS[$name]) && is_string($HTTP_POST_VARS[$name])) {
            $default = stripslashes($HTTP_POST_VARS[$name]);
        }
    }

    for ($i = 0, $n = sizeof($values); $i < $n; $i++) {
        $field .= '<option value="' . tep_output_string($values[$i]['id']) . '"';
        if ($default == $values[$i]['id']) {
            $field .= ' SELECTED';
        }

        $field .= '>' . tep_output_string($values[$i]['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;')) . '</option>';
    }
    $field .= '</select>';

    if ($required == true)
        $field .= TEXT_FIELD_REQUIRED;

    return $field;
}

// Function for formating output string by changing special character in html formate
function tep_output_string($string, $translate = false, $protected = false) {
    if ($protected == true) {
        return htmlspecialchars($string);
    } else {
        if ($translate == false) {
            return tep_parse_input_field_data($string, array('"' => '&quot;'));
        } else {
            return tep_parse_input_field_data($string, $translate);
        }
    }
}

// function for parsing inupt data by removing leading and trailing spaces
function tep_parse_input_field_data($data, $parse) {
    return strtr(trim($data), $parse);
}

//  function for creating checkbox
function tep_draw_checkbox_field($name, $value = '', $checked = false, $compare = '') {
    return tep_draw_selection_field($name, 'checkbox', $value, $checked, $compare);
}

// function for creating input field with a selected value
function tep_draw_selection_field($name, $type, $value = '', $checked = false, $compare = '') {
    global $HTTP_GET_VARS, $HTTP_POST_VARS;

    $selection = '<input type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '"';

    if (check_not_null($value))
        $selection .= ' value="' . tep_output_string($value) . '"';

    if (($checked == true) || (isset($HTTP_GET_VARS[$name]) && is_string($HTTP_GET_VARS[$name]) && (($HTTP_GET_VARS[$name] == 'on') || (stripslashes($HTTP_GET_VARS[$name]) == $value))) || (isset($HTTP_POST_VARS[$name]) && is_string($HTTP_POST_VARS[$name]) && (($HTTP_POST_VARS[$name] == 'on') || (stripslashes($HTTP_POST_VARS[$name]) == $value))) || (check_not_null($compare) && ($value == $compare))) {
        $selection .= ' CHECKED';
    }

    $selection .= '>';

    return $selection;
}

// functiong for creating in input box 
function tep_draw_input_field($name, $value = '', $parameters = '', $required = false, $type = 'text', $reinsert_value = true) {
    global $HTTP_GET_VARS, $HTTP_POST_VARS;

    $field = '<input type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '" id="' . tep_output_string($name) . '"';

    if (($reinsert_value == true) && ( (isset($HTTP_GET_VARS[$name]) && is_string($HTTP_GET_VARS[$name])) || (isset($HTTP_POST_VARS[$name]) && is_string($HTTP_POST_VARS[$name])) )) {
        if (isset($HTTP_GET_VARS[$name]) && is_string($HTTP_GET_VARS[$name])) {
            $value = stripslashes($HTTP_GET_VARS[$name]);
        } elseif (isset($HTTP_POST_VARS[$name]) && is_string($HTTP_POST_VARS[$name])) {
            $value = stripslashes($HTTP_POST_VARS[$name]);
        }
    }

    if (check_not_null($value)) {
        $field .= ' value="' . tep_output_string($value) . '"';
    }

    if (check_not_null($parameters))
        $field .= ' ' . $parameters;

    $field .= 'style="border:1px solid #eaeeee;background:#fff url(images/form_red.gif) repeat-x top left;">';

    if ($required == true)
        $field .= TEXT_FIELD_REQUIRED;

    return $field;
}
 



?>
