<?php

/*
 * Coder : Ankit Sharma
 * Date  : 16-May-2K17
 */
ob_start();
extract($_POST);
extract($_GET);
$currentTimestamp = getCurrentTimestamp();
$obj_admin = new adminModel();
$obj_marketing_department = new marketing_departmentModel();
$obj_depot = new depotModel();
$obj_assistant_manager = new assistant_managerModel();
$obj_salesman = new salesmanModel();
$obj_supplier = new supplierModel();

$obj_mail = new PHPMailerModel();

if (isset($SubmitAdmin) && $SubmitAdmin != "") {
    
    if (isset($action) && $action == 'LoginAdmin') {
        //print_r($_POST);die;
        //Get Form Post Data
        //$bind = array(':name' => $obj_admin->clean($user_name), ':password' => hash("sha512", $password));
        //Ckeck In admin table User name 
        $password = hash("sha512", $password);
  
        //$result = $obj_admin->select("admin_username = '$user_name' and admin_pass= '$password'");
        
        //Check user Login 
        $query = ("SELECT admin_id as id,username,email,name,role_id FROM tbl_admin WHERE username = '$user_name' AND password = '$password'");
        //echo $query;die;
        $result = get_data($query);
        
        
        //echo '<pre>';print_r($result);die;
        if (count($result)=='1'){
        // matching login ok
            @session_start();
            session_regenerate_id();
            if (isset($_SESSION['BBT_LoggedIn'])) {
                header('location:' . ADMIN_URL . '/home.php');
                exit;
            }
           
            foreach ($result as $row) { //echo '<pre>';print_r($row);die;
                $_SESSION['admin_adminIn'] = true;
                $_SESSION['admin_adminId'] = $row->id;
                $_SESSION['admin_adminName'] = $row->name;
                //$_SESSION['type'] = $row->role_id;
            }
              
            header('location:' . ADMIN_URL . '/home.php');
            exit;
        } else {
            $obj_admin->disconnect();
            $errorMsg = 'Username and Password is wrong';
            return false;
        }
    } elseif (isset($action) && $action == 'ForgetPass') {      
        $email = trim($email);
        if ($email != "") {

            //$bind = array(':email' => $email);
            //$Dataadmin = $obj_admin->select("email = :email", $bind);
            //print_r($_POST);die;
            $query = (" SELECT admin_id as id,email,name,role_id FROM tbl_admin WHERE email = '$email'");
            $Dataadmin = get_data($query);
            //echo '<pre>';print_r($Dataadmin);die;
            if (!($Dataadmin)) {
                $errorMsg = 'NO RECORD';
            } else {

                foreach ($Dataadmin as $admin) {
                    $currenttime = getRequiredDateFormat9($currentTimestamp);
                    $tokan = $currentTimestamp . "+" . $admin->id; //." / ".$admin->role_id;
                    
                    $encrypt = $obj_admin->encode5t($tokan);
                    $encrypt = $obj_admin->encode5t($encrypt); //==QTU1keOR0a59ERnBjTTNHe
                    
                      $passlink = ADMIN_URL . "/login.php?tokan=" . $encrypt;

                      $obj_mail->IsSMTP();  // telling the class to use SMTP
                      $obj_mail->Mailer = "mail";
                     $obj_mail->Host = "192.168.2.162"; // SMTP server
                      $obj_mail->SMTPAuth = true;
                      $obj_mail->CharSet="utf-8";
                      //$obj_mail->AddReplyTo(ADMIN_NO_REPLY, 'Hello');
                      $obj_mail->AddAddress($email);
                       $obj_mail->Username = "noreply@go4php.com";
                      $obj_mail->Password = "noreply@123";
                      $obj_mail->From = ADMIN_NO_REPLY;
                      $obj_mail->FromName = 'Nippon Paints';
                      $obj_mail->WordWrap = 50;
                      $obj_mail->IsHTML(true);
                      $obj_mail->Subject = 'Reset Password';
                      $obj_mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                      $imglogo = DEFAULT_URL . "/images/logo.png";
                      $emaildata = '<div style="margin:0px; padding:0px; border:1px solid #dfdfdf; width:692px;">
<div style="border-top:5px solid #ff8433; width:692px; ">
<div style="margin:0px auto 10px; padding:0px; width:636px; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
<div style="margin:10px; padding:0px; width:100%; border-bottom:double #CCC;"><img src="@imglogo" style="padding-bottom:15px" /></div>

<table cellpadding="5" style="width:95%">
	<tbody>
		<tr>
			<td colspan="2">Dear @name </td>
		</tr><!--
		<tr>
			<td colspan="2">Your username is: @email</td>
		</tr>-->
		<tr>
			<td colspan="2">To reset your password, please click on this link or paste it into your web browser.</td>
		</tr>
		<tr>
			<td colspan="2"><a href="@passlink">@passlink</a></td>
		</tr>
	</tbody>
</table>

<p><span style="color:#00b300; font-size:16px">Best regards,<br />
<span style="color:#ff8433; font-size:20px">Nippon Paints</span><br />
 </span></span></p>
</div>

<div style="margin:0px; padding:0px; background:#ff8433; color:#fff; text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; height:40px; line-height:40px;">&copy; 2017 Nippon Paints All Rights Reserved.</div>
</div>
</div>
';
                      $emailval = $emaildata;
                      $array = array('@' => '', 'name' => $admin->name, 'imglogo' => $imglogo, 'email' => $admin->email, 'exptime' => '', 'passlink' => $passlink);

                      foreach ($array AS $key => $value) {
                      $emailval = str_replace($key, $value, $emailval);
                      }
                      $tokan = "";
                      
                      
                      $obj_mail->Body = $emailval;
                      //print_r($obj_mail->Body);die;
                      if (!$obj_mail->Send()) {
                      $successMsg = 'Mail Not Sent' . " " . $obj_mail->ErrorInfo;
                      } else {
                      $successMsg = ADMIN_MAIL_SEND_RESET_PASSWORD_SUCCESSFULLY;
                      } 
                }
            }
        } else {
            $errorMsg = 'ERROR';
        }
    } elseif (isset($action) && $action == 'ChangePass') {
        
        $new_pass = trim($admin_pass);
        $re_pass = trim($re_pass);
        if ($new_pass == $re_pass) {

            if (isset($adminId) && !empty($adminId)) {
                 $adminId = explode(" / ",$adminId);
                 //print_r($adminId);die;
                //echo $adminId[0]."Test".$adminId[1];die;
                $update = array('password' => hash("sha512", $_POST['admin_pass']));
                
                //$obj_admin->attributes = $dataArr;
                //$bind = array(':adminid' => $adminId);
                
                //Check Role_id For Update Password
                if($adminId[0]=='1'){
                    $result = $obj_admin->update($update, 'admin_id="'.$adminId[0].'"');
                }
                //$obj_admin->save($adminId);
                $successMsg = 'Password Updated';
                $pssSuccess = 'Password Updated';
            } else {
                $errorMsg = 'Password Updated Error';
            }
        } else {
            $errorMsg = 'Password Not Match';
        }
        $action = '';
    }
}
if (isset($tokan) && $tokan != '') {
    $decrypt = $obj_admin->decode5t($tokan);
    $decrypt = $obj_admin->decode5t($decrypt);
    $pos = strpos($decrypt, '+');
    $adminId = substr($decrypt, $pos + 1);
    $time = substr($decrypt, 0, $pos);
    $newtime = strtotime('+1 day', $time);
    if ($newtime > $currentTimestamp) {
        $action = 'ChangePass';
    } else {
        $errorMsg = 'Tokan Expire';
        $action = '';
    }
}
if (isset($action) && $action == 'logout') {

    $obj_admin->logout();
    header("location:" . ADMIN_URL . '/login.php');
}
?>