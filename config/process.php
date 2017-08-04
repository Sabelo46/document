<?php
	session_start();
 	if(isset($_POST['submit']))
 	{
 		$check = mysqli_connect("localhost","root","",'doc_db');
 		$firstname = $_POST['firstname'];
 		$lastname = $_POST['lastname'];
 		echo $firstname.' '.$lastname;
 		$query = mysqli_query($check,"INSERT INTO user(lastname,firstname) VALUES ('$lastname','$firstname')");
 		if($query)
 		{
 			 $last_id = mysqli_insert_id($check);
 			$_SESSION["firstname"] = $firstname;
 			$_SESSION['id']=$last_id;
 			header("location:../document.php");
 		}
 		else
 		{
 			
 		}
 	}
 	
 	if(isset($_POST['sub']))
 	{
 		$target_dir = "../uploads/";
	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	$uploadOk = 1;
	$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
 		$check = mysqli_connect("localhost","root","",'doc_db');
		
		// $che = getimagesize($_FILES["file"]["tmp_name"]);
		// if($che !== false) 
		// 	{
	 //        echo "File is a document - " . $che["mime"] . ".";
	 //        $uploadOk = 1;
		// 	 } 
		// else {
	 //        echo "File is not a document.";
	 //        $uploadOk = 0;
		//     }
			 // Check if file already exists
			if (file_exists($target_file)) {
			    $error = "Sorry, file already exists.";
			    $uploadOk = 0;
			     header("location:../document.php?error=$error");
			}
						// Check file size
			if ($_FILES["file"]["size"] > 600000) {
			    $error =  "Sorry, your file is too large.";
			    $uploadOk = 0;
			     header("location:../document.php?error=$error");
			}
			// Allow certain file formats
			if($fileType != "pdf" && $fileType != "png" && $fileType != "avi"
			&& $fileType != "map" && $fileType != "csv" && $fileType != "mac" 
			&& $fileType != "doc" && $fileType != "docm" && $fileType != "dotx" ) 
			{
			    $error =  "Sorry, only PDF,  AVI, CSV, PNG, MAP, MAC, DOC, DOTX and DOTM files are allowed.";
			    $uploadOk = 0;
			    header("location:../document.php?error=$error");
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			     $error = "Sorry, your file was not uploaded.";
			    header("location:../document.php?error=$error");
			// if everything is ok, try to upload file
			} 
			 else {
				    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))
				     {
				        $success =  "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
				        $title = $_POST['title'];
				 		$description = $_POST['description'];
				 		$ok =  $_FILES["file"]["name"];
				 		$id =  $_SESSION["id"];
				 		$query = mysqli_query($check,"INSERT INTO doc_tb(id,user_id,title,description,file)
				 			VALUES (NULL,'$id','$title','$description','$ok')");
				 		if($query)
				 		{
				 			header("location:../document.php?success=$success");
				 		}
				 		else
				 		{
				 			echo "dedn";
				 		}
				  	  } 
				  	  else
				  	  {
				        $error = "Sorry, there was an error uploading your file.";
				        header("location:../document.php?error=$error");
				   	  }
				}
		
 	}
 ?>
