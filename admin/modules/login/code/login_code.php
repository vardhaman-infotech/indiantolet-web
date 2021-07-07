<?php
ob_start();
extract($_POST);
extract($_GET);
$currentTimestamp = getCurrentTimestamp();
$obj_admin = new adminModel();
$obj_mail = new PHPMailerModel();
$obj_email = new emailsModel(); 
// Form Submit 
if (isset($SubmitAdmin) && $SubmitAdmin != "") { 
  //////////Check Action Type Login    
    if (isset($action) && $action == 'LoginAdmin') { 
      //Get Form Post Data
      $bind = array(':admin_username' => $obj_admin->clean($admin_username), ':admin_password' => hash("sha512", $password));      
        //Check Value In Admin Table
  //     $result = $obj_admin->select("admin_username = :admin_username and admin_pass = :admin_password and admin_type='1'", $bind);
        $result = $obj_admin->select("admin_username = :admin_username and admin_pass = :admin_password ", $bind);
        
        ////Get Data Check
        if (count($result)=='1'){
        // matching login ok
            @session_start();
            session_regenerate_id();
            if (isset($_SESSION['BBT_LoggedIn'])) {
                header('location:' . ADMIN_URL . '/home.php');
                exit;
            }           
            foreach ($result as $row) {
                $_SESSION['admin_In'] = true;
                $_SESSION['admin_Id'] = $row->admin_id;
                $_SESSION['admin_Name'] = $row->admin_fullname;
                $_SESSION['type'] = 'admin';
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
            $bind = array(':email' => $email);
            $Dataadmin = $obj_admin->select("admin_email = :email", $bind);
            if (!($Dataadmin)) {
                $errorMsg = 'NO RECORD';
            } else {
                foreach ($Dataadmin as $admin) {
                    $currenttime = getRequiredDateFormat9($currentTimestamp);
                    $tokan = $currentTimestamp . "+" . $admin->admin_id;                    
                    $encrypt = $obj_admin->encode5t($tokan);
                    $encrypt = $obj_admin->encode5t($encrypt); //==QTU1keOR0a59ERnBjTTNHe
                    $passlink = ADMIN_URL . "/login.php?tokan=" . $encrypt;
                      //////Send Mail Code
                     
                      $obj_mail->IsSMTP();  // telling the class to use SMTP
                      $obj_mail->Mailer = "smtp";
                      $obj_mail->SMTPAuth = true;
                      $obj_mail->Host = "go4drupal.com"; // SMTP server
                      $obj_mail->AddReplyTo(ADMIN_NO_REPLY, 'Hello Admin');
                      $obj_mail->AddAddress($email);
                      $obj_mail->From = "noreply@go4php.com";
                      $obj_mail->FromName = 'INDIAN TO-LET';
                      $obj_mail->IsHTML(true);
                      $obj_mail->Subject = 'Reset Password';
                      $obj_mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                      $imglogo =  IMAGE_DIR . "/logo.png";
                      $emaildata = $obj_email->selectByPk(1);
                      $emailval = $emaildata->email_description;
                      $array = array('@' => '', 'name' => $admin->admin_fullname, 'imglogo' => $imglogo,'passlink' => $passlink);
                      foreach ($array AS $key => $value) {
                      $emailval = str_replace($key, $value, $emailval);
                      }
                     // print_r($emailval); 
                     // echo $emailval;die; 
                      $tokan = "";                 
                      $obj_mail->Body = $emailval;
                     // die;
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
        $new_pass = trim($password);
        $re_pass = trim($re_pass);
        if ($new_pass == $re_pass) {
            if ($adminId) {
                $update = array('admin_pass' => hash("sha512", $_POST['password']));
                //$obj_admin->attributes = $dataArr;
                $bind = array(':adminid' => $adminId);
                $result = $obj_admin->update($update, 'admin_id=:adminid', $bind);
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
if (isset($tokan) && $tokan!= '') { 
    /////Decode Data  
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