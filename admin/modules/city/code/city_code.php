
<?php

# Coder Vikram solanki


$currentTimestamp = getCurrentTimestamp();
$obj_city = new cityModel();


if (isset($cityId))
    $cityId = decode($cityId);

if (isset($action) && trim($action) == "submitForm") {
    if (isset($actionType) && $actionType == CITY_ACTIVE) {
        $dataArr = array("is_active" => CITY_ACTIVE);
        $obj_city->attributes = $dataArr;
        $obj_city->updateAllByPk($chk, $obj_city->attributes, "id");
        $_SESSION['successMsg'] = CITY_ALL_SUCCESS_ACTIVATE_MESSAGE;
        header("location:" . ADMIN_URL . "/city.php");
        exit();
    } elseif (isset($actionType) && $actionType == CITY_DEACTIVE) {
        $dataArr = array("is_active" => CITY_DEACTIVE);
        $obj_city->attributes = $dataArr;
        $obj_city->updateAllByPk($chk, $obj_city->attributes, "id");
        $_SESSION['successMsg'] = CITY_ALL_SUCCESS_DEACTIVATE_MESSAGE;
        header("location:" . ADMIN_URL . "/city.php");
        exit();
    } elseif (isset($actionType) && $actionType == CITY_DELETE) {
        $obj_city->deleteAllByPk_status($chk, "id");
        $_SESSION['successMsg'] = CITY_ALL_SUCCESS_DELETE_MESSAGE;
        header("location:" . ADMIN_URL . "/city.php");
        exit();
    }
} elseif (isset($action) && ($action == "editCity" || $action == "addCity")) {
    if (isset($submitCity) && $submitCity != "") {
        unset($_POST['submitCity']);
        if (isset($cityID) && $cityID != "" && $action == "editCity") {
             $_POST = $obj_city->cleanArray($_POST);
            $imageDetail = $obj_city->selectByPk($cityID, '', 'city_img'); 
            $_POST['modification_date'] = $currentTimestamp;
            $obj_city->attributes = $_POST;
             //For update product image
            if (isset($_FILES['city_img']['name']) && $_FILES['city_img']['error'] == 0) {
                $product_image_ext_get = explode('.', $_FILES['city_img']['name']);
                $product_image_ext = end($product_image_ext_get);
                if (in_array($product_image_ext, ImageExtentionCheck())) {
                    if (isset($_FILES['city_img']['name'])) {
                        if (!empty($imageDetail->city_img)) {
                            $removeCityImg = UPLOAD_DIR . '/city_image/' . $imageDetail->city_img;
                            if (file_exists($removeCityImg)) {
                                unlinkImage($removeCityImg);
                            }
                        }
                        $cityImageName = imageUpload('city_img', 'city_image');
                        $obj_city->attributes['image'] = $cityImageName;
                    }
                }
            }
            // Delete product images  
            $obj_city->update($obj_city->attributes, "id=" . $cityID);  
            $_SESSION['successMsg'] = CITY_SUCCESS_UPDATE_MESSAGE;
            header("location:" . ADMIN_URL . "/city.php");
            exit();
        } elseif ($action == "addCity") {
           
            $obj_city->attributes = $_POST; 
              if (isset($_FILES['city_img']['name']) && $_FILES['city_img']['error'] == 0) {
                $city_image_ext_get = explode('.', $_FILES['city_img']['name']);
                $city_image_ext = end($city_image_ext_get);
                if (in_array($city_image_ext, ImageExtentionCheck())) {
                    if (isset($_FILES['city_img']['name'])) { 
                        $cityImageName = imageUpload('city_img', 'city_image');
                        $obj_city->attributes['image'] = $cityImageName;
                    }
                }
            }
            $last_cityID = $obj_city->insert($obj_city->attributes); 
            $_SESSION['successMsg'] = CITY_SUCCESS_ADD_MESSAGE;
            header("location:" . ADMIN_URL . "/city.php");
            exit();
        }
    }
    if (isset($cityId) && $cityId != "" && $action == "editCity") {
        $city = $obj_city->selectByPk($cityId);
        $city = (array) $city;
        extract($city);
    }
} elseif (isset($action) && trim($action) == "activateCity" && $cityId != "") {
    $dataArr = array("is_active" => CITY_ACTIVE);
    $obj_city->attributes = $dataArr;
    $obj_city->update($obj_city->attributes, "id=" . $cityId);
    $_SESSION['successMsg'] = CITY_SUCCESS_ACTIVATE_MESSAGE;
    header("location:" . ADMIN_URL . "/city.php");
    exit();
} elseif (isset($action) && $action == "deActivateCity" && $cityId != "") {
    $dataArr = array("is_active" => CITY_DEACTIVE);
    $obj_city->attributes = $dataArr;
    $obj_city->update($obj_city->attributes, "id=" . $cityId);
    $_SESSION['successMsg'] = CITY_SUCCESS_DEACTIVATE_MESSAGE;
    header("location:" . ADMIN_URL . "/city.php");
    exit();
} elseif (isset($action) && $action == "delete" && $cityId != "") {
   // $obj_city->delete("id=" . $cityId);
     $cityArray = array('is_delete' => 1);
    $obj_city->update($cityArray, "id=" . $cityId);
    $_SESSION['successMsg'] = CITY_SUCCESS_DELETE_MESSAGE;
    header("location:" . ADMIN_URL . "/city.php");
    exit();
} else {
    $data_city = $obj_city->select();
}
?>