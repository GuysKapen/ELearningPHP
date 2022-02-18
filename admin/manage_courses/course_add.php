<?php

// in this file --> code for add a new course ,update a course and delete a course by admin from manage_courses.php

session_start();

include("../inc/connect.php");

// ==========================================================================================

// code to add a new course by admin from manage_courses.php

if (isset($_POST['btn_add'])) {
	$language_name = $_POST['course_name'];
	$language_img = $_FILES['course_image'];
	$language_desc = $_POST['course_desc'];

	$file_name = $language_img['name'];
	$file_error = $language_img['error'];
	$file_tmp = $language_img['tmp_name'];


	$file_ext = explode('.', $file_name);
	$file_check = strtolower(end($file_ext));

	$file_ext_stored = array('png', 'jpg', 'jpeg');


	if (in_array($file_check, $file_ext_stored)) {
		$destination_file = 'upload_imgs/' . $file_name;
		move_uploaded_file($file_tmp, '/opt/lampp/htdocs/ELearning/upload_imgs/' . $file_name);

		$q = $con->prepare("insert into programming_languages(language_name,language_image,language_description) values(:language_name, :destination_file, :language_desc)");
		$q->bindParam("language_name", $language_name);
		$q->bindParam("destination_file", $destination_file);
		$q->bindParam("language_desc", $language_desc);
		$r = $q->execute();
		if ($r == true) {
			header("location:manage_courses.php?status=added");
		}
	}
}


// ============================================================================================

// code to add a new course by admin from manage_courses.php

if (isset($_POST['btn-delete-course'])) {

	$course_name = $_POST['selected_course'];
	$q = $con->prepare("DELETE FROM programming_languages WHERE language_name=:course_name");
	$q->bindParam("course_name", $course_name);
	$r = $q->execute();
	if ($r) {
		header("location:manage_courses.php?status=deleted");
	}
}


// ==============================================================================
// code to update course by admin from manage_courses.php


if (isset($_POST['btn_update'])) {
	$language_name = $_POST['selected-course-to-update'];
	$language_img = $_FILES['course_image'];
	$language_desc = $_POST['course_desc'];

	$file_name = $language_img['name'];
	$file_error = $language_img['error'];
	$file_tmp = $language_img['tmp_name'];


	$file_ext = explode('.', $file_name);
	$file_check = strtolower(end($file_ext));

	$file_ext_stored = array('png', 'jpg', 'jpeg');

	if (in_array($file_check, $file_ext_stored)) {
		$destination_file = 'uploadimg/' . $file_name;
		move_uploaded_file($file_tmp, $destination_file);

		$q = $con->prepare("UPDATE programming_languages SET language_image=:destination_file,language_description=:language_desc WHERE language_name=:language_name");
		$q->bindParam("destination_file", $destination_file);
		$q->bindParam("language_desc", $language_desc);
		$q->bindParam("language_name", $language_name);
		$r = $q->execute();

		if ($r == true) {
			header("location:manage_courses.php?status=updated");
		}
	}
}



// =====================================================================================================================================
// ========================================================================================================================
// in this section add videos ,update videos and delete videos is going on from manage_videos.php


// if (isset($_POST['btn_add'])) {
// 	$coursename = $_POST['course_name'];
// 	$courseimg = $_FILES['course_image'];
// 	$coursedesc = $_POST['course_desc'];

// 	$filename = $courseimg['name'];
// 	print_r($courseimg);
// 	$fileerror = $courseimg['error'];
// 	$filetmp = $courseimg['tmp_name'];


// 	$fileext = explode('.', $filename);
// 	$filecheck = strtolower(end($fileext));

// 	$fileextstored = array('png', 'jpg', 'jpeg');

// 	if (in_array($filecheck, $fileextstored)) {
// 		$destinationfile = '../../upload_imgs/' . $filename;
// 		move_uploaded_file($filetmp, $destinationfile);

// 		$q = "insert into programming_languages(image,description,course_name) values('$destinationfile','$coursedesc','$coursename')";
// 		$r = mysqli_query($con, $q);

// 		if ($r == true) {
// 			header("location:manage_courses.php?status=added");
// 		}
// 	}
// }
