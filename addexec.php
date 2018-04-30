<?php
	include('connect.php');
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		// Check if file was uploaded without errors
		if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
			$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
			$filename = $_FILES["photo"]["name"];
			$filetype = $_FILES["photo"]["type"];
			$filesize = $_FILES["photo"]["size"];
	
			// Verify file extension
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
	
			// Verify file size - 5MB maximum
			$maxsize = 5 * 1024 * 1024;	
			if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

			// Verify MYME type of the file
			if(in_array($filetype, $allowed)){
				// Check whether file exists before uploading it
				if(file_exists("photos/" . $_FILES["photo"]["name"])){
					echo $_FILES["photo"]["name"] . " is already exists.";
				}
				else {
					move_uploaded_file($_FILES["photo"]["tmp_name"], "photos/" . $_FILES["photo"]["name"]);
				} 
			}
			else {
				echo "Error: There was a problem uploading your file. Please try again."; 
			}
		}
		else {
			echo "Error: " . $_FILES["photo"]["error"];
		}
		//add image location and info to database
		$location = "photos/" . $filename;
		$caption = $_POST['caption'];
		$trail = $_POST['trail'];
		$date = date("F dS, Y");
		$sql = "INSERT INTO photos (location, caption, date, trail) VALUES ('" . $location . "', '" . $caption . "', '" . $date . "', '" . $trail ."')";
		$result = mysqli_query($connect, $sql);
		//redirect to upload if failed or gallery if successful
		if(!$result) {
			header("location: upload.php");
		}
		else {
			header("location: gallery.php");
		}
		exit();	
	}
?>
