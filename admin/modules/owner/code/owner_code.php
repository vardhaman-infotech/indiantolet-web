<?php

# Coder : Ankit Sharma
# Date  : 21-Dec-2017

$currentTimestamp = getCurrentTimestamp();
$obj_owner = new ownerModel();
$obj_emails = new emailsModel();

if (isset($ownerId))
    $ownerId = decode($ownerId);
if (isset($action) && trim($action) == "submitForm") {
    if (isset($actionType) && $actionType == OWNER_ACTIVE) {
        $dataArr = array("is_active" => OWNER_ACTIVE);
        $obj_owner->attributes = $dataArr;
        $obj_owner->updateAllByPk($chk, $obj_owner->attributes, "id");
        $_SESSION['successMsg'] = OWNER_ALL_SUCCESS_ACTIVATE_MESSAGE;
        header("location:" . ADMIN_URL . "/owner.php");
        exit();
    } elseif (isset($actionType) && $actionType == OWNER_DEACTIVE) {
        $dataArr = array("is_active" => OWNER_DEACTIVE);
        $obj_owner->attributes = $dataArr;
        $obj_owner->updateAllByPk($chk, $obj_owner->attributes, "id");
        $_SESSION['successMsg'] = OWNER_ALL_SUCCESS_DEACTIVATE_MESSAGE;
        header("location:" . ADMIN_URL . "/owner.php");
        exit();
    } elseif (isset($actionType) && $actionType == OWNER_DELETE) {
        $obj_owner->deleteAllByPk($chk, "id");
        $_SESSION['successMsg'] = OWNER_ALL_SUCCESS_DELETE_MESSAGE;
        header("location:" . ADMIN_URL . "/owner.php");
        exit();
    }
} elseif (isset($action) && ($action == "editOwner" || $action == "addOwner" || $action == "viewOwner")) {
    if (isset($submitOwner) && $submitOwner != "") {
        unset($_POST['submitOwner']);
        ///////////////Edit Form Data 
        if (isset($ownerID) && $ownerID != "" && $action == "editOwner") {
            //////Check Email Id 
            $owner_Detail = $obj_owner->selectByPk($ownerID, '', 'image');
            $email = $_POST['email_id'];
            $mobile_number = $_POST['phone_number'];
            $check_email = $obj_owner->select("email_id='$email' and id!= '$ownerID'");
            if (count($check_email) == 0) {
                //////Check Mobile Number 
                $check_phone = $obj_owner->select("phone_number='$mobile_number' and id!='$ownerID'");
                if (count($check_phone) == 0) {
                    /* For Change Password */
                    $obj_owner->attributes = $_POST;
                    if (isset($_POST['Chk_chage_pass']) && $_POST['Chk_chage_pass'] == 1) {
                        $new_pass = trim($_POST['n_pass']);
                        $re_pass = trim($_POST['re_pass']);

                        if ($new_pass == $re_pass) {
                            $obj_owner->attributes['password'] = hash("sha512", $_POST['n_pass']);
                        }
                    }

                    /* For owner Image  */
                    if (isset($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
                        $image_ext_get = explode('.', $_FILES['image']['name']);
                        $image_ext = end($image_ext_get);
                        if (in_array($image_ext, ImageExtentionCheck())) {
                            if (isset($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
                                if (!empty($owner_Detail->image)) {
                                    $remove_image = UPLOAD_DIR . '/owner_image/' . $owner_Detail->image;
                                    ////Remove Image
                                    if (file_exists($remove_image)) {
                                        unlinkImage($remove_image);
                                    }
                                }
                                $image = imageUpload('image', 'owner_image');
                                $obj_owner->attributes['image'] = $image;
                            }
                             
                        }
                    }
                    /* For Adhar card Image  */
                    if (isset($_FILES['adhar_card']['name']) && $_FILES['adhar_card']['error'] == 0) {
                        $image_ext_get = explode('.', $_FILES['adhar_card']['name']);
                        $image_ext = end($image_ext_get);
                        if (in_array($image_ext, ImageExtentionCheck())) {
                            if (isset($_FILES['adhar_card']['name']) && $_FILES['adhar_card']['error'] == 0) {
                                if (!empty($owner_Detail->image)) {
                                    $remove_image = UPLOAD_DIR . '/owner_adhar_card/' . $owner_Detail->adhar_card;
                                    ////Remove Image
                                    if (file_exists($remove_image)) {
                                        unlinkImage($remove_image);
                                    }
                                }
                                $image = imageUpload('adhar_card', 'owner_adhar_card');
                                $obj_owner->attributes['adhar_card'] = $image;
                            }
                             
                        }
                    }
                    /* End Change password */
                    $_POST['modification_date'] = $currentTimestamp;

                 
                    $obj_owner->update($obj_owner->attributes, "id=" . $ownerID);
                    $_SESSION['successMsg'] = OWNER_SUCCESS_UPDATE_MESSAGE;
                    header("location:" . ADMIN_URL . "/owner.php");
                    exit();
                    /////Show Message    
                } else {
                    $_SESSION['successMsg'] = 'Phone Number is Already Exist !';
                }
                /////Show Message    
            } else {
                $_SESSION['successMsg'] = 'Email Id is Already Exist !';
            }
            ///////////////Add Form Data 
        } elseif ($action == "addOwner") {

            // print_r($_POST);die;
            //////Check Email Id 
            $check_email = $obj_owner->select("email_id='" . $_POST['email_id'] . "'");

            if (count($check_email) == 0) {
                //Check Mobile Number 
                $check_phone = $obj_owner->select("phone_number='" . $_POST['phone_number'] . "'");
                if (count($check_phone) == 0) {
                    //Check Email Id
                    $check_Email = $obj_owner->select("email_id='" . $_POST['email_id'] . "'");
                    if (count($check_Email) == 0) {
                        $obj_owner->attributes = $_POST;
                        /*For Owner Image*/
                        if (!empty($_FILES['image']['name'])) {
                            if (isset($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
                                $image_ext_get = explode('.', $_FILES['image']['name']);
                                $image_ext = end($image_ext_get);
                                if (in_array($image_ext, ImageExtentionCheck())) {
                                    $image_name = imageUpload('image', 'owner_image');
                                    $obj_owner->attributes['image'] = $image_name;
                                } else {
                                    $_SESSION['successMsg'] = "Required image format jpg,png,gif,bmp,jpeg,PNG,JPG,JPEG,GIF,BMP only!";
                                }
                            } else {
                                $_SESSION['successMsg'] = "Required  image!";
                            }
                        }
                        /*For Adhar Card Image*/
                        if (!empty($_FILES['adhar_card']['name'])) {
                            if (isset($_FILES['adhar_card']['name']) && $_FILES['adhar_card']['error'] == 0) {
                                $image_ext_get = explode('.', $_FILES['adhar_card']['name']);
                                $image_ext = end($image_ext_get);
                                if (in_array($image_ext, ImageExtentionCheck())) {
                                    $image_name = imageUpload('adhar_card', 'owner_adhar_card');
                                    $obj_owner->attributes['adhar_card'] = $image_name;
                                } else {
                                    $_SESSION['successMsg'] = "Required image format jpg,png,gif,bmp,jpeg,PNG,JPG,JPEG,GIF,BMP only!";
                                }
                            } else {
                                $_SESSION['successMsg'] = "Required  image!";
                            }
                        }
                        $password = '';
                        $chars = '0123456789';
                        $chars1 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $chars2 = 'abcdefghijklmnopqrstuvwxyz';
                        $passwordGen = substr(str_shuffle($chars), 0, 6);
                        $passwordGen .= substr(str_shuffle($chars1), 0, 1);
                        $passwordGen .= substr(str_shuffle($chars2), 0, 1);
                        /* Insert Password */
                        $password = hash("sha512", $passwordGen);
                        $obj_owner->attributes['password'] = $password; 
                        $ownerID = $obj_owner->insert($obj_owner->attributes);

                        //////////////Send Mail Coding

                        $obj_email = new emailsModel();
                        $emaildata = $obj_email->selectByPk(2);
                        $emailval = $emaildata->email_description;
                        $subject = $emaildata->email_subject;
                        /////Send Emai Id Name
                        $Email_id = $_POST['email_id'];
                        ///////Add Logo
                        $imglogo = IMAGE_DIR . "/logo.png";
                        $array = array('@' => '', 'name' => ucfirst($_POST['name']), 'imglogo' => $imglogo, 'email' => $Email_id, 'password' => $passwordGen); //


                        foreach ($array AS $key => $value) {
                            $emailval = str_replace($key, $value, $emailval);
                        }
                       // echo $emailval;die;
                        SendMail($Email_id, $subject, $emailval);
                        ///////End Code
                        $_SESSION['successMsg'] = OWNER_SUCCESS_ADD_MESSAGE;
                        header("location:" . ADMIN_URL . "/owner.php");
                        exit();
                    } else {
                        $_SESSION['successMsg'] = 'Email Id is Already Exist !';
                    }
                } else {
                    $_SESSION['successMsg'] = 'Phone Number is Already Exist !';
                }
                /////Show Message    
            } else {
                $_SESSION['successMsg'] = 'Email Id is Already Exist !';
            }
        }
    }
    ///////End
    ////////////Show Data For Edit Time
    if (isset($ownerId) && $ownerId != "" && ($action == "editOwner" || $action == "viewOwner")) {
        $owner = $obj_owner->selectByPk($ownerId);
        $owner = (array) $owner;
        extract($owner);
    }
} elseif (isset($action) && trim($action) == "activateOwner" && $ownerId != "") {
    $dataArr = array("is_active" => OWNER_ACTIVE);
    $obj_owner->attributes = $dataArr;
    $obj_owner->update($obj_owner->attributes, "id=" . $ownerId);
    $_SESSION['successMsg'] = OWNER_SUCCESS_ACTIVATE_MESSAGE;
    header("location:" . ADMIN_URL . "/owner.php");
    exit();
} elseif (isset($action) && $action == "deActivateOwner" && $ownerId != "") {
    $dataArr = array("is_active" => OWNER_DEACTIVE);
    $obj_owner->attributes = $dataArr;
    $obj_owner->update($obj_owner->attributes, "id=" . $ownerId);
    $_SESSION['successMsg'] = OWNER_SUCCESS_DEACTIVATE_MESSAGE;
    header("location:" . ADMIN_URL . "/owner.php");
    exit();
} elseif (isset($action) && $action == "delete" && $ownerId != "") {
    $obj_owner->delete("id=" . $ownerId);
    $_SESSION['successMsg'] = OWNER_SUCCESS_DELETE_MESSAGE;
    header("location:" . ADMIN_URL . "/owner.php");
    exit();
} else {
    $data_owner = $obj_owner->select('');
}
?>