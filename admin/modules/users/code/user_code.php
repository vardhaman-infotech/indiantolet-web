<?php

# Coder : Ankit Sharma
# Date  : 21-Dec-2017

$currentTimestamp = getCurrentTimestamp();
$obj_user = new userModel();


if (isset($userId))
    $userId = decode($userId);
if (isset($action) && trim($action) == "submitForm") {
    if (isset($actionType) && $actionType == USER_ACTIVE) {
        $dataArr = array("is_active" => USER_ACTIVE);
        $obj_user->attributes = $dataArr;
        $obj_user->updateAllByPk($chk, $obj_user->attributes, "id");
        $_SESSION['successMsg'] = USER_ALL_SUCCESS_ACTIVATE_MESSAGE;
        header("location:" . ADMIN_URL . "/users.php");
        exit();
    } elseif (isset($actionType) && $actionType == USER_DEACTIVE) {
        $dataArr = array("is_active" => USER_DEACTIVE);
        $obj_user->attributes = $dataArr;
        $obj_user->updateAllByPk($chk, $obj_user->attributes, "id");
        $_SESSION['successMsg'] = USER_ALL_SUCCESS_DEACTIVATE_MESSAGE;
        header("location:" . ADMIN_URL . "/users.php");
        exit();
    } elseif (isset($actionType) && $actionType == USER_DELETE) {
        $obj_user->deleteAllByPk($chk, "id");
        $_SESSION['successMsg'] = USER_ALL_SUCCESS_DELETE_MESSAGE;
        header("location:" . ADMIN_URL . "/users.php");
        exit();
    }
} elseif (isset($action) && ($action == "editUser" || $action == "addUser" || $action == "viewUser")) {
    if (isset($submitUser) && $submitUser != "") {
        unset($_POST['submitUser']);
        ///////////////Edit Form Data 
        if (isset($userID) && $userID != "" && $action == "editUser") {
            //////Check Email Id 
            $user_Detail = $obj_user->selectByPk($userID, '', 'image');
            $email = $_POST['email_id'];
            $mobile_number = $_POST['phone_number'];
            $check_email = $obj_user->select("email_id='$email' and id!= '$userID'");
            if (count($check_email) == 0) {
                //////Check Mobile Number 
                $check_phone = $obj_user->select("phone_number='$mobile_number' and id!='$userID'");
                if (count($check_phone) == 0) {
                    /* For Change Password */
                    $obj_user->attributes = $_POST;
                    if (isset($_POST['Chk_chage_pass']) && $_POST['Chk_chage_pass'] == 1) {
                        $new_pass = trim($_POST['n_pass']);
                        $re_pass = trim($_POST['re_pass']);

                        if ($new_pass == $re_pass) {
                            $obj_user->attributes['password'] = hash("sha512", $_POST['n_pass']);
                        }
                    }

                    /* user Image  */
                    if (isset($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
                        $image_ext_get = explode('.', $_FILES['image']['name']);
                        $image_ext = end($image_ext_get);
                        if (in_array($image_ext, ImageExtentionCheck())) {
                            if (isset($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
                                if (!empty($user_Detail->image)) {
                                    $remove_image = UPLOAD_DIR . '/image/' . $user_Detail->image;
                                    ////Remove Image
                                    if (file_exists($remove_image)) {
                                        unlinkImage($remove_image);
                                    }
                                }
                                $image = imageUpload('image', 'user_image');
                                $obj_user->attributes['image'] = $image;
                            }
                             
                        }
                    }
                     /* For Adhar card Image  */
                    if (isset($_FILES['adhar_card']['name']) && $_FILES['adhar_card']['error'] == 0) {
                        $image_ext_get = explode('.', $_FILES['adhar_card']['name']);
                        $image_ext = end($image_ext_get);
                        if (in_array($image_ext, ImageExtentionCheck())) {
                            if (isset($_FILES['adhar_card']['name']) && $_FILES['adhar_card']['error'] == 0) {
                                if (!empty($user_Detail->image)) {
                                    $remove_image = UPLOAD_DIR . '/user_adhar_card/' . $user_Detail->adhar_card;
                                    ////Remove Image
                                    if (file_exists($remove_image)) {
                                        unlinkImage($remove_image);
                                    }
                                }
                                $image = imageUpload('adhar_card', 'user_adhar_card');
                                $obj_user->attributes['adhar_card'] = $image;
                            }
                             
                        }
                    }
                    /* End Change password */
                    $_POST['modification_date'] = $currentTimestamp;
                    $obj_user->update($obj_user->attributes, "id=" . $userID);
                    $_SESSION['successMsg'] = USER_SUCCESS_UPDATE_MESSAGE;
                    header("location:" . ADMIN_URL . "/users.php");
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
        } elseif ($action == "addUser") {

            // print_r($_POST);die;
            //////Check Email Id 
            $check_email = $obj_user->select("email_id='" . $_POST['email_id'] . "'");

            if (count($check_email) == 0) {
                //Check Mobile Number 
                $check_phone = $obj_user->select("phone_number='" . $_POST['phone_number'] . "'");
                if (count($check_phone) == 0) {
                    //Check Email Id
                    $check_Email = $obj_user->select("email_id='" . $_POST['email_id'] . "'");
                    if (count($check_Email) == 0) {
                        $obj_user->attributes = $_POST;
                        if (!empty($_FILES['image']['name'])) {
                            if (isset($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
                                $image_ext_get = explode('.', $_FILES['image']['name']);
                                $image_ext = end($image_ext_get);
                                if (in_array($image_ext, ImageExtentionCheck())) {
                                    $image_name = imageUpload('image', 'user_image');
                                    $obj_user->attributes['image'] = $image_name;
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
                                    $image_name = imageUpload('adhar_card', 'user_adhar_card');
                                    $obj_user->attributes['adhar_card'] = $image_name;
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
                        $obj_user->attributes['password'] = $password;
                        $userID = $obj_user->insert($obj_user->attributes); 
                        ///////End Code
                        $_SESSION['successMsg'] = USER_SUCCESS_ADD_MESSAGE;
                        header("location:" . ADMIN_URL . "/users.php");
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
    if (isset($userId) && $userId != "" && ($action == "editUser" || $action == "viewUser")) {
        $users = $obj_user->selectByPk($userId);
        $users = (array) $users;
        extract($users);
    }
} elseif (isset($action) && trim($action) == "activateUser" && $userId != "") {
    $dataArr = array("is_active" => USER_ACTIVE);
    $obj_user->attributes = $dataArr;
    $obj_user->update($obj_user->attributes, "id=" . $userId);
    $_SESSION['successMsg'] = USER_SUCCESS_ACTIVATE_MESSAGE;
    header("location:" . ADMIN_URL . "/users.php");
    exit();
} elseif (isset($action) && $action == "deActivateUser" && $userId != "") {
    $dataArr = array("is_active" => USER_DEACTIVE);
    $obj_user->attributes = $dataArr;
    $obj_user->update($obj_user->attributes, "id=" . $userId);
    $_SESSION['successMsg'] = USER_SUCCESS_DEACTIVATE_MESSAGE;
    header("location:" . ADMIN_URL . "/users.php");
    exit();
} elseif (isset($action) && $action == "delete" && $userId != "") {
    $obj_user->delete("id=" . $userId);
    $_SESSION['successMsg'] = USER_SUCCESS_DELETE_MESSAGE;
    header("location:" . ADMIN_URL . "/users.php");
    exit();
} else {
    $data_users = $obj_user->select('');
}
?>