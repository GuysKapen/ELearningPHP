<?php

// in this file --> code for add a new course ,update a course and delete a course by admin from manage_courses.php

session_start();

include("../connect.php");

// ==========================================================================================

// code to add a new course by admin from manage_courses.php

if (isset($_POST['add_course'])) {
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
			echo "<script>alert('Add course successfully!');</script>";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
		} else {
			echo "<script>alert('Add course Failed!');</script>";
			echo "<script>window.open('/index.php?course', '_self')</script>";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
		}
	}
}


// ============================================================================================

// code to add a new course by admin from manage_courses.php

if (isset($_POST['del_course'])) {
	$course_name = $_POST['selected_course'];
	$q = $con->prepare("DELETE FROM programming_languages WHERE language_name=:course_name");
	$q->bindParam("course_name", $course_name);
	$r = $q->execute();
	if ($r == true) {
		echo "<script>alert('Delete course successfully!');</script>";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
	} else {
		echo "<script>alert('Delete course Failed!');</script>";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
	}
}


if (isset($_POST['del_course_id'])) {
	$course_id = $_POST['course_id'];
	$q = $con->prepare("DELETE FROM programming_languages WHERE id=:course_id");
	$q->bindParam("course_id", $course_id);
	$r = $q->execute();
	if ($r == true) {
		echo "<script>alert('Delete course successfully!');</script>";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
	} else {
		echo "<script>alert('Delete course Failed!');</script>";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
	}
}


// ==============================================================================
// code to update course by admin from manage_courses.php


if (isset($_POST['update_course'])) {
	$language_name = $_POST['selected_course'];
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
			echo "<script>alert('Add course successfully!');</script>";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
		} else {
			echo "<script>alert('Add course Failed!');</script>";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
		}
	}
}








// =============================================================================================================

// add a new topic in the courses table (request came from add_new_topic.php)

if (isset($_POST['add_topic'])) {


	$topic_name = $_POST['topic_name'];
	$course_name = $_POST['coursename'];
	$description = ($_POST['editor']);

	$q = $con->prepare("INSERT INTO `courses`( `topic_name`, `description`, `course_name`) VALUES (:topic_name, :description, :course_name)");
	$q->bindParam("topic_name", $topic_name);
	$q->bindParam("course_name", $course_name);
	$q->bindParam("description", $description);
	$r = $q->execute();

	if ($r == true) {
		echo "<script>alert('Add course successfully!');</script>";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
	} else {
		echo "<script>alert('Add course Failed!');</script>";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
	}
}


// =============================================================================================================

// update a topic in the courses table (request came from update_topic.php)


if (isset($_POST['update_topic'])) {

	$course_id = $_POST['course_id'];
	$course_name = $_POST['coursename'];
	$topic_name = $_POST['topic_name'];
	$description = $_POST['editor'];

	$q = $con->prepare("UPDATE `course_topics` SET `topic_name`=:topic_name,`description`=:description,`course_name`=:course_name WHERE course_id=:course_id");
	$q->bindParam("topic_name", $topic_name);
	$q->bindParam("course_name", $course_name);
	$q->bindParam("description", $description);
	$r = $q->execute();

	if ($r) {
		header("location:../edit_topics.php?course_name=" . $course_name);
	} else {
		echo "something went wrong";
	}
}
