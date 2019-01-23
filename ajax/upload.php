<?php
// include('../db.class.php');
// $bdd = new db();
 
$acceptedExtension = Array('image/jpeg', 'image/jpg', 'image/pjpg', 'image/pjpeg', 'image/png', 'image/gif'); // add here allowed extensions
$maxSize = 5000000; //image size max = 5Mb
$destFolder = 'upload/';
 
echo '<div class="row">'; // Bootstrap CSS Thumbnails
for($i = 0; $i < $_POST['nbr_files']; $i++) { // Loop through each file
	
	$imgType = $_FILES["file_".$i]["type"];
	$imgSize = $_FILES["file_".$i]["size"];
	$imgName = $_FILES["file_".$i]["name"];
	$imgTmpName = $_FILES["file_".$i]["tmp_name"];
 
	if (in_array($imgType, $acceptedExtension) && $imgSize <= $maxSize && $imgSize != "") { // we test the validity of the image
 
		$randNbr = rand(1000000, 9999999); // Choose a random number between 1000000 and 9999999
		$newOriginalImageName = 'img-'.$randNbr.'.'.pathinfo($imgName, PATHINFO_EXTENSION); // Create a new file name including the random number, starting by img-
		$newThumbImageName = 'img-small-'.$randNbr.'.'.pathinfo($imgName, PATHINFO_EXTENSION); // Create a thumbnail name including the random number, starting by img-small-
 
		if(move_uploaded_file($imgTmpName,"../".$destFolder.$newOriginalImageName)) { // test if the original image is moved on the server
			
			copy("../".$destFolder.$newOriginalImageName, "../".$destFolder.$newThumbImageName); // we copy the origininal image and rename it (it will be our thumbnail)
			chmod ("../".$destFolder.$newThumbImageName, 0777); // we change the chmod so we can crop
					
			// we crop the photo
			list($width, $height, $type, $attr) = getimagesize("../".$destFolder.$newOriginalImageName); // we take the image height and width
			// the crop function is below
			if ($width>$height) { // if the image is landscape style
				crop_img ("../".$destFolder.$newThumbImageName, 160, 120); // we crop and resize 160x120px
			} else { // if the image is portrait style
				crop_img ("../".$destFolder.$newThumbImageName, 120, 160);// we crop and resize 120x160px
			}
			
			// we instert into database; the thumbnail path and the original path
			// $upload = $bdd->execute('INSERT INTO tc_tuto_upload_image (date_ins, hour_ins, img_thumb, img_original) VALUES (NOW(), NOW(), "'.$newThumbImageName.'", "'.$newOriginalImageName.'")');
			
			echo '<div class="col-xs-6 col-md-3"><a href="#" class="thumbnail"><img src="'.$destFolder.$newThumbImageName.'" alt="" /></a></div>'; // we send back the thumbnail - check Bootstrap for the CSS
		}
 
	} else {
		echo '<div class="col-xs-6 col-md-3"><a href="#" class="thumbnail">Error with your image (wrong format or size)!</a></div>';
	}
 
}
echo '</div>';
 
// crop function (feel free to adapt)
function crop_img ($image, $thumb_width, $thumb_height) {
	$filename = $image;
	$image = imagecreatefromstring(file_get_contents("$image"));
 
	$width = imagesx($image);
	$height = imagesy($image);
 
	$original_aspect = $width / $height;
	$thumb_aspect = $thumb_width / $thumb_height;
 
	if ( $original_aspect >= $thumb_aspect ) {
	   // If image is wider than thumbnail (in aspect ratio sense)
	   $new_height = $thumb_height;
	   $new_width = $width / ($height / $thumb_height);
	} else {
	   // If the thumbnail is wider than the image
	   $new_width = $thumb_width;
	   $new_height = $height / ($width / $thumb_width);
	}
 
	$thumb = imagecreatetruecolor($thumb_width, $thumb_height);
 
	// Resize and crop
	imagecopyresampled($thumb,
		$image,
		0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
		0 - ($new_height - $thumb_height) / 2, // Center the image vertically
		0, 0,
		$new_width, $new_height,
		$width, $height);
	
	return imagejpeg($thumb, $filename, 80);
}
?>