<?php

define('ADMIN_NO_REPLY', "noreply@indiantolet.com");

function getDB() {
    try {
        $dbhost = "localhost";
        $db_username = "mydemurc_house_rental";
        $db_password = "sHgmM&dB~fu{";
        $dbname = "mydemurc_house_rental";
        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    return $conn;
}

function apitoken() {
    $token = bin2hex(openssl_random_pseudo_bytes(16));
    return hash('sha512', $token . time());
}


function Sendmail($to, $subject, $template) {
    //$objDb = new dbModel();

    $obj_mail = new PHPMailerModel();
    $obj_mail->IsSMTP();  // telling the class to use SMTP
    $obj_mail->Mailer = "smtp";
     $obj_mail->SMTPAuth = true;
    $obj_mail->Host = "indiantolet.com"; // SMTP server
    $obj_mail->AddReplyTo(ADMIN_NO_REPLY, 'Hello');
    $obj_mail->AddAddress($to);
    $obj_mail->From = ADMIN_NO_REPLY;
    $obj_mail->FromName = 'INDIA TO-LET';
    $obj_mail->IsHTML(true);
    $obj_mail->Subject = $subject;
    $obj_mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
    $obj_mail->Body = "$template";
    $obj_mail->Send();
    
    /*if(!$obj_mail->Send()) {
          echo 'Message was not sent.';
          echo 'Mailer error: ' . $obj_mail->ErrorInfo;
    } else {
         echo 'Message has been sent.';
        }
      die;*/
}

function getRequiredDateFormat9($dateTimestamp)
{
	if($dateTimestamp != "" && $dateTimestamp != 0)
		$requiredFormat = date("m-d-Y h:i:s A",$dateTimestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}

function getCurrentTimestamp(){
	$timestamp = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
	return $timestamp;
}


function highlyencrpt($string, $pattern) {

    //$currentTimestamp = getCurrentTimestamp();
    $timestamp = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
    $tokan = $timestamp . $pattern . $string;
    $encrypt = strrev(base64_encode($tokan));
    $encrypt = strrev(base64_encode($encrypt));
    $encrypt = str_replace("=", '', $encrypt);
    return $encrypt;
}

function highlydecrpt($string) {
    $u = base64_decode(strrev($string));
    $maintoken = base64_decode(strrev($u));
    return $maintoken;
}

function encode5t($cardstr) {
    $cardstr = strrev(base64_encode($cardstr));
    return $cardstr;
}

function decode5t($str) {
    $str = base64_decode(strrev($str));
    return $str;
}


$api_token = apitoken();
define('APP_TOKEN', $api_token);

$sql_query = "SELECT * from tbl_admin where admin_id='1'";
$dbCon = getDB();
$stmt = $dbCon->query($sql_query);
$users = $stmt->fetch(PDO::FETCH_OBJ);
$dbCon = null;

define('SITE_PASSWORD', $users->admin_pass);
define('SITE_EMAIL', $users->admin_email);


if (!isset($_SERVER['HTTPS']) || ($_SERVER['HTTPS'] == "off")) {


    define('DEFAULT_URL', "http://" . $_SERVER["HTTP_HOST"] . '/indian_tolet/package/');
    define('MAIN_URL', "http://" . $_SERVER["HTTP_HOST"] . '/');
    define('IMAGE_UPLOAD_URL', DEFAULT_URL . "upload");
} else {


    define('DEFAULT_URL', "https://" . $_SERVER["HTTP_HOST"] . '/indian_tolet/package/');
    define('MAIN_URL', "https://" . $_SERVER["HTTP_HOST"] . '/');
    define('IMAGE_UPLOAD_URL', DEFAULT_URL . "upload");
}



 
function checkAuthenticationUser($auth_token) {
    $dbCon = getDB();
    $SQL = "SELECT  id FROM `tbl_user` WHERE auth_token='$auth_token'";
    $stmt = $dbCon->query($SQL);
    $result = $stmt->rowCount();
    return $result;
}
function checkAuthenticationOwner($auth_token) {
    $dbCon = getDB();
    $SQL = "SELECT  id FROM `tbl_owner` WHERE auth_token='$auth_token'";
    $stmt = $dbCon->query($SQL);
    $result = $stmt->rowCount();
    return $result;
}
 

 function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

/*
function sendsms($sms,$mobile) {
    $sms= str_replace(' ', '+', $sms);
    $curl = curl_init();
// Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => "http://cloudsms.trio-mobile.com/index.php/api/bulk_mt?api_key=NUC13010100005018a021604b478f3f62dbf0718653a56c21&action=send&to=$mobile&msg=$sms&sender_id=CLOUDSMS&content_type=1&mode=shortcode",
        CURLOPT_USERAGENT => 'Codular Sample cURL Request',
        CURLOPT_POST => 1
    ));
// Send the request & save response to $resp
    $resp = curl_exec($curl);
// Close request to clear up some resources
    return $resp;
    curl_close($curl);
}
*/
function sendsms($sms,$mobile) {
    $sms = urlencode($sms);  
    $curl = curl_init();
    
// Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => "http://alotsolutions.in/API/WebSMS/Http/v1.0a/index.php?username=IndianTolet&password=Purushotham@1&sender=INDTLT&to=$mobile&message=$sms&reqid=1&format={json|text}&route_id=2&callback=Any+Callback+URL&unique=0",
        CURLOPT_USERAGENT => 'Codular Sample cURL Request',
        CURLOPT_POST => 1
    ));
    
    
    

// Send the request & save response to $resp
    $resp = curl_exec($curl);
// Close request to clear up some resources
    return $resp;
    curl_close($curl);
}

?>
