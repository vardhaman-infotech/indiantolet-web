<?php

/* ==================================================================*\
  #   Coder: Ghanshyam
 * Date : 20-11-2017
  \*================================================================== */

function emailCheck() {
    if (isset($_POST) && !empty($_POST)) {
        $obj_marketing = new marketing_userModel();
        echo $obj_marketing->emailChecker($_POST['email']);
    }
}

//For show the delete and active and deactive button in admin
function AllButtonShow($pageName = '') {
    if (empty($pageName)) {
        $allButton = '<button class="btn btn-info GreyBtn" type="button" id="activateBtn" disabled>Active</button>
                  <button class="btn btn-warning GreyBtn" type="button" id="deActivateBtn" disabled>Deactive</button>
                  <button class="btn btn-danger GreyBtn" type="button" id="delete_all" disabled>Delete</button>
                  ';
    } else {
        $allButton = '<button class="btn btn-info GreyBtn" type="button" id="activateBtn" disabled>Active</button>
                  <button class="btn btn-warning GreyBtn" type="button" id="deActivateBtn" disabled>Deactive</button>';
    }
    return $allButton;
}

################ pagination function #########################################

function paginate_function($item_per_page, $current_page, $total_records, $total_pages) {
    $pagination = '';
    if ($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages) { //verify total pages and current page number
        $pagination .= '<ul class="pagination">';

        $right_links = $current_page + 3;
        $previous = $current_page - 3; //previous link 
        $next = $current_page + 1; //next link
        $first_link = true; //boolean var to decide our first link

        if ($current_page > 1) {
            $previous_link = ($previous == 0) ? 1 : $previous;
            $pagination .= '<li class="first"><a href="#" data-page="1" title="First">&laquo;</a></li>'; //first link
            $pagination .= '<li><a href="#" data-page="' . $previous_link . '" title="Previous">&lt;</a></li>'; //previous link
            for ($i = ($current_page - 2); $i < $current_page; $i++) { //Create left-hand side links
                if ($i > 0) {
                    $pagination .= '<li><a href="#" data-page="' . $i . '" title="Page' . $i . '">' . $i . '</a></li>';
                }
            }
            $first_link = false; //set first link to false
        }

        if ($first_link) { //if current active page is first link
            $pagination .= '<li class="first active">' . $current_page . '</li>';
        } elseif ($current_page == $total_pages) { //if it's the last active link
            $pagination .= '<li class="last active">' . $current_page . '</li>';
        } else { //regular current link
            $pagination .= '<li class="active">' . $current_page . '</li>';
        }

        for ($i = $current_page + 1; $i < $right_links; $i++) { //create right-hand side links
            if ($i <= $total_pages) {
                $pagination .= '<li><a href="#" data-page="' . $i . '" title="Page ' . $i . '">' . $i . '</a></li>';
            }
        }
        if ($current_page < $total_pages) {
            $next_link = ($i > $total_pages) ? $total_pages : $i;
            $pagination .= '<li><a href="#" data-page="' . $next_link . '" title="Next">></a></li>'; //next link
            $pagination .= '<li class="last"><a href="#" data-page="' . $total_pages . '" title="Last">&raquo;</a></li>'; //last link
        }

        $pagination .= '</ul>';
    }
    return $pagination; //return pagination links
}

function encode($key) {
    return base64_encode($key);
}

function decode($key) {
    return base64_decode($key);
}

//Function for get the extension
function getExtension($str) {

    $i = strrpos($str, ".");
    if (!$i) {
        return "";
    }

    $l = strlen($str) - $i;
    $ext = substr($str, $i + 1, $l);
    return $ext;
}

/**
 * Determine a credit card's "type"
 * based on the credit card number.
 * Note that this does not check the
 * validity of a credit card. For that,
 * you would need to use the Luhn Algorithm,
 * and ideally a merchant gateway to
 * confirm that credit card is valid.
 *
 * Some test numbers include:
 * Amex: 371449635398431
 * Diners: 36438936438936
 * Discover: 6011016011016011
 * JCB: 3566003566003566
 * Mastercard: 5500005555555559
 * Visa: 4111111111111111
 *
 * @param string $cardNumber Credit card number
 * @return string Card type: Visa, Mastercard, Amex, Diners Club, Discover, or JCB
 */
//Function for Upload Image two or more
function imageUploadmore($upload_field, $folder_path, $name = '') {
    if (!empty($_FILES["$upload_field"]["name"])) {
        $file_name = $_FILES["$upload_field"]["name"];
        $temp_name = $_FILES["$upload_field"]["tmp_name"];
        $imgtype = $_FILES["$upload_field"]["type"];
        $exttype = explode('/', $imgtype);
        $imagename = $name . date("d-m-Y") . "-" . time() . "." . end($exttype);
        $target_path = UPLOAD_DIR . '/' . $folder_path . '/' . $imagename;
        if ($target_path) {
            move_uploaded_file($temp_name, $target_path);
            return $imagename;
        } else {
            exit("Error While uploading image on the server");
        }
    }
}

//Function for Upload Image
function imageUpload($upload_field, $folder_path, $label = '') {
    if (!empty($_FILES["$upload_field"]["name"])) {
        $file_name = $_FILES["$upload_field"]["name"];
        $temp_name = $_FILES["$upload_field"]["tmp_name"];
        $imgtype = $_FILES["$upload_field"]["type"];
        $exttype = explode('/', $imgtype);
        $imagename = $label . date("d-m-Y") . "-" . time() . "." . end($exttype);
        $target_path = UPLOAD_DIR . '/' . $folder_path . '/' . $imagename;
        if ($target_path) {
            move_uploaded_file($temp_name, $target_path);
            return $imagename;
        } else {
            exit("Error While uploading image on the server");
        }
    }
}

function ImageExtentionCheck() {
    return array("jpg", "png", "gif", "bmp", "jpeg", "PNG", "JPG", "JPEG", "GIF", "BMP");
}

function ImageExtentionCheck_license() {
    return array("jpg", "png", "gif", "bmp", "jpeg", "PNG", "JPG", "JPEG", "GIF", "BMP", "PDF");
}

function imageUploadDeeply($filedName, $folderName) {
    $folderNameGet = $folderName;
    if (isset($folderName)) {
        $folderName = explode("/", $folderName);
    }
    $folderName = end($folderName);
    $path = UPLOAD_DIR . '/' . $folderNameGet . '/';
    $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "PNG", "JPG", "JPEG", "GIF", "BMP");
    $name = $_FILES[$filedName]['name'];
    if (strlen($name)) {
        $ext = getExtension($name);
        if (in_array($ext, $valid_formats)) {
            $actual_image_name = time() . substr(str_replace(" ", "_", $ext), 5) . "_" . $folderName . "." . $ext;
            $tmp = $_FILES[$filedName]['tmp_name'];
            if (@move_uploaded_file($tmp, $path . $actual_image_name)) {
                return $actual_image_name;
            } else
                return "0";
        } else
            return "Please upload only valid formats (jpg, png, gif, bmp, jpeg, PNG, JPG, JPEG, GIF, BMP)";
    } else
        return "Please select image..!";
}

//Function for Upload cv
function CvUpload($filedName, $folderName) {
    $path = UPLOAD_DIR . '/' . $folderName . '/';
    $valid_formats = array("doc", "docx", "docm", "dotm");
    $name = $_FILES[$filedName]['name'];
    $size = $_FILES[$filedName]['size'];
    $totalSize = 1024 * 5024;
    if (strlen($name)) {
        $ext = getExtension($name);
        if (in_array($ext, $valid_formats)) {
            if ($size < $totalSize) {
                $actual_image_name = time() . substr(str_replace(" ", "_", $ext), 5) . "_" . $folderName . "." . $ext;
                $tmp = $_FILES[$filedName]['tmp_name'];
                if (@move_uploaded_file($tmp, $path . $actual_image_name)) {
                    return $actual_image_name;
                } else
                    return "0";
            } else
                return "0";
        } else
            return "0";
    } else
        return "Please select your CV..!";
}

function unlinkImage($path) {
    if (!unlink($path)) {
        return 0;
    } else {
        return 1;
    }
}

//For Genrate the random string
function randString($min = 5, $max = 8) {
# get random character length between minimum and maximum length
    $length = rand($min, $max);
    $string = '';
# character index [0-9a-zA-Z]
    $index = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $index = '0123456789abcdefghjklmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
# loop random times defined by $length
    for ($i = 0; $i < $length; $i++) {
# get random character index
        $string .= $index[rand(0, strlen($index) - 1)];
    }
    return $string;
}

//function for the show the data as primary key
function valueNamePrimary($module, $value, $getValue) {
    $obj = new $module();
    $get = $obj->selectByPk($value, '', $getValue);
    if (isset($get) && count((array)($get)) > 0) {
        return $get->$getValue;
    } else {
        return 'No';
    }
}

//function for the show the data as primary key multiple
function multiNamePrimary($module, $value, $getValue) {
    $obj = new $module();
    $value = explode(';', $value);
    array_pop($value);
    $name = '';
    if (!empty($value)) {
        foreach ($value as $valueMulti) {
            $get = $obj->selectByPk($valueMulti, '', $getValue);
            if (count($get) > 0) {
                $name .= $get->$getValue . ', ';
            }
        }
        return trim($name, ', ');
    } else {
        return 'No';
    }
}

//Attach PDF
function pdf_mail($path, $mailto, $replyto, $subject, $message) {
    $obj_mail = new PHPMailerModel();
    $obj_mail->IsSMTP();  // telling the class to use SMTP
    $obj_mail->Mailer = "mail";
    $obj_mail->Host = "192.254.238.218"; // SMTP server
    $obj_mail->AddReplyTo($replyto, 'Hello');
    $obj_mail->AddAddress($mailto);
    $obj_mail->AddBCC($mailto);
    $obj_mail->From = ADMIN_NO_REPLY;
    $obj_mail->From = 'noreply@go4drupal.com';
    $obj_mail->FromName = 'GS Taxi';
    $obj_mail->Subject = $subject;
    $obj_mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
    $imglogo = IMAGE_DIR . '/logo_email.png';
    $emailval = $message;
    $obj_mail->AddAttachment($path);     // attachment

    $obj_mail->Body = $emailval;
    // print_r($obj_mail);
    $obj_mail->Send();
}

//function for send the email with attachment
function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
    $file = $path . $filename;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $name = basename($file);
    $header = "From: " . $from_name . " <" . $from_mail . ">\r\n";
    $header .= "Reply-To: " . $replyto . "\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--" . $uid . "\r\n";
    $header .= "Content-type:text/html; charset=UTF-8\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $header .= $message . "\r\n\r\n";
    $header .= "--" . $uid . "\r\n";
    $header .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"\r\n"; // use different content types here
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\r\n\r\n";
    $header .= $content . "\r\n\r\n";
    $header .= "--" . $uid . "--";

    if (mail($mailto, $subject, "", $header)) {
        
    } else {
        echo "mail send ... ERROR!";
    }
}

function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale) {
    list($imagewidth, $imageheight, $imageType) = getimagesize($image);
    $imageType = image_type_to_mime_type($imageType);

    $newImageWidth = ceil($width * $scale);
    $newImageHeight = ceil($height * $scale);
    $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
    $color = imagecolorallocate($newImage, 255, 255, 255);
    imagefilledrectangle($newImage, 0, 0, $newImageWidth, $newImageHeight, $color);
    switch ($imageType) {
        case "image/gif":
            $source = imagecreatefromgif($image);
            break;
        case "image/pjpeg":
        case "image/jpeg":
        case "image/jpg":
            $source = imagecreatefromjpeg($image);
            break;
        case "image/png":
        case "image/x-png":
            $source = imagecreatefrompng($image);
            break;
    }
    imagecopyresampled($newImage, $source, 0, 0, $start_width, $start_height, $newImageWidth, $newImageHeight, $width, $height);
    switch ($imageType) {
        case "image/gif":
            imagegif($newImage, $thumb_image_name);
            break;
        case "image/pjpeg":
        case "image/jpeg":
        case "image/jpg":
            imagejpeg($newImage, $thumb_image_name, 100);
            break;
        case "image/png":
        case "image/x-png":
            imagepng($newImage, $thumb_image_name);
            break;
    }
    chmod($thumb_image_name, 0777);
    return $thumb_image_name;
}

//For send sms function
function SendSms($sms, $mobile) {
    $curl = curl_init();
    // Set some options - we are passing in a useragent too here
    $sms = urlencode($sms);
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => "http://api.smartsmssolutions.com/smsapi.php?username=gs&password=friday&sender=GSTaxi&recipient=$mobile&message=$sms",
        CURLOPT_USERAGENT => 'Codular Sample cURL Request',
        CURLOPT_POST => 1
    ));
    // Send the request & save response to $resp
    $resp = curl_exec($curl);
    // Close request to clear up some resources
    //return $resp;
    curl_close($curl);
}

function getcityname($address) {
    $city = 'Jaipur';
    $prepAddr = str_replace(' ', '+', $address);
    $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $prepAddr . '&sensor=false');
    $output = json_decode($geocode);
    if (isset($output->results[0]->address_components[1]->long_name) && !empty($output->results[0]->address_components[1]->long_name)) {
        $city = $output->results[0]->address_components[1]->long_name;
    }
    return $city;
}

// For price round in decimal format 2 digits
function round_to_2dp($number) {
    return number_format((float) $number, 2, '.', '');
}

function get_data($query) {
    $objDb = new dbModel();
    //echo $query;die;
    return $objDb->run($query);
}

//Mail Send
function SendMail($to, $subject, $template) {
    //$objDb = new dbModel();
    $obj_mail = new PHPMailerModel();
    $obj_mail->IsSMTP();  // telling the class to use SMTP
    $obj_mail->Mailer = "smtp";
    $obj_mail->SMTPAuth = true;
    $obj_mail->Host = "go4drupal.com"; // SMTP server
    $obj_mail->AddReplyTo(ADMIN_NO_REPLY, 'Hello');
    $obj_mail->AddAddress($to);
    $obj_mail->From = ADMIN_NO_REPLY;
    $obj_mail->FromName = 'INDIAN TO-LET';
    $obj_mail->IsHTML(true);
    $obj_mail->Subject = $subject;
    $obj_mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
    $obj_mail->Body = "$template";
    $obj_mail->Send();
}

// Date Diff Function
function dateDifference($date_1, $date_2, $differenceFormat = '%y Year %m Month %d Days') {
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);

    $interval = date_diff($datetime1, $datetime2);

    return $interval->format($differenceFormat);
}

/* For highlydecrpt string */

function highlydecrpt($string) {
    $u = base64_decode(strrev($string));
    $maintoken = base64_decode(strrev($u));
    return $maintoken;
}

/* For android notification */




/* For user send notification code */

function User_android_send_notification($id, $msg, $gcm, $title, $type = '', $userId = '') {

// Notification code        
    include_once("farmer_firebase.php");
    include_once("push.php");
    $firebase = new Firebase();
    $push = new Push();
// optional payload
    $payload = array();
    $payload['team'] = 'India';
    $payload['score'] = '5.6';


// print_r($driverGsmTokenInfo);
    //$gcm ='c4nt5gDeHUU:APA91bHBxhaCJ0IzaXalyMDivx2os7vq5-_5drn2wofOhGn8_aVbB7wYNCCnz4qVGnavgWoKqHYngc0Amr7OzetyEoytJeha238hiSGquFtWBNzhrkyMxPXB-NYXcpsV90GmNzEmRWo-3oA3cLFySMXGrTjClGizsQ';
    if (isset($gcm) && !empty($gcm)) {
// notification title  
        $message = $msg;
        $status = 'GPS';
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
        return $response = $firebase->send($gcm, $json);
        //print_r($response);
    } else {
//        $return_array = array('success' => '1', 'text' => "DRIVER GSM TOKEN EMPTY");
//        echo $senddata=json_encode($return_array);
    }
}

function User_iphone_send_notification($id, $msg, $fcm, $title, $type = '', $userId = '') {
    if (isset($fcm) && !empty($fcm)) {
        $root_path = $_SERVER["DOCUMENT_ROOT"] . "/freshpro/api/";
// require_once($root_path."webroot\cron\library\config.php");
        require_once($root_path . "ApnsPHP/Autoload.php");
        global $obj_basic;
        try {
            $passphrase = '123456';
            $ctx = stream_context_create();
            $root_path = $_SERVER["DOCUMENT_ROOT"] . "/freshpro/api/FreshproFarmer.pem";
//stream_context_set_option($ctx, 'ssl', 'local_cert', 'MCFfinalDist.pem'); //Live
            stream_context_set_option($ctx, 'ssl', 'local_cert', $root_path); // Development
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
                $status = 'GPS';

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

//Function for Upload multiple Image
function multiimageUpload($filedName, $folderName, $i) {

    $path = UPLOAD_DIR . '/' . $folderName . '/';
    $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "PNG", "JPG", "JPEG", "GIF", "BMP");
    $name = $_FILES[$filedName]['name'][$i];
    $size = $_FILES[$filedName]['size'][$i];
    $file_size = $size / 1024; // Get file size in KB
    //$totalSize = 1024 * 768 ;
    $totalSize = 1000;
    if (strlen($name)) {
        $ext = getExtension($name);
        if (in_array($ext, $valid_formats)) {
            if ($file_size <= $totalSize) {
                $actual_image_name = time() . substr(str_replace(" ", "_", $ext), 5) . "_" . $folderName . $i . "." . $ext;
                $tmp = $_FILES[$filedName]['tmp_name'][$i];
                if (@move_uploaded_file($tmp, $path . $actual_image_name)) {
                    return $actual_image_name;
                } else
                    return "0";
            } else
            //echo "size is greater than 80 kb";die;
                return "2";
        } else
            return "0";
    } else
        return "Please select image..!";
}

/**/



/* For get week range from month and year */

function get_week_range_date($forcast_date = '') {
    $no_of_days_in_month = date("t", strtotime($forcast_date));
    $no_of_weeks = (ceil(intval($no_of_days_in_month) / 7));
    intval($no_of_days_in_month) / 7;
    $week_inc = 0;
    $curr_month_year = $forcast_date;

    $week_arr = array();
    for ($i = 1; $i <= $no_of_weeks; $i++) {
        if ($week_inc + 7 > $no_of_days_in_month)
            $day = $no_of_days_in_month;
        else
            $day = $week_inc + 7;

        /* $week_arr[$i]['start'] = ($week_inc + 1) . "-" . $curr_month_year;
          $week_arr[$i]['end'] = ($week_inc + 7) . "-" . $curr_month_year;
          $week_inc += 7; */
        $week_arr[$i]['start'] = ($week_inc + 1) . "-" . $curr_month_year;
        $week_arr[$i]['end'] = $day . "-" . $curr_month_year;
        $week_inc += 7;
    }
    return $week_arr;
}

// for get order list
function getOrderList($condition = '', $limit = "", $orderBy = "") {
    $objDb = new dbModel();
    if (isset($condition) && !empty($condition)) {
        $sql = "SELECT tbl_order_management.id,tbl_order_management.restaurant_id,tbl_order_management.created_date,tbl_user.id as user_id,tbl_user.first_name,tbl_order_management.total_amount,tbl_order_management.order_status,tbl_order_management.payment_status
FROM tbl_user as tbl_user
INNER JOIN tbl_order_management
ON tbl_user.id=tbl_order_management.user_id WHERE  " . "$condition" . " GROUP BY tbl_order_management.id ORDER BY " . "$orderBy ";
    } else {
        $sql = "SELECT tbl_order_management.id,tbl_order_management.restaurant_id,tbl_order_management.created_date,tbl_user.id as user_id,tbl_user.first_name,tbl_order_management.total_amount,tbl_order_management.order_status,tbl_order_management.payment_status
FROM tbl_user as tbl_user
INNER JOIN tbl_order_management
ON tbl_user.id=tbl_order_management.user_id  GROUP BY tbl_order_management.id ORDER BY " . "$orderBy ";
    }
    // echo $sql; die;
    return $objDb->run($sql);
}

function getOrderList2($condition = '', $orderBy = "") {
    $objDb = new dbModel();
    if (isset($condition) && !empty($condition)) {
        $sql = "SELECT tbl_order_management.id,tbl_order_management.restaurant_id,tbl_order_management.created_date,tbl_user.id as user_id,tbl_user.first_name,tbl_order_management.total_amount,tbl_order_management.order_status,tbl_order_management.payment_status
FROM tbl_user as tbl_user
INNER JOIN tbl_order_management
ON tbl_user.id=tbl_order_management.user_id  WHERE " . "$condition" . " GROUP BY tbl_order_management.id ORDER BY " . "$orderBy ";
    } else {
        $sql = "SELECT tbl_order_management.id,tbl_order_management.restaurant_id,tbl_order_management.created_date,tbl_user.id as user_id, tbl_user.first_name,tbl_order_management.total_amount,tbl_order_management.order_status,tbl_order_management.payment_status
FROM tbl_user as tbl_user
INNER JOIN tbl_order_management
ON tbl_user.id=tbl_order_management.user_id  GROUP BY tbl_order_management.id ORDER BY " . "$orderBy ";
    }
    //echo $sql; die;
    return $objDb->run($sql);
}

/* ----------------------For get restaurant order---------------------------- */

// for get order list
function Restaurant_getOrderList($condition = '', $limit = "", $orderBy = "") {
    $objDb = new dbModel();
    if (isset($condition) && !empty($condition)) {
        $sql = "SELECT tbl_order_management.id,tbl_order_management.restaurant_id,tbl_order_management.created_date,tbl_user.id as user_id,tbl_user.first_name,tbl_order_management.total_amount,tbl_order_management.order_status,tbl_order_management.payment_status
FROM tbl_user as tbl_user
INNER JOIN tbl_order_management
ON tbl_user.id=tbl_order_management.user_id WHERE  " . "$condition" . " and tbl_order_management.restaurant_id='" . $_SESSION['restaurant_Id'] . "' GROUP BY tbl_order_management.id ORDER BY " . "$orderBy ";
    } else {
        $sql = "SELECT tbl_order_management.id,tbl_order_management.restaurant_id,tbl_order_management.created_date,tbl_user.id as user_id,tbl_user.first_name,tbl_order_management.total_amount,tbl_order_management.order_status,tbl_order_management.payment_status
FROM tbl_user as tbl_user
INNER JOIN tbl_order_management
ON tbl_user.id=tbl_order_management.user_id WHERE tbl_order_management.restaurant_id='" . $_SESSION['restaurant_Id'] . "' GROUP BY tbl_order_management.id ORDER BY " . "$orderBy ";
    }
    // echo $sql; die;
    return $objDb->run($sql);
}

function Restaurant_getOrderList2($condition = '', $orderBy = "") {
    $objDb = new dbModel();
    if (isset($condition) && !empty($condition)) {
        $sql = "SELECT tbl_order_management.id,tbl_order_management.restaurant_id,tbl_order_management.created_date,tbl_user.id as user_id,tbl_user.first_name,tbl_order_management.total_amount,tbl_order_management.order_status,tbl_order_management.payment_status
FROM tbl_user as tbl_user
INNER JOIN tbl_order_management
ON tbl_user.id=tbl_order_management.user_id  WHERE " . "$condition" . " and tbl_order_management.restaurant_id='" . $_SESSION['restaurant_Id'] . "' GROUP BY tbl_order_management.id ORDER BY " . "$orderBy ";
    } else {
        $sql = "SELECT tbl_order_management.id,tbl_order_management.restaurant_id,tbl_order_management.created_date,tbl_user.id as user_id, tbl_user.first_name,tbl_order_management.total_amount,tbl_order_management.order_status,tbl_order_management.payment_status
FROM tbl_user as tbl_user
INNER JOIN tbl_order_management
ON tbl_user.id=tbl_order_management.user_id WHERE tbl_order_management.restaurant_id='" . $_SESSION['restaurant_Id'] . "' GROUP BY tbl_order_management.id ORDER BY " . "$orderBy ";
    }
    //echo $sql; die;
    return $objDb->run($sql);
}

//For get restaurant menu product name
function Get_Restaurent_Menu($restaurant_menu_id = '') {
    if (isset($restaurant_menu_id) && $restaurant_menu_id != '') {
        $objDb = new dbModel();
        $sql = "SELECT name from tbl_restaurant_menu_product where id='$restaurant_menu_id'";
        return $objDb->run($sql);
    }
}
