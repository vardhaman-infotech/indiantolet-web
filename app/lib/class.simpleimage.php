<?php

class SimpleImage {

	 var $image;
	 var $image_type;
	 var $maxsize = 524288;

	 function load($filename) {
                    
		  $image_info = getimagesize($filename);
             
                  $this->image_type = $image_info[2];
		  if ($this->image_type == IMAGETYPE_JPEG) {
                        $this->image = imagecreatefromjpeg($filename);
		  } elseif ($this->image_type == IMAGETYPE_GIF) {

			   $this->image = imagecreatefromgif($filename);
		  } elseif ($this->image_type == IMAGETYPE_PNG) {

			   $this->image = imagecreatefrompng($filename);
		  }
	 }

	 function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 75, $permissions = null) {

		  if ($image_type == IMAGETYPE_JPEG) {
			   imagejpeg($this->image, $filename, $compression);
		  } elseif ($image_type == IMAGETYPE_GIF) {

			   imagegif($this->image, $filename);
		  } elseif ($image_type == IMAGETYPE_PNG) {

			   imagepng($this->image, $filename);
		  }
		  if ($permissions != null) {

			   chmod($filename, $permissions);
		  }
	 }

	 function savePng($filename, $image_type = IMAGETYPE_JPEG, $compression = 75, $permissions = null) {
		  imagepng($this->image, $filename);
	 }

	 function output($image_type = IMAGETYPE_JPEG) {

		  if ($image_type == IMAGETYPE_JPEG) {
			   imagejpeg($this->image);
		  } elseif ($image_type == IMAGETYPE_GIF) {

			   imagegif($this->image);
		  } elseif ($image_type == IMAGETYPE_PNG) {

			   imagepng($this->image);
		  }
	 }

	 function getWidth() {

		  return imagesx($this->image);
	 }

	 function getHeight() {

		  return imagesy($this->image);
	 }

	 function resizeToHeight($height) {

		  $ratio = $height / $this->getHeight();
		  $width = $this->getWidth() * $ratio;
		  $this->resize($width, $height);
	 }

	 function resizeToWidth($width) {
		  $ratio = $width / $this->getWidth();
		  $height = $this->getheight() * $ratio;
		  $this->resize($width, $height);
	 }

	 function resizeToWidthPng($width) {
		  $ratio = $width / $this->getWidth();
		  $height = $this->getheight() * $ratio;
		  $this->resizePng($width, $height);
	 }

	 function scale($scale) {
		  $width = $this->getWidth() * $scale / 100;
		  $height = $this->getheight() * $scale / 100;
		  $this->resize($width, $height);
	 }

	 function resize($width, $height) {
		  $new_image = imagecreatetruecolor($width, $height);
		  imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
		  $this->image = $new_image;
	 }

	 function resizePng($width, $height) {
		  $new_image = imagecreatetruecolor($width, $height);
		  imagecolortransparent($new_image, imagecolorallocatealpha($new_image, 255, 255, 255, 127));
		  imagealphablending($new_image, false);
		  imagesavealpha($new_image, true);
		  imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
		  $this->image = $new_image;
	 }

	 function getfilename($filename) {
		  $filename = trim(strtolower(str_replace("#", "", (str_replace(" ", "", stripslashes($filename))))));
		  return $filename;
	 }

	 function getImageExtention($filename) {
		  $i = strrpos($filename, ".");
		  if (!$i) {
			   return "";
		  }

		  $l = strlen($filename) - $i;
		  $ext = strtolower(substr($filename, $i + 1, $l));
		  return $ext;
	 }

	 function checkImageExtentionSize($ext, $filename, $filesize) {
		  $len = strlen($filename);
		  if (($ext != "jpg") && ($ext != "jpeg") && ($ext != "png") && ($ext != "gif") || ( $len > 255 || $filesize > $this->maxsize))
			   return TRUE;
		  else
			   return FALSE;
	 }

	 function checkImageExtention($filename) {
		  $ext = $this->getImageExtention($imageFilename);
		  if (($ext != "jpg") && ($ext != "jpeg"))
			   return TRUE;
		  else
			   return FALSE;
	 }

	 function getLanguageInfo($imageFilename, $refilename, $file_size, $dirname) {
		  $filename = $this->getfilename($refilename);
		  $extension = $this->getImageExtention($imageFilename);
		  $err = $this->checkImageExtentionSize($extension, $filename, $file_size);
		  $path = $dirname . $filename . "." . $extension;
		  $filename.="." . $extension;
		  $result = array('filename' => $filename,
			  'extension' => $extension,
			  'err' => $err,
			  'path' => $path
		  );
		  return $result;
	 }

	 /* ===========   Function for getting unique and resiged product image =========== */

	 function getResizeAndUniqueProductImg($imgName, $imgTempName, $target_path, $width, $height) {
		  $imageName = uniqid("", TRUE) . $imgName;
		  $imageName = str_replace("#", "", $imageName);
		  $imageName = str_replace("_", "", $imageName);
		  $fromPath = $imgTempName;
		  $this->load($fromPath);
		  $this->resize($width, $height);
		  $this->save($fromPath);
		  move_uploaded_file($imgTempName, $target_path . $imageName);
		  return $imageName;
	 }

	 function getResizeAndLargeUniqueProductImg($imgName, $imgTempName, $target_path, $width, $height) {
		  $imageName = uniqid("", TRUE) . $imgName;
		  $imageName = str_replace("#", "", $imageName);
		  $imageName = str_replace("_", "", $imageName);
		  $fromPath = $imgTempName;
		  $largeTarget_path = INV_ROOT . "/productImage/large/";
		  $largeTarget_path = $largeTarget_path . $imageName;
		  $this->load($fromPath);
		  $this->resizeToWidth(700);
		  $this->save($fromPath);

		  copy($fromPath, $largeTarget_path);
		  $this->load($fromPath);
		  $this->resize($width, $height);
		  $this->save($fromPath);
		  move_uploaded_file($imgTempName, $target_path . $imageName);
		  return $imageName;
	 }

	 function getResizeImg($imgName, $imgTempName, $target_path, $width, $height) {
		  $imageName = str_replace("#", "", $imgName);
		  $imageName = str_replace("_", "", $imageName);
		  $imageName = str_replace(" ", "", $imageName);
		  $fromPath = $imgTempName;
		  
		  $largeTarget_path = INV_ROOT . "/upload/album_image/";
		  $largeTarget_path = $largeTarget_path . $imageName;
		  
		  $this->load($fromPath);
		  $this->resize(150, 200);
		  $this->save($fromPath);
		  
		  copy($fromPath, $largeTarget_path);
		 
		  $this->load($fromPath);
		  $this->resize($width, $height);
		  $this->save($fromPath);

		  move_uploaded_file($imgTempName, $target_path . $imageName);

		  return $imageName;
	 }
         	 function getResizeUserSignImg($imgName, $imgTempName, $target_path, $width, $height) {
		  $imageName = str_replace("#", "", $imgName);
		  $imageName = str_replace("_", "", $imageName);
		  $imageName = str_replace(" ", "", $imageName);
		  $fromPath = $imgTempName;

		  $largeTarget_path = INV_ROOT . "/upload/userSign/";
		  $largeTarget_path = $largeTarget_path . $imageName;

		  $this->load($fromPath);
		  $this->resize(150, 200);
		  $this->save($fromPath);

		  copy($fromPath, $largeTarget_path);

		  $this->load($fromPath);
		  $this->resize($width, $height);
		  $this->save($fromPath);

		  move_uploaded_file($imgTempName, $target_path . $imageName);

		  return $imageName;
	 }
          function getResizeVideoImg($imgName, $imgTempName, $target_path, $width, $height) {
		  $imageName = str_replace("#", "", $imgName);
		  $imageName = str_replace("_", "", $imageName);
		  $imageName = str_replace(" ", "", $imageName);
		  $fromPath = $imgTempName;

		  $largeTarget_path = INV_ROOT . "/upload/video_image/";
		  $largeTarget_path = $largeTarget_path . $imageName;

		  $this->load($fromPath);
		  $this->resize(150, 200);
		  $this->save($fromPath);

		  copy($fromPath, $largeTarget_path);

		  $this->load($fromPath);
		  $this->resize($width, $height);
		  $this->save($fromPath);

		  move_uploaded_file($imgTempName, $target_path . $imageName);

		  return $imageName;
	 }

	 
	 function getResizeProductImage($imgName, $imgTempName, $target_path, $width) {
		  $imageName = str_replace("#", "", $imgName);
		  $imageName = str_replace("_", "", $imageName);
		  $fromPath = $imgTempName;
		  $this->load($fromPath);
		  $this->resizeToWidth($width);
		  $this->save($fromPath);
		  move_uploaded_file($imgTempName, $target_path . $imageName);
		  return $imageName;
	 }

	 /* =================  Get PNG Resized Images With Transparant Background  ==================== */

	 function getPngResizeImageWidth($imgName, $imgTempName, $target_path, $width) {
		  $imageName = str_replace("#", "", $imgName);
		  $imageName = str_replace("_", "", $imageName);
		  $fromPath = $imgTempName;
		  $this->load($fromPath);
		  $this->resizeToWidthPng($width);
		  $this->savePng($fromPath);
		  move_uploaded_file($imgTempName, $target_path . $imageName);
		  return $imageName;
	 }

	 function getPngResizeImage($imgName, $imgTempName, $target_path, $width, $height) {
		  $imageName = str_replace("#", "", $imgName);
		  $imageName = str_replace("_", "", $imageName);
		  $imageName = str_replace(" ", "", $imageName);
		  $fromPath = $imgTempName;

		  $this->load($fromPath);
		  $this->resizePng($width, $height);
		  $this->savePng($fromPath);
		  move_uploaded_file($imgTempName, $target_path . $imageName);

		  return $imageName;
	 }

}

?>
