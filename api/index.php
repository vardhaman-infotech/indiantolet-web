<?php

date_default_timezone_set('Asia/Kolkata');
//date_default_timezone_set('Europe/Berlin');
include 'db.php'; // DB connection
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();



/* --------------------Start IndianTolet API ------------------ */


/* Owner Testing Android Notification API URL */
$app->post('/Test_Android_Notification', 'Test_Android_Notification');
/* Farmer Login API URL */
$app->post('/Test_Ios_Notification', 'Test_Ios_Notification');

$app->post('/logout', 'logout');

/* --------------------Start Owner IndianTolet API ------------------ */

//Owner Login  API URL
$app->post('/Owner_Login', 'Owner_Login');

//User Registration  API URL
$app->post('/Owner_Registration', 'Owner_Registration');
//Owner Registration  API URL
$app->post('/Owner_Dashboard', 'Owner_Dashboard');

// Owner   Info Edit API URL
$app->post('/Owner_Info', 'Owner_Info');

// Owner  Info Update API URL
$app->post('/Owner_Info_Update', 'Owner_Info_Update');

// Owner Forgot Password API URL
$app->post('/Owner_ForgotPassword', 'Owner_ForgotPassword');

//Owner  Change passoword API URL
$app->post('/Owner_Changepassword', 'Owner_Changepassword');
//Owner  Owner property list API URL
$app->post('/Owner_Property_List', 'Owner_Property_List');
//Owner  Owner property list API URL
$app->post('/Owner_Add_property', 'Owner_Add_property');
//Owner  Owner property list API URL
$app->post('/Owner_Update_property', 'Owner_Update_property');
//Tenant Tenant Verify OTP  API URL
$app->post('/Owner_VerifyOTP', 'Owner_VerifyOTP');
//Tenant Tenant Verify OTP  API URL
$app->post('/Owner_ResendOTP', 'Owner_ResendOTP');
//Tenant Tenant Verify OTP  API URL
$app->post('/Owner_UpdatePhoneNumber', 'Owner_UpdatePhoneNumber');

//Owner  floor list API URL
$app->post('/Floor_List', 'Floor_List');
//Owner  BHK list API URL
$app->post('/Bhk_List', 'Bhk_List');

/* * **********************Start Tenant API*************** */

//Tenant Login  API URL
$app->post('/Tenant_Login', 'Tenant_Login');

//Tenant Registration  API URL
$app->post('/Tenant_Registration', 'Tenant_Registration');

//Tenant Tenant Verify OTP  API URL
$app->post('/Tenant_VerifyOTP', 'Tenant_VerifyOTP');
//Tenant Tenant Verify OTP  API URL
$app->post('/Tenant_ResendOTP', 'Tenant_ResendOTP');
//Tenant Tenant Verify OTP  API URL
$app->post('/Tenant_UpdatePhoneNumber', 'Tenant_UpdatePhoneNumber');
// Owner  Info Update API URL
$app->post('/Tenant_Info_Update', 'Tenant_Info_Update');

// Owner Forgot Password API URL
$app->post('/Tenant_ForgotPassword', 'Tenant_ForgotPassword');

//Owner  Change passoword API URL
$app->post('/Tenant_Changepassword', 'Tenant_Changepassword');
//Owner  Owner property list API URL
$app->post('/Tenant_Property_List', 'Tenant_Property_List');
//For Update tenant location
$app->post('/Update_Tenant_Location', 'Update_Tenant_Location');
//For Tenant Payment
$app->post('/Tenant_Payment', 'Tenant_Payment');

$app->run();



/* ---------------------- Start Owner API ---------------------- */

// Start Owner Registration function
function Owner_Registration() { //echo 'fdfd';die;
    global $app;
    $req = $app->request(); // Getting parameter with names

    $name = $req->params('name');
    $address = $req->params('address');
    $phone_number = $req->params('phone_number');
    $email_id = $req->params('email_id');
    $password = $req->params('password');
    $login_from = $req->params('login_from'); //'0'=>android,'1'=>i-phone 
    $device_id = $req->params('device_id');
    $fcm_token = $req->params('fcm_token');
    //$auth_token = $req->params('auth_token'); // For LinkedIn Image

    $curent_timestamp = date('Y-m-d H:i:s');


    if (!empty($name) && !empty($phone_number) && !empty($email_id) && isset($login_from) && !empty($password) && !empty($address)) {

        try {
            $dbCon = getDB();
            $query = "SELECT id,email_id,phone_number FROM tbl_owner WHERE  ( email_id='$email_id' OR phone_number='$phone_number')";
            $stmt = $dbCon->query($query);
            $user_info = $stmt->fetch(PDO::FETCH_OBJ);
            $result = $stmt->rowCount();

            if ($result == '0') {
                $Setpassword = hash("sha512", $password);
                $otp = mt_rand(1000, 9999); //For generate otp
                $sth = $dbCon->prepare("INSERT INTO tbl_owner SET name='$name',phone_number='$phone_number',address_line1='$address',email_id='$email_id',password='$Setpassword',owner_otp='$otp',login_from='$login_from',device_id='$device_id',fcm_token='$fcm_token',auth_token='" . APP_TOKEN . "',is_active='1',created_date='$curent_timestamp'");
                $sth->execute();
                $lastInsertId = $dbCon->lastInsertId();

                $sql = "SELECT * FROM tbl_owner WHERE id='$lastInsertId'";
                $stmt_sql = $dbCon->query($sql);
                $users_info = $stmt_sql->fetch(PDO::FETCH_OBJ);

                //User Send Registration Mail
                /*  $imglogo = DEFAULT_URL . 'images/logo.png';
                  $mail_query = "SELECT email_for,email_subject,email_description FROM tbl_emails WHERE email_id='3'";
                  $stmt_mail = $dbCon->query($mail_query);
                  $mailer_info = $stmt_mail->fetch(PDO::FETCH_OBJ);
                  $emailval = $mailer_info->email_description;
                  $array = array('@name' => ucfirst($name), '@email' => $email_id, '@password' => $password, '@imglogo' => $imglogo);
                  foreach ($array AS $key => $value) {
                  $emailval = str_replace($key, $value, $emailval);
                  }
                  Sendmail($email_id, $mailer_info->email_subject, $emailval);

                  $imglogo = DEFAULT_URL . 'images/logo.png';
                  $mail_query1 = "SELECT email_for,email_subject,email_description FROM tbl_emails WHERE email_id='6'";
                  $stmt_mail1 = $dbCon->query($mail_query1);
                  $mailer_info1 = $stmt_mail1->fetch(PDO::FETCH_OBJ);
                  $emailval1 = $mailer_info1->email_description;
                  $array = array('@name' => ucfirst($name), '@otp' => $otp, '@imglogo' => $imglogo);
                  foreach ($array AS $key => $value) {
                  $emailval1 = str_replace($key, $value, $emailval1);
                  }
                  Sendmail($email_id, 'Please verify your OTP', $emailval1); */
                $sms = 'Your indiantolet verification code is ' . $otp;
                sendsms($sms, $users_info->phone_number);
                $success_array = array('success' => '1', 'text' => 'Owner Registered Successfully with INDIA TO-LET', 'owner_info' => $users_info);
                echo $senddata = json_encode($success_array);
            } else {
                $user_array = array('success' => '0', 'text' => 'Owner Already Registered!');
                echo $senddata = json_encode($user_array);
            }
        } catch (PDOException $e) {
            $error_array = array('success' => '0', 'text' => $e->getMessage());
            echo $senddata = json_encode($error_array);
        }
    } else {
        $error_array = array('success' => '0', 'text' => 'All fields are Required !');
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Owner_Registration');
}

/* Start Owner Login Api Function */

function Owner_Login() {
    global $app;
    $req = $app->request(); // Getting parameter with names 
    $email_id = $req->params('email_id');
    $password = $req->params('password');
    $device_id = $req->params('device_id');
    $fcm_token = $req->params('fcm_token');
    $login_from = $req->params('login_from'); //'0'=>android,'1'=>i-phone 
    $curent_timestamp = date('Y-m-d H:i:s');
    $auth_token = APP_TOKEN;

    if (!empty($email_id) && !empty($password) && $login_from != '') {

        $Setpassword = hash("sha512", $password);
        $dbCon = getDB();
        $check = '';

        //$sql_check = "SELECT id,email_id FROM tbl_user WHERE $check ";
        $sql_query = "SELECT id,name,email_id,phone_number,fcm_token,device_id,is_active,login_from,otp_verify FROM tbl_owner WHERE email_id='$email_id' AND password='$Setpassword'";

        try {

            $stmt = $dbCon->query($sql_query);
            $owner_info = $stmt->fetch(PDO::FETCH_OBJ);
            $result = $stmt->rowCount();

            if ($result == '1') {

                if ($owner_info->is_active == '0') {
                    // Check Owner is Active Or Not
                    $error_array = array('success' => '0', 'text' => "Your Id is Deactivate. Please Contact to Admin!");
                    echo $senddata = json_encode($error_array);
                } elseif ($owner_info->otp_verify == '0') { //For when otp not verify
                    $otp = mt_rand(1000, 9999); //For generate otp
                    //$message = 'Your OTP verification code is ' . $otp;
                    //SendSms($message, $owner_info->phone_number);
                    /* For update new otp here */
                    $sthUpdate = $dbCon->prepare("UPDATE tbl_owner SET owner_otp ='$otp' WHERE id = '$owner_info->id'");
                    $sthUpdate->execute();
                    /* For Send OTP */
                    $imglogo = DEFAULT_URL . 'images/logo.png';
                    $mail_query1 = "SELECT email_for,email_subject,email_description FROM tbl_emails WHERE email_id='6'";
                    $stmt_mail1 = $dbCon->query($mail_query1);
                    $mailer_info1 = $stmt_mail1->fetch(PDO::FETCH_OBJ);
                    $emailval1 = $mailer_info1->email_description;
                    $array = array('@name' => ucfirst($owner_info->name), '@otp' => $otp, '@imglogo' => $imglogo);
                    foreach ($array AS $key => $value) {
                        $emailval1 = str_replace($key, $value, $emailval1);
                    }
                    //Sendmail($email_id, 'Please verify your OTP', $emailval1);
                    $sms = 'Your indiantolet verification code is ' . $otp;
                    sendsms($sms, $owner_info->phone_number);
                    $error_array = array('success' => '2', 'text' => "Please verify your OTP!", "userId" => $owner_info->id, "phone_number" => $owner_info->phone_number, "otp" => $otp);
                    echo $senddata = json_encode($error_array);
                } else {

                    if (isset($owner_info->device_id) && $owner_info->device_id != $device_id && !empty($owner_info->fcm_token)) {
                        if ($owner_info->login_from == '1') {
                            // iphone_send_notification_logout('Logout', 'You have login from other device', $user_info->fcm_token);
                        } else {
                            android_send_notification($owner_info->id, 'You have login from other device', $owner_info->fcm_token, 'Logout');
                        }
                    }
                    // Update device_id fcm token
                    $sth = $dbCon->prepare("UPDATE tbl_owner SET device_id ='$device_id',login_from='$login_from',fcm_token='$fcm_token',auth_token='$auth_token' WHERE id = '$owner_info->id'");
                    $sth->execute();
                    // User Info
                    $sql_query = "SELECT * FROM tbl_owner WHERE id='$owner_info->id'";
                    $stmt = $dbCon->query($sql_query);
                    $owner_info = $stmt->fetch(PDO::FETCH_OBJ);
                    // $lastresult = array('0'=>$users_info);z
                    $success_array = array('success' => '1', 'owner_info' => $owner_info, 'text' => 'You have successfully logged In');
                    echo $senddata = json_encode($success_array);
                }
            } else {
                $error_array = array('success' => '0', 'text' => "Email Id or Password don't match!");
                echo $senddata = json_encode($error_array);
            }
        } catch (PDOException $e) {
            $error_array = array('success' => '0', 'text' => $e->getMessage());
            echo $senddata = json_encode($error_array);
        }
    } else {
        $error_array = array('success' => '0', 'text' => 'All fields Required !');
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Owner_Login');
}

/* End Owner Login Api Function */

function Owner_Dashboard() {
    global $app;
    $req = $app->request(); // Getting parameter with names
    $user_id = $req->params('owner_id');
    $token = $req->params('auth_token');
    $dbCon = getDB();
    /* For get admin email id */
    $sql_check = "SELECT admin_email,owner_charge,tenant_charge from tbl_admin WHERE admin_id='1'";
    $stmt_check = $dbCon->query($sql_check);
    $admin_info = $stmt_check->fetch(PDO::FETCH_OBJ);
    if (!empty($user_id) && !empty($token)) {

        if (checkAuthenticationOwner($token) == 1) {
            try {

                $query = "SELECT COUNT(IF(property_type_id = '1',1, NULL)) AS flat,COUNT(IF( property_type_id = '2',1, NULL)) AS vila,COUNT(IF( property_type_id = '3',1, NULL)) AS independent FROM tbl_property WHERE owner_id='$user_id'";
                $stmt = $dbCon->query($query);
                $propertyDetail = $stmt->fetch(PDO::FETCH_OBJ);

                $success_array = array('success' => '1', 'propertyDetail' => $propertyDetail, 'owner_charge' => $admin_info->owner_charge, 'tenant_charge' => $admin_info->tenant_charge, 'contact_email' => $admin_info->admin_email);
                echo $senddata = json_encode($success_array);
            } catch (PDOException $e) {
                $error_array = array('success' => '0', 'text' => $e->getMessage());
                echo $senddata = json_encode($error_array);
            }
        } else {
            $error_array = array('success' => '0', 'text' => 'Token not valid !', 'owner_charge' => $admin_info->owner_charge, 'tenant_charge' => $admin_info->tenant_charge);
            echo $senddata = json_encode($error_array);
        }
    } else {
        $error_array = array('success' => '0', 'text' => 'All fields Required !', 'owner_charge' => $admin_info->owner_charge, 'tenant_charge' => $admin_info->tenant_charge);
        echo $senddata = json_encode($error_array);
    }

    savelogs($senddata, 'Owner_Dashboard');
}

// Start Owner Info Edit Function
function Owner_Info() {
    global $app;
    $req = $app->request(); // Getting parameter with names
    $user_id = $req->params('owner_id');
    $token = $req->params('auth_token');
    $curent_timestamp = date('Y-m-d h:i:s');
    $curent_date = date('Y-m-d');
    if (!empty($user_id) && !empty($token)) {
        $dbCon = getDB();
        if (checkAuthenticationOwner($token) == 1) {
            try {
                // Check user exits or not in farmer table         
                $sql_check = "SELECT id from tbl_owner WHERE id='$user_id'";
                $stmt_check = $dbCon->query($sql_check);
                $result_check = $stmt_check->rowCount();
                if ($result_check > 0) {// Check user exits or not in farmer table
                    $query = "SELECT id,name,email_id,phone_number,address_line1,fcm_token,device_id,auth_token,login_from,is_active,created_date,modification_date FROM tbl_owner WHERE id='$user_id'";
                    $stmt = $dbCon->query($query);
                    $user_info = $stmt->fetch(PDO::FETCH_OBJ);

                    $success_array = array('success' => '1', 'owner_info' => $user_info);
                    echo $senddata = json_encode($success_array);
                } else {
                    $success_array = array('success' => '0', 'text' => 'Owner details is not available');
                    echo $senddata = json_encode($success_array);
                }
            } catch (PDOException $e) {
                $error_array = array('success' => '0', 'text' => $e->getMessage());
                echo $senddata = json_encode($error_array);
            }
        } else {
            $error_array = array('success' => '0', 'text' => 'Token not valid !');
            echo $senddata = json_encode($error_array);
        }
    } else {
        $error_array = array('success' => '0', 'text' => 'All fields Required !');
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Owner_Info');
}

// Start Owner Info Update Function
function Owner_Info_Update() {

    global $app;
    $req = $app->request(); // Getting parameter with names
    $user_id = $req->params('owner_id');
    $email_id = $req->params('email_id');
    $name = $req->params('name');
    $phone_number = $req->params('phone_number');
    $address = $req->params('address');
    $token = $req->params('auth_token');
    $current_timestamp = date('Y-m-d H:i:s');

    if (!empty($user_id) && !empty($email_id) && !empty($name) && !empty($phone_number) && !empty($address) && !empty($token)) {

        if (checkAuthenticationOwner($token) == 1) {
            $dbCon = getDB();
            $sql_check = "SELECT email_id FROM tbl_owner WHERE email_id='$email_id' AND id!='$user_id'";
            $stmt_check = $dbCon->query($sql_check);
            $result_check = $stmt_check->rowCount();
            try {

                if ($result_check == 0) {
                    $sth = $dbCon->prepare("UPDATE tbl_owner SET name='$name',email_id='$email_id',phone_number='$phone_number',address_line1='$address',modification_date='$current_timestamp' WHERE id= '$user_id'");
                    $sth->execute();

                    $query = "SELECT id,name,email_id,phone_number,address_line1 FROM tbl_owner WHERE id='$user_id'";
                    $stmt = $dbCon->query($query);
                    $user_info = $stmt->fetch(PDO::FETCH_OBJ);

                    $success_array = array('success' => '1', 'owner_info' => $user_info, 'text' => 'Owner Info Updated Successfully');
                    echo $senddata = json_encode($success_array);
                } else {
                    $error_array = array('success' => '4', 'text' => 'Email ID Already Exists!');
                    echo $senddata = json_encode($error_array);
                }
            } catch (PDOException $e) {
                $error_array = array('success' => '0', 'text' => $e->getMessage());
                echo $senddata = json_encode($error_array);
            }
        } else {
            $error_array = array('success' => '5', 'text' => 'Token not valid !');
            echo $senddata = json_encode($error_array);
        }
    } else {
        $error_array = array('success' => '0', 'text' => 'All fields Required !');
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Owner_Info_Update');
}

// Start Owner Forgot Password Function
function Owner_ForgotPassword() {
    global $app;
    $req = $app->request(); // Getting parameter with names
    $obj_mail = new PHPMailerModel();
    $email_id = $req->params('email_id'); // get email id 
    $timestamp = date('Y-m-d H:i:s');
    if (!empty($email_id)) {
        try {
            $dbCon = getDB();
            $sql_query = "SELECT id,email_id,name FROM tbl_owner WHERE email_id='$email_id' AND is_active='1'";
            $stmt = $dbCon->query($sql_query);
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            $result = $stmt->rowCount();
            if ($result > 0) {


                //$url = MAIN_URL . 'india_tolet/tenant/forgotpassword/id/' . highlyencrpt($user->id, '*');
                $url = MAIN_URL . 'user/ownerforgotpassword/id/' . highlyencrpt($user->id, '*');
                $imglogo = DEFAULT_URL . 'images/logo.png';
                $new_password=randomPassword();
                $password = hash("sha512", $new_password);
               
                $update_pass = $dbCon->prepare("UPDATE tbl_owner SET password = '$password' WHERE id = '".$user->id."'");
                $update_pass->execute();

                $sql_query = "SELECT email_subject,email_description FROM tbl_emails WHERE email_id='5'";
                $stmt = $dbCon->query($sql_query);
                $mailer_info = $stmt->fetch(PDO::FETCH_OBJ);
                $emailval = $mailer_info->email_description;
                $subject = $mailer_info->email_subject;
                $array = array('@' => '', 'name' => ucfirst($user->name), 'imglogo' => $imglogo, 'newpassword' => $new_password);

                foreach ($array AS $key => $value) {
                    $emailval = str_replace($key, $value, $emailval);
                }
              //  echo $emailval;die;
                Sendmail($email_id, $subject, $emailval);
                // End send mail code

                $dbCon = null;
                $userArray = array('success' => '1', 'text' => 'Your New Password is Sent on your Email. Please Check!');
                echo $senddata = json_encode($userArray);
            } else {
                $error_array = array('success' => '0', 'text' => "Email doesn't Exists");
                echo $senddata = json_encode($error_array);
            }
        } catch (PDOException $e) {
            $error_array = array('success' => '0', 'text' => $e->getMessage());
            echo $senddata = json_encode($error_array);
        }
    } else {
        $error_array = array('success' => '0', 'text' => 'All Field Required');
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Owner_ForgotPassword');
}

/* END Owner  Forgot Passwordd FUNCTIONS POST */

/* Start Owner Change Password Function */

function Owner_Changepassword() {
    global $app;
    $req = $app->request(); // Getting parameter with names 
    $user_id = $req->params('owner_id');
    $old_password = hash('sha512', $req->params('old_password'));
    $new_passoword_f = $req->params('new_password');
    $new_password = hash('sha512', $new_passoword_f);
    $confirm_password = hash('sha512', $req->params('confirm_password'));
    $token = $req->params('auth_token');
    $timestamp = date('Y-m-d H:i:s');

    if (!empty($user_id)) { // check driver id
        if (checkAuthenticationOwner($token) == 1) {

            if ($new_password == $confirm_password) { // Check new password & confirm password matached or not
                $sql_query = "select id,name,email_id,password,phone_number,address_line1 FROM tbl_owner WHERE id='$user_id' AND is_active='1'";
                try {
                    $dbCon = getDB();
                    $stmt = $dbCon->query($sql_query);
                    $result = $stmt->rowCount();
                    // Check num rows 
                    if ($result > 0) {
                        $user = $stmt->fetch(PDO::FETCH_OBJ);

                        // Check driver old password 
                        if ($user->password == $old_password) {


                            // $tokenupdated = UpdateRiderToken($req->params('mobile_token')); // UPdate user token   
                            // Update driver password
                            $sth = $dbCon->prepare("UPDATE tbl_owner SET password = '$new_password',modification_date='$timestamp' WHERE id = $user_id");
                            $sth->execute();

                            // Send email code   
                            /*
                              $imglogo = DEFAULT_URL . 'images/logo.png'; // get logo url
                              $sql_query = "select email_for,email_subject,email_description FROM tbl_emails WHERE email_id='3' and is_active='1'";
                              $stmt = $dbCon->query($sql_query);
                              $mailer_info = $stmt->fetch(PDO::FETCH_OBJ);

                              $emailval = $mailer_info->email_description;
                              $subject = $mailer_info->email_subject;

                              $array = array('@' => '', 'name' => ucfirst($user->name), 'imglogo' => $imglogo, 'email' => $user->email_id, 'password' => $new_passoword_f);
                              foreach ($array AS $key => $value) {
                              $emailval = str_replace($key, $value, $emailval);
                              }

                              Sendmail($user->email_id, $subject, $emailval); // send code function
                             * 
                             */
                            // End email send code                          
                            $dbCon = null;
                            $driver_array = array('success' => '1', 'text' => 'Password successfully updated');
                            echo $senddata = json_encode($driver_array);
                        } else {
                            $error_array = array('success' => '2', 'text' => 'Old password doesn\'t match!');
                            echo $senddata = json_encode($error_array);
                        }
                    } else {
                        $error_array = array('success' => '3', 'text' => 'Owner doesn\'t exists!');
                        echo $senddata = json_encode($error_array);
                    }
                } catch (PDOException $e) {
                    $error_array = array('success' => '7', 'text' => $e->getMessage());
                    echo $senddata = json_encode($error_array);
                }
            } else {
                $error_array = array('success' => '4', 'text' => 'Confirm password doesn\'t match');
                echo $senddata = json_encode($error_array);
            }
        } else {
            $error_array = array('success' => '5', 'text' => 'Token not valid !');
            echo $senddata = json_encode($error_array);
        }
    } else {
        $error_array = array('success' => '8', 'text' => 'All fields Required !');
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Owner_Changepassword');
}

/* Start Owner property listing Function */

function Owner_Property_List() {
    global $app;
    $req = $app->request(); // Getting parameter with names 
    $user_id = $req->params('owner_id');
    $type = $req->params('type'); //type=>flat,type=>villa,type=>independent
    $token = $req->params('auth_token');
    $timestamp = date('Y-m-d H:i:s');

    if (!empty($user_id)) { // check driver id
        if (checkAuthenticationOwner($token) == 1) {

            try {
                if ($type == 'flat') { //for flat
                    $sql_query = "select * FROM tbl_property WHERE owner_id='$user_id' AND property_type_id='1' AND is_active='1'";
                } elseif ($type == 'villa') { //for villa
                    $sql_query = "select * FROM tbl_property WHERE owner_id='$user_id' AND property_type_id='2' AND is_active='1'";
                } else { //For independent
                    $sql_query = "select * FROM tbl_property WHERE owner_id='$user_id' AND property_type_id='3' AND is_active='1'";
                }
                $dbCon = getDB();
                $stmt = $dbCon->query($sql_query);
                $result = $stmt->rowCount();
                // Check num rows 
                $propertylist = $stmt->fetchAll(PDO::FETCH_OBJ);
                $PropertyArray = array();
                foreach ($propertylist as $propertylistVal) {
                    $ImageQuery = "select property_image FROM tbl_property_image WHERE property_id='$propertylistVal->id' ";
                    $stmt_images = $dbCon->query($ImageQuery);
                    $Images = $stmt_images->fetchAll(PDO::FETCH_OBJ);
                    /* For create a propert name */
                    if ($type == 'flat') { //for flat
                        $name = $propertylistVal->bhk . ' flat ';
                        if (isset($propertylistVal->floor) && !empty($propertylistVal->floor)) {
                            $name .= $propertylistVal->floor . ' floor';
                        }
                    } elseif ($type == 'villa') { //for villa
                        $name = "Villa";
                    } elseif ($type == 'independent') { //For independent
                        $name = "Independent";
                    }
                    $PropertyArray[] = array(
                        'id' => $propertylistVal->id,
                        'property_type_id' => $propertylistVal->property_type_id,
                        'owner_id' => $propertylistVal->owner_id,
                        //    'name' => $propertylistVal->name,
                        'name' => $name,
                        'floor' => $propertylistVal->floor,
                        'bhk' => $propertylistVal->bhk,
                        'no_of_room' => $propertylistVal->no_of_room,
                        'property_area' => $propertylistVal->property_area,
                        'location' => $propertylistVal->location,
                        'latitude' => $propertylistVal->latitude,
                        'longitude' => $propertylistVal->longitude,
                        'property_rent' => $propertylistVal->property_rent,
                        'house_no' => $propertylistVal->house_no,
                        'landmark' => $propertylistVal->landmark,
                        'additional_comment' => $propertylistVal->additional_comment,
                        'images' => $Images,
                        'is_property' => $propertylistVal->is_property
                    );
                }

                $dbCon = null;
                $driver_array = array('success' => '1', 'property_list' => $PropertyArray, 'ImageUrl' => IMAGE_UPLOAD_URL . '/property_image/');
                echo $senddata = json_encode($driver_array);
            } catch (PDOException $e) {
                $error_array = array('success' => '0', 'text' => $e->getMessage());
                echo $senddata = json_encode($error_array);
            }
        } else {
            $error_array = array('success' => '0', 'text' => 'Token not valid !');
            echo $senddata = json_encode($error_array);
        }
    } else {
        $error_array = array('success' => '0', 'text' => 'All fields Required !');
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Owner_Property_List');
}

//For owner add property function
function Owner_Add_property() {
    global $app;
    $req = $app->request(); // Getting parameter with names 
    $user_id = $req->params('owner_id');
    $txnid = $req->params('txnid');
    $owner_charge = $req->params('owner_charge');
    $name = $req->params('name');
    $property_type_id = $req->params('property_type_id'); //1=>flat,2=>villa,3=>independent
    $floor_id = $req->params('floor');
    $bhk_id = $req->params('bhk');
    $property_area = $req->params('property_area');
    $property_rent = $req->params('property_rent');
    $latitude = $req->params('latitude');
    $longitude = $req->params('longitude');
    $house_no = $req->params('house_no');
    $landmark = $req->params('landmark');
    $location = $req->params('location');
    $additional_comment = $req->params('additional_comment');
    $is_property = $req->params('is_property'); //('0'=>residential,'1'=>commercial)
    $token = $req->params('auth_token');
    $timestamp = date('Y-m-d H:i:s');

    // savelogs(serialize($_POST), 'Owner_Add_property');exit();
    $dbCon = getDB();

    if (!empty($txnid) && !empty($owner_charge) && !empty($user_id) && !empty($property_type_id) && !empty($name) && !empty($property_area) && !empty($property_rent) && !empty($location) && !empty($latitude) && !empty($longitude) && !empty($house_no) && !empty($landmark)) {
        if (checkAuthenticationOwner($token) == 1) {
            try {
                $sth = $dbCon->prepare("INSERT INTO tbl_property SET name='$name',owner_id='$user_id',is_property='$is_property', property_type_id='$property_type_id',floor='$floor_id',bhk='$bhk_id',house_no='$house_no',landmark='$landmark',property_area='$property_area',property_rent='$property_rent',location='$location',latitude='$latitude',longitude='$longitude',additional_comment='$additional_comment',is_active='1',created_date='$timestamp'");
                $sth->execute();
                $lastInsertId = $dbCon->lastInsertId();

                /* For upload property multiple images */

                //    echo count($_FILES['property_images']['name']);
                if (count($_FILES['property_images']['name']) > 0) {
                    for ($i = 0; $i < count($_FILES['property_images']['name']); $i++) {
                        //echo $i . '/';
                        if (isset($_FILES['property_images']['name'][$i])) {
                            $property_image_ext_get = explode('.', $_FILES['property_images']['name'][$i]);
                            $property_image_ext = end($property_image_ext_get);
                            if (in_array($property_image_ext, ImageExtentionCheck())) {
                                $file_name = $_FILES["property_images"]["name"][$i];
                                $temp_name = $_FILES["property_images"]["tmp_name"][$i];
                                $tokennumber = date('his') . rand(1111, 9999);
//$user_proof_image = date("d-m-Y") . "-" . time('h-i-s') . "." . $product_image_ext;
                                $property_image = date("d-m-Y") . $tokennumber . "." . $property_image_ext;
                                $target_path = $_SERVER["DOCUMENT_ROOT"] . "/package/upload/property_image/" . $property_image;
                                if ($target_path) {
                                    move_uploaded_file($temp_name, $target_path);
                                    // $image_insert = ",image='$property_image'";
                                    $sth = $dbCon->prepare("INSERT INTO tbl_property_image SET property_id='$lastInsertId', property_image='$property_image',created_date='$timestamp'");
                                    $sth->execute();
                                    $response['error'] = false;
                                }
                            }
                        }
                    }
                }
                /* For insert payment information of woner in tbl_payment table */
                $sth = $dbCon->prepare("INSERT INTO tbl_owner_payment SET property_id='$lastInsertId',payee_id='$user_id',txn_id='$txnid', amount='$owner_charge',payment_status='1',payment_type='0',payment_for='0',created_date='$timestamp'");
                $sth->execute();

                $success_array = array('success' => '1', 'text' => "Property Added Successfully");
                echo $senddata = json_encode($success_array);
                /* End For update farmer image */
            } catch (PDOException $e) {
                $error_array = array('success' => '0', 'text' => $e->getMessage());
                echo $senddata = json_encode($error_array);
            }
        } else {
            $error_array = array('success' => '0', 'text' => 'Token not valid !');
            echo $senddata = json_encode($error_array);
        }
    } else {
        $error_array = array('success' => '0', 'text' => 'All fields Required !');
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Owner_Add_property');
}

//For Owner Update property function
function Owner_Update_property() {
    global $app;
    $req = $app->request(); // Getting parameter with names 
    $property_id = $req->params('property_id');
    $user_id = $req->params('owner_id');
    $property_type_id = $req->params('property_type_id'); //1=>flat,2=>villa,3=>independent
    $floor_id = $req->params('floor');
    $bhk_id = $req->params('bhk');
    $property_area = $req->params('property_area');
    $property_rent = $req->params('property_rent');
    $location = $req->params('location');
    $latitude = $req->params('latitude');
    $longitude = $req->params('longitude');
    $house_no = $req->params('house_no');
    $landmark = $req->params('landmark');
    $additional_comment = $req->params('additional_comment');
    $token = $req->params('auth_token');
    $is_property = $req->params('is_property'); //('0'=>residential,'1'=>commercial)
    $timestamp = date('Y-m-d H:i:s');
    $dbCon = getDB();
    if (!empty($property_id) && !empty($user_id) && $is_property != '' && !empty($property_type_id) && !empty($property_area) && !empty($property_rent) && !empty($location) && !empty($latitude) && !empty($longitude) && !empty($house_no) && !empty($landmark)) {
        if (checkAuthenticationOwner($token) == 1) {
            try {
                $sth = $dbCon->prepare("UPDATE tbl_property SET owner_id='$user_id',is_property='$is_property', property_type_id='$property_type_id',floor='$floor_id',bhk='$bhk_id',property_area='$property_area',property_rent='$property_rent',name='$house_no',house_no='$house_no',landmark='$landmark',location='$location',latitude='$latitude',longitude='$longitude',additional_comment='$additional_comment',is_active='1',created_date='$timestamp' WHERE id = '$property_id' ");
                $sth->execute();

                /* For upload property multiple images */

                //    echo count($_FILES['property_images']['name']);

                if (isset($_FILES['property_images']['name']) && count($_FILES['property_images']['name']) > 0) {
                    $query = "DELETE from tbl_property_image where property_id='$property_id'";
                    $stmt = $dbCon->query($query);
                    for ($i = 0; $i < count($_FILES['property_images']['name']); $i++) {
                        //echo $i . '/';
                        if (isset($_FILES['property_images']['name'][$i])) {
                            $property_image_ext_get = explode('.', $_FILES['property_images']['name'][$i]);
                            $property_image_ext = end($property_image_ext_get);
                            if (in_array($property_image_ext, ImageExtentionCheck())) {
                                $file_name = $_FILES["property_images"]["name"][$i];
                                $temp_name = $_FILES["property_images"]["tmp_name"][$i];
                                $tokennumber = date('his') . rand(1111, 9999);
//$user_proof_image = date("d-m-Y") . "-" . time('h-i-s') . "." . $product_image_ext;
                                $property_image = date("d-m-Y") . $tokennumber . "." . $property_image_ext;
                                $target_path = $_SERVER["DOCUMENT_ROOT"] . "/package/upload/property_image/" . $property_image;
                                if ($target_path) {
                                    move_uploaded_file($temp_name, $target_path);
                                    // $image_insert = ",image='$property_image'";
                                    $sth = $dbCon->prepare("INSERT INTO tbl_property_image SET property_id='$property_id', property_image='$property_image',created_date='$timestamp'");
                                    $sth->execute();
                                    $response['error'] = false;
                                }
                            }
                        }
                    }
                }
                $success_array = array('success' => '1', 'text' => "Property Update Successfully");
                echo $senddata = json_encode($success_array);
                /* End For update farmer image */
            } catch (PDOException $e) {
                $error_array = array('success' => '0', 'text' => $e->getMessage());
                echo $senddata = json_encode($error_array);
            }
        } else {
            $error_array = array('success' => '0', 'text' => 'Token not valid !');
            echo $senddata = json_encode($error_array);
        }
    } else {
        $error_array = array('success' => '0', 'text' => 'All fields Required !');
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Owner_Update_property');
}

//For floor listing function
function Floor_List() {
    global $app;
    $req = $app->request(); // Getting parameter with names 
    try {
        $sql_query = "select id,name FROM tbl_floor ";
        $dbCon = getDB();
        $stmt = $dbCon->query($sql_query);
        $floorlist = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon = null;
        $driver_array = array('success' => '1', 'floor_list' => $floorlist);
        echo $senddata = json_encode($driver_array);
    } catch (PDOException $e) {
        $error_array = array('success' => '0', 'text' => $e->getMessage());
        echo $senddata = json_encode($error_array);
    }

    savelogs($senddata, 'Floor_List');
}

function Bhk_List() {
    global $app;
    $req = $app->request(); // Getting parameter with names 
    try {
        $sql_query = "select id,name FROM tbl_bhk ";
        $dbCon = getDB();
        $stmt = $dbCon->query($sql_query);
        $bhklist = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon = null;
        $driver_array = array('success' => '1', 'bhklist' => $bhklist);
        echo $senddata = json_encode($driver_array);
    } catch (PDOException $e) {
        $error_array = array('success' => '0', 'text' => $e->getMessage());
        echo $senddata = json_encode($error_array);
    }

    savelogs($senddata, 'Bhk_List');
}

// Start Owner Verify OTP function
function Owner_VerifyOTP() { //echo 'fdfd';die;
    global $app;
    $req = $app->request(); // Getting parameter with names
    $user_id = $req->params('user_id');
    $otp = $req->params('otp');
    try {
        $dbCon = getDB();
        $sql = "SELECT * FROM tbl_owner WHERE id='$user_id'";
        $stmt_sql = $dbCon->query($sql);
        $users_info = $stmt_sql->fetch(PDO::FETCH_OBJ);
        if ($users_info->owner_otp == $otp) {
            $sth = $dbCon->prepare("UPDATE tbl_owner SET otp_verify='1' WHERE id='$user_id'");
            $sth->execute();
            $user_array = array('success' => '1', 'text' => 'OTP Verified successfully!', 'user_info' => $users_info);
            echo $senddata = json_encode($user_array);
        } else {
            $user_array = array('success' => '0', 'text' => 'OTP Not Verify!');
            echo $senddata = json_encode($user_array);
        }
    } catch (PDOException $e) {
        $error_array = array('success' => '0', 'text' => $e->getMessage());
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Owner_VerifyOTP');
}

// Start Owner Verify OTP function
function Owner_ResendOTP() { //echo 'fdfd';die;
    global $app;
    $req = $app->request(); // Getting parameter with names
    $user_id = $req->params('user_id');
    try {
        $dbCon = getDB();
        $otp = mt_rand(1000, 9999);
        $sth = $dbCon->prepare("UPDATE tbl_owner SET owner_otp='$otp' WHERE id='$user_id'");
        $sth->execute();
        //For get user email id
        $sql = "SELECT email_id,phone_number FROM tbl_owner WHERE id='$user_id'";
        $stmt_sql = $dbCon->query($sql);
        $users_info = $stmt_sql->fetch(PDO::FETCH_OBJ);
        /* For Send OTP */
        /* $imglogo = DEFAULT_URL . 'images/logo.png';
          $mail_query1 = "SELECT email_for,email_subject,email_description FROM tbl_emails WHERE email_id='6'";
          $stmt_mail1 = $dbCon->query($mail_query1);
          $mailer_info1 = $stmt_mail1->fetch(PDO::FETCH_OBJ);
          $emailval1 = $mailer_info1->email_description;
          $array = array('@name' => ucfirst($owner_info->name), '@otp' => $otp, '@imglogo' => $imglogo);
          foreach ($array AS $key => $value) {
          $emailval1 = str_replace($key, $value, $emailval1);
          }
          //  Sendmail($users_info->email_id, 'Please verify your OTP', $emailval1); */
        $sms = 'Your indiantolet verification code is ' . $otp;
        sendsms($sms, $users_info->phone_number);
        $user_array = array('success' => '1', 'text' => 'OTP Send successfully!');
        echo $senddata = json_encode($user_array);
    } catch (PDOException $e) {
        $error_array = array('success' => '0', 'text' => $e->getMessage());
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Owner_ResendOTP');
}

// Start Owner Verify OTP function
function Owner_UpdatePhoneNumber() { //echo 'fdfd';die;
    global $app;
    $req = $app->request(); // Getting parameter with names
    $user_id = $req->params('user_id');
    $phone_number = $req->params('phone_number');
    try {
        $dbCon = getDB();
        $sth = $dbCon->prepare("UPDATE tbl_owner SET phone_number='$phone_number' WHERE id='$user_id'");
        $sth->execute();

        $user_array = array('success' => '1', 'text' => 'Update phone number successfully!');
        echo $senddata = json_encode($user_array);
    } catch (PDOException $e) {
        $error_array = array('success' => '0', 'text' => $e->getMessage());
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Owner_UpdatePhoneNumber');
}

/* --------------------------End Owner API--------------------------- */

/* * *************************Start Tenant API************************** */

/* Start Tenant Login Api Function */

function Tenant_Login() {
    global $app;
    $req = $app->request(); // Getting parameter with names 
    $facebook_id = $req->params('facebook_id');
    $gmail_id = $req->params('gmail_id');
    $email_id = $req->params('email_id');
    $password = $req->params('password');
    $device_id = $req->params('device_id');
    $fcm_token = $req->params('fcm_token');
    $login_from = $req->params('login_from'); //'0'=>android,'1'=>i-phone 
    $curent_timestamp = date('Y-m-d H:i:s');
    $auth_token = APP_TOKEN;

    if ((!empty($facebook_id) || !empty($gmail_id) || !empty($email_id) || !empty($password)) && $login_from != '') {

        $Setpassword = hash("sha512", $password);
        $dbCon = getDB();
        $check = '';
        $msg = '';
        if ($facebook_id != '') {
            $check = "facebook_id='$facebook_id'";
            //$msg = 'Your facebook id does not exists!';
            $msg = 'Please filled remaining fields!';
        } elseif ($gmail_id != '') {
            $check = "gmail_id='$gmail_id'";
            //  $msg = 'Your gmail id does not exists!';
            $msg = 'Please filled remaining fields!';
        } else {
            $check = "email_id='$email_id' and password='$Setpassword'";
            $msg = "Email Id or Password don't match!";
        }

        $sql_query = "SELECT id,name,email_id,phone_number,fcm_token,device_id,is_active,otp_verify,login_from FROM tbl_user WHERE $check ";

        try {

            $stmt = $dbCon->query($sql_query);
            $tenant_info = $stmt->fetch(PDO::FETCH_OBJ);
            $result = $stmt->rowCount();

            if ($result == '1') {

                if ($tenant_info->is_active == '0') {
                    // Check Owner is Active Or Not
                    $error_array = array('success' => '0', 'text' => "Your Id is Deactivate. Please Contact to Admin!");
                    echo $senddata = json_encode($error_array);
                } elseif ($tenant_info->otp_verify == '0') {
                    $otp = mt_rand(1000, 9999); //For generate otp
                    //$message = 'Your OTP verification code is ' . $otp;
                    //SendSms($message, $user_info->phone_number);
                    /* For update new otp here */
                    $sthUpdate = $dbCon->prepare("UPDATE tbl_user SET user_otp ='$otp' WHERE id = '$tenant_info->id'");
                    $sthUpdate->execute();
                    /* For Send OTP */
                    $imglogo = DEFAULT_URL . 'images/logo.png';
                    $mail_query1 = "SELECT email_for,email_subject,email_description FROM tbl_emails WHERE email_id='6'";
                    $stmt_mail1 = $dbCon->query($mail_query1);
                    $mailer_info1 = $stmt_mail1->fetch(PDO::FETCH_OBJ);
                    $emailval1 = $mailer_info1->email_description;
                    $array = array('@name' => ucfirst($tenant_info->name), '@otp' => $otp, '@imglogo' => $imglogo);
                    foreach ($array AS $key => $value) {
                        $emailval1 = str_replace($key, $value, $emailval1);
                    }
                    //Sendmail($email_id, 'Please verify your OTP', $emailval1);
                    $sms = 'Your indiantolet verification code is ' . $otp;
                    sendsms($sms, $tenant_info->phone_number);
                    $error_array = array('success' => '2', 'text' => "Please verify your OTP first", "userId" => $tenant_info->id, "phone_number" => $tenant_info->phone_number, "otp" => $otp);
                    echo $senddata = json_encode($error_array);
                } else {

                    if (isset($tenant_info->device_id) && $tenant_info->device_id != $device_id && !empty($tenant_info->fcm_token)) {
                        if ($tenant_info->login_from == '1') {
                            // iphone_send_notification_logout('Logout', 'You have login from other device', $user_info->fcm_token);
                        } else {
                            android_send_notification($tenant_info->id, 'You have login from other device', $tenant_info->fcm_token, 'Logout', $type = '', $farmerid = '');
                        }
                    }
                    // Update device_id fcm token
                    $sth = $dbCon->prepare("UPDATE tbl_user SET device_id ='$device_id',login_from='$login_from',fcm_token='$fcm_token',auth_token='$auth_token' WHERE id = '$tenant_info->id'");
                    $sth->execute();
                    // User Info
                    $sql_query = "SELECT * FROM tbl_user WHERE id='$tenant_info->id'";
                    $stmt = $dbCon->query($sql_query);
                    $tenant_info = $stmt->fetch(PDO::FETCH_OBJ);
                    // $lastresult = array('0'=>$users_info);z
                    $success_array = array('success' => '1', 'tenant_info' => $tenant_info, 'text' => 'You have successfully logged In');
                    echo $senddata = json_encode($success_array);
                }
            } else {
                $error_array = array('success' => '3', 'text' => $msg);
                echo $senddata = json_encode($error_array);
            }
        } catch (PDOException $e) {
            $error_array = array('success' => '0', 'text' => $e->getMessage());
            echo $senddata = json_encode($error_array);
        }
    } else {
        $error_array = array('success' => '0', 'text' => 'All fields Required !');
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Tenant_Login');
}

/* End Tenant Login Api Function */

// Start Tenant Registration function
function Tenant_Registration() { //echo 'fdfd';die;
    global $app;
    $req = $app->request(); // Getting parameter with names
    $facebook_id = $req->params('facebook_id');
    $gmail_id = $req->params('gmail_id');
    $name = $req->params('name');
    $address = $req->params('address');
    $phone_number = $req->params('phone_number');
    $email_id = $req->params('email_id');
    $password = $req->params('password');
    $login_from = $req->params('login_from'); //'0'=>android,'1'=>i-phone 
    $device_id = $req->params('device_id');
    $fcm_token = $req->params('fcm_token');
    //$auth_token = $req->params('auth_token'); // For LinkedIn Image
    $curent_timestamp = date('Y-m-d H:i:s');
    /*
      Jump to last read
      History is off. Messages may disappear before people see them. Conversations with no messages may disappear.
      name:Gaurav
      email_id:g.jain@mtoag.com
      phone_number :8561840802
      fcm_token:gbjhfsdgfjsagdjsvdghf
      password:123456
      login_from:0
      address:jaipur
      device_id:1234567890
      gmail_id:
      facebook_id:
     */
    if (!empty($name) && !empty($phone_number) && !empty($email_id) && isset($login_from) && !empty($password)) {

        try {
            $dbCon = getDB();
            $facebook = '';
            $gmail = '';

            // Check for Facebook OR Gmail
            if ($facebook_id != '' || $gmail_id != '') {
                if ($facebook_id != '') {
                    $facebook = " OR facebook_id='$facebook_id' ";
                } else {
                    $gmail = " OR gmail_id='$gmail_id' ";
                }
            }

            $query = "SELECT id,email_id,otp_verify FROM tbl_user WHERE  ( email_id='$email_id' OR phone_number='$phone_number' $facebook $gmail)";
            $stmt = $dbCon->query($query);
            $user_info = $stmt->fetch(PDO::FETCH_OBJ);
            $result = $stmt->rowCount();

            if ($result == '0') {
                $Setpassword = hash("sha512", $password);
                $otp = mt_rand(1000, 9999); //For generate otp
                $sth = $dbCon->prepare("INSERT INTO tbl_user SET facebook_id='$facebook_id',gmail_id='$gmail_id', name='$name',user_otp='$otp',phone_number='$phone_number',address='$address',email_id='$email_id',password='$Setpassword',login_from='$login_from',device_id='$device_id',fcm_token='$fcm_token',auth_token='" . APP_TOKEN . "',is_active='1',created_date='$curent_timestamp'");
                $sth->execute();
                $lastInsertId = $dbCon->lastInsertId();

                $sql = "SELECT * FROM tbl_user WHERE id='$lastInsertId'";
                $stmt_sql = $dbCon->query($sql);
                $users_info = $stmt_sql->fetch(PDO::FETCH_OBJ);

                //Tenant Send Registration Mail
                /* $imglogo = DEFAULT_URL . 'images/logo.png';
                  $mail_query = "SELECT email_for,email_subject,email_description FROM tbl_emails WHERE email_id='4'";
                  $stmt_mail = $dbCon->query($mail_query);
                  $mailer_info = $stmt_mail->fetch(PDO::FETCH_OBJ);
                  $emailval = $mailer_info->email_description;
                  $array = array('@name' => ucfirst($name), '@email' => $email_id, '@password' => $password, '@imglogo' => $imglogo);
                  foreach ($array AS $key => $value) {
                  $emailval = str_replace($key, $value, $emailval);
                  }
                  Sendmail($email_id, $mailer_info->email_subject, $emailval);

                  $imglogo = DEFAULT_URL . 'images/logo.png';
                  $mail_query1 = "SELECT email_for,email_subject,email_description FROM tbl_emails WHERE email_id='6'";
                  $stmt_mail1 = $dbCon->query($mail_query1);
                  $mailer_info1 = $stmt_mail1->fetch(PDO::FETCH_OBJ);
                  $emailval1 = $mailer_info1->email_description;
                  $array = array('@name' => ucfirst($name), '@otp' => $otp, '@imglogo' => $imglogo);
                  foreach ($array AS $key => $value) {
                  $emailval1 = str_replace($key, $value, $emailval1);
                  }
                  //Sendmail($email_id, 'Please verify your OTP', $emailval1);
                 */
                $sms = 'Your indiantolet verification code is ' . $otp;
                sendsms($sms, $users_info->phone_number);
                $success_array = array('success' => '1', 'text' => 'Tenant Registered Successfully with INDIAN TO-LET', 'Tenant_info' => $users_info);
                echo $senddata = json_encode($success_array);
            } else {
                if ($user_info->otp_verify == '0') { //OTP not verified
                    $user_array = array('success' => '2', 'text' => 'Tenant already registered.Please verify your OTP!', 'userId' => $user_info->id);
                } else { //OTP  verified
                    $user_array = array('success' => '0', 'text' => 'Tenant already registered, please login.');
                }
                echo $senddata = json_encode($user_array);
            }
        } catch (PDOException $e) {
            $error_array = array('success' => '0', 'text' => $e->getMessage());
            echo $senddata = json_encode($error_array);
        }
    } else {
        $error_array = array('success' => '0', 'text' => 'All fields are Required !');
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Tenant_Registration');
}

// Start Tenant Verify OTP function
function Tenant_VerifyOTP() { //echo 'fdfd';die;
    global $app;
    $req = $app->request(); // Getting parameter with names
    $user_id = $req->params('user_id');
    $otp = $req->params('otp');
    try {
        $dbCon = getDB();
        $sql = "SELECT * FROM tbl_user WHERE id='$user_id'";
        $stmt_sql = $dbCon->query($sql);
        $users_info = $stmt_sql->fetch(PDO::FETCH_OBJ);
        if ($users_info->user_otp == $otp) {
            $sth = $dbCon->prepare("UPDATE tbl_user SET otp_verify='1' WHERE id='$user_id'");
            $sth->execute();
            $user_array = array('success' => '1', 'text' => 'OTP Verified successfully!', 'user_info' => $users_info);
            echo $senddata = json_encode($user_array);
        } else {
            $user_array = array('success' => '0', 'text' => 'OTP Not Verify!');
            echo $senddata = json_encode($user_array);
        }
    } catch (PDOException $e) {
        $error_array = array('success' => '0', 'text' => $e->getMessage());
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Tenant_VerifyOTP');
}

// Start Tenant Verify OTP function
function Tenant_ResendOTP() { //echo 'fdfd';die;
    global $app;
    $req = $app->request(); // Getting parameter with names
    $user_id = $req->params('user_id');
    try {
        $dbCon = getDB();
        $otp = mt_rand(1000, 9999);
        $sth = $dbCon->prepare("UPDATE tbl_user SET user_otp='$otp' WHERE id='$user_id'");
        $sth->execute();
        //For get tenant email id
        $sql = "SELECT email_id,phone_number FROM tbl_user WHERE id='$user_id'";
        $stmt_sql = $dbCon->query($sql);
        $users_info = $stmt_sql->fetch(PDO::FETCH_OBJ);
        /* For Send OTP */
        /* $imglogo = DEFAULT_URL . 'images/logo.png';
          $mail_query1 = "SELECT email_for,email_subject,email_description FROM tbl_emails WHERE email_id='6'";
          $stmt_mail1 = $dbCon->query($mail_query1);
          $mailer_info1 = $stmt_mail1->fetch(PDO::FETCH_OBJ);
          $emailval1 = $mailer_info1->email_description;
          $array = array('@name' => ucfirst($name), '@otp' => $otp, '@imglogo' => $imglogo);
          foreach ($array AS $key => $value) {
          $emailval1 = str_replace($key, $value, $emailval1);
          } */
        // Sendmail($users_info->email_id, 'Please verify your OTP', $emailval1);
        $sms = 'Your indiantolet verification code is ' . $otp;
        sendsms($sms, $users_info->phone_number);
        //OTP Send code Here
        $user_array = array('success' => '1', 'text' => 'OTP Send successfully!');
        echo $senddata = json_encode($user_array);
    } catch (PDOException $e) {
        $error_array = array('success' => '0', 'text' => $e->getMessage());
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Tenant_ResendOTP');
}

// Start Tenant Verify OTP function
function Tenant_UpdatePhoneNumber() { //echo 'fdfd';die;
    global $app;
    $req = $app->request(); // Getting parameter with names
    $user_id = $req->params('user_id');
    $phone_number = $req->params('phone_number');
    try {
        $dbCon = getDB();
        $sth = $dbCon->prepare("UPDATE tbl_user SET phone_number='$phone_number' WHERE id='$user_id'");
        $sth->execute();

        $user_array = array('success' => '1', 'text' => 'Update phone number successfully!');
        echo $senddata = json_encode($user_array);
    } catch (PDOException $e) {
        $error_array = array('success' => '0', 'text' => $e->getMessage());
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Tenant_UpdatePhoneNumber');
}

// Start Owner Info Update Function
function Tenant_Info_Update() {

    global $app;
    $req = $app->request(); // Getting parameter with names
    $user_id = $req->params('user_id');
    $email_id = $req->params('email_id');
    $name = $req->params('name');
    $phone_number = $req->params('phone_number');
    $address = $req->params('address');
    $token = $req->params('auth_token');
    $current_timestamp = date('Y-m-d H:i:s');

    if (!empty($user_id) && !empty($email_id) && !empty($name) && !empty($phone_number) && !empty($address) && !empty($token)) {

        if (checkAuthenticationUser($token) == 1) {
            $dbCon = getDB();
            $sql_check = "SELECT email_id FROM tbl_user WHERE email_id='$email_id' AND id!='$user_id'";
            $stmt_check = $dbCon->query($sql_check);
            $result_check = $stmt_check->rowCount();
            try {

                if ($result_check == 0) {
                    $sth = $dbCon->prepare("UPDATE tbl_user SET name='$name',email_id='$email_id',phone_number='$phone_number',address='$address',modification_date='$current_timestamp' WHERE id= '$user_id'");
                    $sth->execute();
                    $query = "SELECT id,name,email_id,phone_number,address FROM tbl_user WHERE id='$user_id'";
                    $stmt = $dbCon->query($query);
                    $user_info = $stmt->fetch(PDO::FETCH_OBJ);

                    $success_array = array('success' => '1', 'user_info' => $user_info, 'text' => 'User Info Updated Successfully');
                    echo $senddata = json_encode($success_array);
                } else {
                    $error_array = array('success' => '0', 'text' => 'Email ID Already Exists!');
                    echo $senddata = json_encode($error_array);
                }
            } catch (PDOException $e) {
                $error_array = array('success' => '0', 'text' => $e->getMessage());
                echo $senddata = json_encode($error_array);
            }
        } else {
            $error_array = array('success' => '0', 'text' => 'Token not valid !');
            echo $senddata = json_encode($error_array);
        }
    } else {
        $error_array = array('success' => '0', 'text' => 'All fields Required !');
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Tenant_Info_Update');
}

// Start Owner Forgot Password Function
function Tenant_ForgotPassword() {
    global $app;
    $req = $app->request(); // Getting parameter with names
    $obj_mail = new PHPMailerModel();
    $email_id = $req->params('email_id'); // get email id 
    $timestamp = date('Y-m-d H:i:s');
    if (!empty($email_id)) {
        try {
            $dbCon = getDB();
            $sql_query = "SELECT id,email_id,name FROM tbl_user WHERE email_id='$email_id' AND is_active='1'";
            $stmt = $dbCon->query($sql_query);
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            $result = $stmt->rowCount();
            if ($result > 0) {

                /*
                 * $url = MAIN_URL . 'india_tolet/user/forgotpassword/id/' . highlyencrpt($user[0]->id, '*');
                  $imglogo = DEFAULT_URL . 'images/logo.png';
                  //$update_pass = $dbCon->prepare("UPDATE tbl_user SET password = '$password' WHERE id = '".$user[0]->id."'");
                  //$update_pass->execute();

                  $sql_query = "SELECT email_subject,email_description FROM tbl_emails WHERE email_id='3'";
                  $stmt = $dbCon->query($sql_query);
                  $mailer_info = $stmt->fetch(PDO::FETCH_OBJ);
                  $emailval = $mailer_info->email_description;
                  $subject = $mailer_info->email_subject;
                  $array = array('@' => '', 'name' => ucfirst($user[0]->name), 'imglogo' => $imglogo, 'passlink' => $url);

                  foreach ($array AS $key => $value) {
                  $emailval = str_replace($key, $value, $emailval);
                  }
                  //  echo $emailval;die;
                  Sendmail($email_id, $subject, $emailval); */

                // End send mail code
                 $new_password=randomPassword();
                $password = hash("sha512", $new_password);
                
                $update_pass = $dbCon->prepare("UPDATE tbl_user SET password = '$password' WHERE id = '".$user->id."'");
                $update_pass->execute();
                 $imglogo = DEFAULT_URL . 'images/logo.png';
                $sql_query = "SELECT email_subject,email_description FROM tbl_emails WHERE email_id='5'";
                $stmt = $dbCon->query($sql_query);
                $mailer_info = $stmt->fetch(PDO::FETCH_OBJ);
                $emailval = $mailer_info->email_description;
                $subject = $mailer_info->email_subject;
                $array = array('@' => '', 'name' => ucfirst($user->name), 'imglogo' => $imglogo, 'newpassword' => $new_password);

                foreach ($array AS $key => $value) {
                    $emailval = str_replace($key, $value, $emailval);
                }
                //echo $emailval;die;
                Sendmail($email_id, $subject, $emailval);
                
                $dbCon = null;
                $user = array('success' => '1', 'text' => 'Your New Password is Sent on your Email. Please Check!');
                echo $senddata = json_encode($user);
            } else {
                $error_array = array('success' => '0', 'text' => "Email doesn't Exists");
                echo $senddata = json_encode($error_array);
            }
        } catch (PDOException $e) {
            $error_array = array('success' => '0', 'text' => $e->getMessage());
            echo $senddata = json_encode($error_array);
        }
    } else {
        $error_array = array('success' => '0', 'text' => 'All Field Required');
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Tenant_ForgotPassword');
}

/* END Owner  Forgot Passwordd FUNCTIONS POST */

/* Start Owner Change Password Function */

function Tenant_Changepassword() {
    global $app;
    $req = $app->request(); // Getting parameter with names 
    $user_id = $req->params('user_id');
    $old_password = hash('sha512', $req->params('old_password'));
    $new_passoword_f = $req->params('new_password');
    $new_password = hash('sha512', $new_passoword_f);
    $confirm_password = hash('sha512', $req->params('confirm_password'));
    $token = $req->params('auth_token');
    $timestamp = date('Y-m-d H:i:s');

    if (!empty($user_id)) { // check driver id
        if (checkAuthenticationUser($token) == 1) {

            if ($new_password == $confirm_password) { // Check new password & confirm password matached or not
                $sql_query = "select id,name,email_id,password,phone_number,address FROM tbl_user WHERE id='$user_id' AND is_active='1'";
                try {
                    $dbCon = getDB();
                    $stmt = $dbCon->query($sql_query);
                    $result = $stmt->rowCount();
                    // Check num rows 
                    if ($result > 0) {
                        $user = $stmt->fetch(PDO::FETCH_OBJ);

                        // Check driver old password 
                        if ($user->password == $old_password) {

                            // $tokenupdated = UpdateRiderToken($req->params('mobile_token')); // UPdate user token   
                            // Update driver password
                            $sth = $dbCon->prepare("UPDATE tbl_user SET password = '$new_password',modification_date='$timestamp' WHERE id = $user_id");
                            $sth->execute();

                            // Send email code   
                            /*
                              $imglogo = DEFAULT_URL . 'images/logo.png'; // get logo url
                              $sql_query = "select email_for,email_subject,email_description FROM tbl_emails WHERE email_id='3' and is_active='1'";
                              $stmt = $dbCon->query($sql_query);
                              $mailer_info = $stmt->fetch(PDO::FETCH_OBJ);

                              $emailval = $mailer_info->email_description;
                              $subject = $mailer_info->email_subject;

                              $array = array('@' => '', 'name' => ucfirst($user->name), 'imglogo' => $imglogo, 'email' => $user->email_id, 'password' => $new_passoword_f);
                              foreach ($array AS $key => $value) {
                              $emailval = str_replace($key, $value, $emailval);
                              }

                              Sendmail($user->email_id, $subject, $emailval); // send code function
                             * 
                             */
                            // End email send code                          
                            $dbCon = null;
                            $driver_array = array('success' => '1', 'text' => 'Password successfully updated');
                            echo $senddata = json_encode($driver_array);
                        } else {
                            $error_array = array('success' => '2', 'text' => 'Old password doesn\'t match!');
                            echo $senddata = json_encode($error_array);
                        }
                    } else {
                        $error_array = array('success' => '3', 'text' => 'Owner doesn\'t exists!');
                        echo $senddata = json_encode($error_array);
                    }
                } catch (PDOException $e) {
                    $error_array = array('success' => '7', 'text' => $e->getMessage());
                    echo $senddata = json_encode($error_array);
                }
            } else {
                $error_array = array('success' => '4', 'text' => 'Confirm password doesn\'t match');
                echo $senddata = json_encode($error_array);
            }
        } else {
            $error_array = array('success' => '5', 'text' => 'Token not valid !');
            echo $senddata = json_encode($error_array);
        }
    } else {
        $error_array = array('success' => '8', 'text' => 'All fields Required !');
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Tenant_Changepassword');
}

/* Start Owner property listing Function */

function Tenant_Property_List() {
    global $app;
    $req = $app->request(); // Getting parameter with names 

    $latitude = $req->params('latitude');
    $longitude = $req->params('longitude');
    $token = $req->params('auth_token');
    $price = $req->params('price');
    $property_area = $req->params('property_area');
    $distance = $req->params('distance');
    $tenant_id = $req->params('tenant_id');
    $timestamp = date('Y-m-d H:i:s');
    $dbCon = getDB();
    /* For get admin email id */
    $sql_check = "SELECT admin_email,owner_charge,tenant_charge from tbl_admin WHERE admin_id='1'";
    $stmt_check = $dbCon->query($sql_check);
    $admin_info = $stmt_check->fetch(PDO::FETCH_OBJ);
    if (!empty($latitude) && !empty($longitude) && !empty($tenant_id)) { // check driver id
        if (checkAuthenticationUser($token) == 1) {

            try {

                $setDistance = 6371; //if get distance result in km then set 6371 and if get distance result in mile then set 3959 
                $user_distance = 20; //distance in km
                /* For filter property */
                $condition = "";
                $con = '';
                if ($price != '' || $property_area != '' || $distance != '') {
                    if ($price != '') {
                        $condition.="  property_rent<='$price' or ";
                    }
                    if ($property_area != '') {
                        $condition.=" property_area<='$property_area' or ";
                    }

                    if ($distance != '') {
                        $user_distance = $distance;
                    }
                }
                if ($condition == '') {
                    $con = "  WHERE is_active='1'  HAVING distance < $user_distance  ORDER BY distance asc";
                } else {
                    $condition = rtrim($condition, " or ");
                    $con = "  WHERE is_active='1' and  $condition HAVING distance < $user_distance  ORDER BY distance asc";
                }

                $query = "SELECT *,ROUND(( $setDistance * acos( cos( radians( $latitude ) ) * cos( radians(latitude) ) * cos( radians(longitude ) - "
                        . "radians( $longitude ) ) + sin( radians( $latitude) ) * sin( radians(latitude ) ) ) ),2) AS distance  "
                        . "FROM tbl_property $con";



                $stmt = $dbCon->query($query);
                $result = $stmt->rowCount();

                if ($result > 0) {
                    // Check num rows 
                    $propertylist = $stmt->fetchAll(PDO::FETCH_OBJ);

                    foreach ($propertylist as $propertylistVal) {
                        $ImageQuery = "select property_image FROM tbl_property_image WHERE property_id='$propertylistVal->id' ";
                        $stmt_images = $dbCon->query($ImageQuery);
                        $Images = $stmt_images->fetchAll(PDO::FETCH_OBJ);
                        /* For create a propert name */
                        if ($propertylistVal->property_type_id == 1) { //for flat
                            $name = $propertylistVal->bhk . ' flat ';

                            if (isset($propertylistVal->floor) && !empty($propertylistVal->floor)) {
                                $name .= rtrim($propertylistVal->floor, 'floor') . ' floor';
                            }
                        } elseif ($propertylistVal->property_type_id == 2) { //for villa
                            $name = "Villa";
                        } elseif ($propertylistVal->property_type_id == 3) { //For independent
                            $name = "Independent";
                        }
                        $PropertyArray[] = array(
                            'id' => $propertylistVal->id,
                            'property_type_id' => $propertylistVal->property_type_id,
                            'owner_id' => $propertylistVal->owner_id,
                            //'name' => $propertylistVal->name,
                            'name' => $name,
                            'floor' => $propertylistVal->floor,
                            'bhk' => $propertylistVal->bhk,
                            'no_of_room' => $propertylistVal->bhk,
                            'property_area' => $propertylistVal->property_area,
                            'location' => $propertylistVal->location,
                            'latitude' => $propertylistVal->latitude,
                            'longitude' => $propertylistVal->longitude,
                            'property_rent' => $propertylistVal->property_rent,
                            'house_no' => $propertylistVal->house_no,
                            'landmark' => $propertylistVal->landmark,
                            'additional_comment' => $propertylistVal->additional_comment,
                            'images' => $Images,
                            'is_property' => $propertylistVal->is_property,
                        );
                    }
                    /* For check tenant already payment or not for this property */
                    $TenantQuery = "select tenant_id FROM tbl_tenant_payment WHERE tenant_id='$tenant_id' ";
                    $stmt_Tenant = $dbCon->query($TenantQuery);
                    $result_tenant = $stmt_Tenant->rowCount();
                    $payment_status = 0;
                    if ($result_tenant > 0) {
                        $payment_status = 1;
                    }

                    $dbCon = null;
                    $driver_array = array('success' => '1', 'property_list' => $PropertyArray, 'ImageUrl' => IMAGE_UPLOAD_URL . '/property_image/', 'payment_status' => $payment_status, 'contact_email' => $admin_info->admin_email, 'owner_charge' => $admin_info->owner_charge, 'tenant_charge' => $admin_info->tenant_charge);
                    echo $senddata = json_encode($driver_array);
                } else {
                    $driver_array = array('success' => '0', 'text' => '', 'owner_charge' => $admin_info->owner_charge, 'tenant_charge' => $admin_info->tenant_charge);
                    echo $senddata = json_encode($driver_array);
                }
            } catch (PDOException $e) {
                $error_array = array('success' => '0', 'text' => $e->getMessage());
                echo $senddata = json_encode($error_array);
            }
        } else {
            $error_array = array('success' => '0', 'text' => 'Token not valid !', 'owner_charge' => $admin_info->owner_charge, 'tenant_charge' => $admin_info->tenant_charge);
            echo $senddata = json_encode($error_array);
        }
    } else {
        $error_array = array('success' => '0', 'text' => 'All fields Required !', 'owner_charge' => $admin_info->owner_charge, 'tenant_charge' => $admin_info->tenant_charge);
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Tenant_Property_List');
}

//For update tenetan location
function Update_Tenant_Location() {
    global $app;
    $req = $app->request(); // Getting parameter with names 
    $user_id = $req->params('user_id');
    $latitude = $req->params('latitude');
    $longitude = $req->params('longitude');
    $address = $req->params('address');
    $dbCon = getDB();
    if (!empty($latitude) && !empty($longitude) && !empty($address)) {
        $sth = $dbCon->prepare("UPDATE tbl_user SET latitude='$latitude',longitude='$longitude',address='$address' WHERE id= '$user_id'");
        $sth->execute();
        $driver_array = array('success' => '1', 'text' => "Location Update Successfully!");
        echo $senddata = json_encode($driver_array);
    } else {
        $error_array = array('success' => '0', 'text' => 'All fields Required !');
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Update_Tenant_Location');
}

//For update tenetan location
function Tenant_Payment() {
    global $app;
    $req = $app->request(); // Getting parameter with names 
    $user_id = $req->params('user_id');
    $txnid = $req->params('txnid');
    $tenant_charge = $req->params('tenant_charge');
    $curent_timestamp = date("Y-m-d H:i:s");
    $dbCon = getDB();
    if (!empty($user_id) && !empty($txnid) && !empty($tenant_charge)) {
        try {
            $sth = $dbCon->prepare("INSERT INTO tbl_tenant_payment SET tenant_id='$user_id',txn_id='$txnid', amount='$tenant_charge',created_date='$curent_timestamp'");
            $sth->execute();
            $driver_array = array('success' => '1', 'text' => "Tenant Payment Successfully!");
            echo $senddata = json_encode($driver_array);
        } catch (PDOException $e) {
            $error_array = array('success' => '0', 'text' => $e->getMessage());
            echo $senddata = json_encode($error_array);
        }
    } else {
        $error_array = array('success' => '0', 'text' => 'All fields Required !');
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'Tenant_Payment');
}

function encode($key) {
    return base64_encode($key);
}

function round_to_2dp($number) {

    return number_format((float) $number, 2, '.', '');
}

function ImageExtentionCheck() {
    return array("jpg", "mp4", "mp3", "mov", "png", "gif", "bmp", "jpeg", "PNG", "JPG", "JPEG", "GIF", "BMP");
}

function Owner_iphone_send_notification($id, $msg, $fcm, $title, $type = '') {
    if (isset($fcm) && !empty($fcm)) {


        $root_path = $_SERVER["DOCUMENT_ROOT"] . "/freshpro/api/";
// require_once($root_path."webroot\cron\library\config.php");
        require_once($root_path . "ApnsPHP/Autoload.php");
        global $obj_basic;
        try {
            $passphrase = '123456';
            $ctx = stream_context_create();
//stream_context_set_option($ctx, 'ssl', 'local_cert', 'MCFfinalDist.pem'); //Live
            stream_context_set_option($ctx, 'ssl', 'local_cert', 'FreshproFarmer.pem'); // Development
            stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
// Open a connection to the APNS server
            $fp = stream_socket_client(
                    'ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

            if (!$fp)
                exit("Failed to connect: $err $errstr" . PHP_EOL);
//echo '<br>' . date("Y-m-d H:i:s") . ' Connected to APNS' . PHP_EOL;


            if (isset($fcm) && !empty($fcm)) {

                $deviceToken = $fcm; // Get FCM totken no:
                $name = 'live';
//$message = $name . " : ";
                $totalUnread = 1;
//$message .= "Request of new ride.";
// Create the payload body

                if ($title == 'Logout') {
                    $status = "10";
                } elseif ($title == 'Rating') {
                    $status = '1';
                }
                $body['aps'] = array(
                    'alert' => $msg,
                    'badge' => $status,
                    'sound' => 'notify.caf', // notification sound file path
                    'job_id' => $id,
                    'type' => $type
                );
//                 print_r($body);
// Encode the payload as JSON
                $payload = $senddata = json_encode($body);
// Build the binary notification
                $msg = chr(0) . @pack('n', 32) . @pack('H*', $deviceToken) . @pack('n', strlen($payload)) . $payload;
// Send it to the server
                return $result = fwrite($fp, $msg, strlen($msg));
// print_r($result);
// Close the connection to the server
                fclose($fp);
//echo '<br>' . date("Y-m-d H:i:s") . CONNECTION_CLOSED_TO_APNS . PHP_EOL;
//$return_array = array('success' => '1');
//echo $senddata=json_encode($return_array);
            } else {
                $return_array = array('success' => '3', 'text' => 'User FCM Token Empty');
                return $senddata = json_encode($return_array);
            }
        } catch (PDOException $e) {
            $error_array = array('success' => '0', 'text' => $e->getMessage());
            return $senddata = json_encode($error_array);
        }
    } else {
        $error_array = array('success' => '2', 'text' => 'User Detail Required!');
        return $senddata = json_encode($error_array);
    }
}

function android_send_notification($id, $msg, $gcm, $title, $type = '', $farmerid = '') {
// Notification code
    include_once("firebase.php");
    include_once("push.php");
    $firebase = new Firebase();
    $push = new Push();
// optional payload
    $payload = array();
    $payload['team'] = 'India';
    $payload['score'] = '5.6';
    $dbCon = getDB();

// print_r($driverGsmTokenInfo);
    if (isset($gcm) && !empty($gcm)) {

// notification title  
        $message = $msg;
        // $status = 'GPS';
        if ($title == 'Logout') {
            $status = "10";
        }



        $job_detail = '';
        //   $job_detail = array('0' => $job_detail);
//         elseif ($title == 'Rating') {
//            $status = '1';
//        }
// push type - single user / topic
// whether to include to image or not 
        $push->setOrderID($id);
        $push->setTitle($title);
        $push->setMessage($message);
        $push->setstatus($status);
        $push->setImage($type);
        $push->setIsBackground(FALSE);
        $push->setPayload($payload);
        $push->job_detail($job_detail);

        $json = '';
        $response = '';
        $json = $push->getPush();
        //   $response = $firebase->send($gcm, $json);
        return $response = $firebase->send($gcm, $json);
        //  print_r($response);
    } else {
//        $return_array = array('success' => '1', 'text' => "DRIVER GSM TOKEN EMPTY");
//        echo $senddata=json_encode($return_array);
    }
}

function savelogs($senddata = '', $apiname = '', $notificationresponse = '', $request_from = '') {
    if (is_numeric($request_from)) {
        if (isset($request_from) && $request_from == '1') {
            $request_from = 'Android';
        } else {
            $request_from = 'Iphone';
        }
    }
    $dbCon = getDB();

//Get each time request perameter for all api to save in log
    $apiposteddata = convertstring($_POST);

    $apiposteddata = str_replace("'", "", $apiposteddata);
    $senddata = str_replace("'", "", $senddata);
    $notificationresponse = str_replace("'", "", $notificationresponse);
    $currentdate = date("Y-m-d H:i:s");
    $insertLog = $dbCon->prepare("INSERT INTO tbl_log_before_send SET "
            . "api_to_file= '$apiposteddata'"
            . ",file_to_api= '$senddata'"
            . ",notification_response= '$notificationresponse'"
            . ",api_name= '$apiname'"
            . ",request_from='$request_from'"
            . ",date_time='$currentdate'"
    );
    $insertLog->execute();
}

function convertstring($request) {
    $data = '';
    foreach ($request as $key => $value) {
        $data.=$key . "=>" . $value . ',';
    }
    return $data;
}

//All testing Functions


function Test_Android_Notification() {
    $response = sendsms('Your indiantolet verification code is 6486', '9887506812');
    print_r($response);

    //echo android_send_notification('1', 'Test Message from developer.', 'f2dWE6DNj_s:APA91bGx2D5S2CGR_e5vGxLsvFog57lVEd1Ids1hO8ibI6oY-e5wEoWCwhnkXRLRoeOJBCgFrikvb6nx-toKjBJQSxREl-1FOaaaKKQ1kA-dfSjT1I-irARtTAOjs3Sjy3S5ZNKX0dDF', 'Logout');
}

function Test_Ios_Notification() {
    echo Owner_iphone_send_notification('1', 'Test Message from developer.', '25BE788ACFECA33B32D791E2D0AA92D281C07584C4DD56C712324DE57F84AEDD', 'Logout');
}

//Farmer Logout
function logout() {
    global $app;
    $req = $app->request(); // Getting parameter with names    
    $farmer_id = $req->params('farmer_id');
    if (checkAuthenticationFarmer($req->params('auth_token')) == 1) {
        if (isset($farmer_id) && !empty($farmer_id)) { // check driver id 
            try {
                $dbCon = getDB();
                $sth = $dbCon->prepare("UPDATE tbl_farmer SET fcm_token='',device_id='' WHERE id='$farmer_id'");
                $sth->execute();
                $dbCon = null;
                $return_array = array('success' => '1', 'text' => 'Farmer Logout Successfully');
                echo $returndataapi = json_encode($return_array);
            } catch (PDOException $e) {
                $error_array = array('success' => '7', 'text' => $e->getMessage());
                echo $returndataapi = json_encode($error_array);
            }
        } else {
            $error_array = array('success' => '8', 'text' => 'All Fields Required');
            echo $returndataapi = json_encode($error_array);
        }
    } else {
        $error_array = array('success' => '5', 'text' => 'Token not valid !');
        echo $senddata = json_encode($error_array);
    }
    savelogs($senddata, 'logout');
}
?> 
