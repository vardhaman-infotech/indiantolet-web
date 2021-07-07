<?php
require_once("../../../../app/conf/config.inc.php"); 
 
$obj_propertyAmenites = new propertyamenitiesModel();

if(isset($_POST) && !empty($_POST)){
      $PropertyAmenities_id= $_POST['id'];
      $status = $_POST['status'];
     
    $updatePropertyAmenities = array('amenities_status'=>$status);
   // print_r($updatePropertyAmenities);
    $obj_propertyAmenites->update($updatePropertyAmenities, 'property_amenities_id='.$PropertyAmenities_id);
    echo $status;
}

?>