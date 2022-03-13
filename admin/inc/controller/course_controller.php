<?php

// in this file --> code for add a new course ,update a course and delete a course by admin from manage_courses.php

session_start();

include("../connect.php");

// ==========================================================================================

// code to add a new course by admin from manage_courses.php

if (isset($_POST['add_course'])) {
	$course_name = $_POST['course_name'];
	$course_img = $_FILES['course_image'];
	$course_desc = $_POST['course_desc'];

	$file_name = $course_img['name'];
	$file_error = $course_img['error'];
	$file_tmp = $course_img['tmp_name'];


	$file_ext = explode('.', $file_name);
	$file_check = strtolower(end($file_ext));

	$file_ext_stored = array('png', 'jpg', 'jpeg');

	if (in_array($file_check, $file_ext_stored)) {
		$destination_file = 'upload_imgs/' . $file_name;
		move_uploaded_file($file_tmp, '/opt/lampp/htdocs/ELearning/upload_imgs/' . $file_name);

		$q = $con->prepare("insert into courses(course_name,course_image,course_description) values(:course_name, :destination_file, :course_desc)");
		$q->bindParam("course_name", $course_name);
		$q->bindParam("destination_file", $destination_file);
		$q->bindParam("course_desc", $course_desc);
		$r = $q->execute();

		if (isset($_POST['cat_id'])) {
			$category_id = $_POST['cat_id'];
			$course_id = $con->lastInsertId();
			$q = $con->prepare("insert into course_categories values(:course_id, :category_id)");
			$q->bindParam("course_id", $course_id);
			$q->bindParam("category_id", $category_id);
			$q->execute();
		}

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
	$q = $con->prepare("DELETE FROM courses WHERE course_name=:course_name");
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
	$q = $con->prepare("DELETE FROM courses WHERE id=:course_id");
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
	$course_id = $_POST['selected_course'];
	$course_img = $_FILES['course_image'];
	$course_desc = $_POST['course_desc'];

	$file_name = $course_img['name'];
	$file_error = $course_img['error'];
	$file_tmp = $course_img['tmp_name'];


	$file_ext = explode('.', $file_name);
	$file_check = strtolower(end($file_ext));

	$file_ext_stored = array('png', 'jpg', 'jpeg');

	if (in_array($file_check, $file_ext_stored)) {
		$destination_file = 'upload_imgs/' . $file_name;
		move_uploaded_file($file_tmp, '/opt/lampp/htdocs/ELearning/upload_imgs/' . $file_name);

		$q = $con->prepare("UPDATE courses SET course_image=:destination_file,course_description=:course_desc WHERE course_id=:course_id");
		$q->bindParam("destination_file", $destination_file);
		$q->bindParam("course_desc", $course_desc);
		$q->bindParam("course_id", $course_id);
		$r = $q->execute();

		if (isset($_POST['cat_id'])) {
			$category_id = $_POST['cat_id'];
			$q = $con->prepare("update course_categories set category_id=:category_id where course_id=:course_id");
			$q->bindParam("course_id", $course_id);
			$q->bindParam("category_id", $category_id);
			$q->execute();
		}

		if ($r == true) {
			echo "<script>alert('Update course successfully!');</script>";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
		} else {
			echo "<script>alert('Update course Failed!');</script>";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
		}
	}
}








// =============================================================================================================

// add a new topic in the courses table (request came from add_new_topic.php)

if (isset($_POST['add_topic'])) {


	$topic_name = $_POST['topic_name'];
	$course_id = $_POST['course_id'];
	$description = $_POST['editor'];

	$q = $con->prepare("INSERT INTO `course_topics`( `topic_name`, `description`, `course_id`) VALUES (:topic_name, :description, :course_id)");
	$q->bindParam("topic_name", $topic_name);
	$q->bindParam("course_id", $course_id);
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
	$id = $_POST['id'];
	$topic_name = $_POST['topic_name'];
	$description = $_POST['editor'];

	$q = $con->prepare("UPDATE `course_topics` SET `topic_name`=:topic_name,`description`=:description WHERE id=:id");
	$q->bindParam("topic_name", $topic_name);
	$q->bindParam("description", $description);
	$q->bindParam("id", $id);
	$r = $q->execute();
	if ($r) {
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?edit_course=' . $course_id);
	} else {
		echo "something went wrong";
	}
}


if (isset($_POST['del_topic'])) {
	$topic_id = $_POST['topic_id'];
	$q = $con->prepare("DELETE FROM course_topic WHERE id=:topic_id");
	$q->bindParam("topic_id", $topic_id);
	$r = $q->execute();
	if ($r == true) {
		echo "<script>alert('Delete course successfully!');</script>";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
	} else {
		echo "<script>alert('Delete course Failed!');</script>";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
	}
}


if (isset($_POST['add_course_video'])) {
	$course_name = $_POST['course_name'];
	$course_img = $_FILES['course_image'];
	$course_desc = $_POST['course_desc'];

	$file_name = $course_img['name'];
	$file_error = $course_img['error'];
	$file_tmp = $course_img['tmp_name'];


	$file_ext = explode('.', $file_name);
	$file_check = strtolower(end($file_ext));

	$file_ext_stored = array('png', 'jpg', 'jpeg');


	if (in_array($file_check, $file_ext_stored)) {
		$destination_file = 'upload_imgs/' . $file_name;
		move_uploaded_file($file_tmp, '/opt/lampp/htdocs/ELearning/upload_imgs/' . $file_name);

		$q = $con->prepare("insert into course_videos(course_name,course_image,course_description) values(:course_name, :destination_file, :course_desc)");
		$q->bindParam("course_name", $course_name);
		$q->bindParam("destination_file", $destination_file);
		$q->bindParam("course_desc", $course_desc);
		$r = $q->execute();
		if ($r == true) {
			echo "<script>alert('Add course successfully!');</script>";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course_video');
		} else {
			echo "<script>alert('Add course Failed!');</script>";
			echo "<script>window.open('/index.php?course', '_self')</script>";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course_video');
		}
	}
}


if (isset($_POST['update_course_video'])) {
	$course_name = $_POST['selected_course'];
	$course_img = $_FILES['course_image'];
	$course_desc = $_POST['course_desc'];

	$file_name = $course_img['name'];
	$file_error = $course_img['error'];
	$file_tmp = $course_img['tmp_name'];


	$file_ext = explode('.', $file_name);
	$file_check = strtolower(end($file_ext));

	$file_ext_stored = array('png', 'jpg', 'jpeg');

	if (in_array($file_check, $file_ext_stored)) {
		$destination_file = 'upload_imgs/' . $file_name;
		move_uploaded_file($file_tmp, '/opt/lampp/htdocs/ELearning/upload_imgs/' . $file_name);

		$q = $con->prepare("UPDATE course_videos SET course_image=:destination_file,course_description=:course_desc WHERE course_name=:course_name");
		$q->bindParam("destination_file", $destination_file);
		$q->bindParam("course_desc", $course_desc);
		$q->bindParam("course_name", $course_name);
		$r = $q->execute();

		if ($r == true) {
			echo "<script>alert('Update course successfully!');</script>";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course_video');
		} else {
			echo "<script>alert('Update course Failed!');</script>";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course_video');
		}
	}
}


if (isset($_POST['del_course_video'])) {
	$course_id = $_POST['course_id'];
	$q = $con->prepare("DELETE FROM course_videos WHERE id=:course_id");
	$q->bindParam("course_id", $course_id);
	$r = $q->execute();
	if ($r == true) {
		echo "<script>alert('Delete course successfully!');</script>";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course_video');
	} else {
		echo "<script>alert('Delete course Failed!');</script>";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course_video');
	}
}


if (isset($_POST['add_video_topic'])) {


	$topic_name = $_POST['topic_name'];
	$course_id = $_POST['course_id'];
	$video_path = $_POST['video'];

	$topic_img = $_FILES['topic_image'];

	$file_name = $topic_img['name'];
	$file_error = $topic_img['error'];
	$file_tmp = $topic_img['tmp_name'];


	$file_ext = explode('.', $file_name);
	$file_check = strtolower(end($file_ext));

	$file_ext_stored = array('png', 'jpg', 'jpeg');

	if (in_array($file_check, $file_ext_stored)) {
		$destination_file = 'upload_imgs/' . $file_name;
		move_uploaded_file($file_tmp, '/opt/lampp/htdocs/ELearning/upload_imgs/' . $file_name);

		$q = $con->prepare("INSERT INTO `course_video_topics`( `topic_name`, `topic_image`, `video_path`, `course_id`) VALUES (:topic_name, :topic_image, :video_path, :course_id)");
		$q->bindParam("topic_name", $topic_name);
		$q->bindParam("course_id", $course_id);
		$q->bindParam("topic_image", $destination_file);
		$q->bindParam("video_path", $video_path);
		$r = $q->execute();

		if ($r == true) {
			echo "<script>alert('Add course successfully!');</script>";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?edit_course_video=' . $course_id);
		} else {
			echo "<script>alert('Add course Failed!');</script>";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?edit_course_video=' . $course_id);
		}
	}
}
