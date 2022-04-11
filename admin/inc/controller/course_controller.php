<?php

// in this file --> code for add a new course ,update a course and delete a course by admin from manage_courses.php

session_start();

include("../connect.php");
include("../utils.php");

function get_course_video($course_id)
{
	include("../connect.php");
	$query = $con->prepare("select * from course_videos where id=:course_id");
	$query->bindParam("course_id", $course_id);
	$query->setFetchMode(PDO::FETCH_ASSOC);
	$query->execute();

	$row = $query->fetch();
	$con = null;
	return $row;
}

function get_course($course_id)
{
	include("../connect.php");
	$query = $con->prepare("select * from courses where id=:course_id");
	$query->bindParam("course_id", $course_id);
	$query->setFetchMode(PDO::FETCH_ASSOC);
	$query->execute();

	$row = $query->fetch();
	$con = null;
	return $row;
}
// ==========================================================================================

// code to add a new course by admin from manage_courses.php

if (isset($_POST['add_course'])) {
	$course_name = $_POST['course_name'];
	$course_img = $_FILES['course_image'];
	$course_desc = $_POST['course_desc'];
	$course_lang_id = $_POST['lang_id'];

	$file_name = $course_img['name'];
	$file_error = $course_img['error'];
	$file_tmp = $course_img['tmp_name'];


	$file_ext = explode('.', $file_name);
	$file_check = strtolower(end($file_ext));

	$file_ext_stored = array('png', 'jpg', 'jpeg');


	if (in_array($file_check, $file_ext_stored)) {
		$file_name = unique_file_name($file_check);
		$destination_file = 'upload_imgs/' . $file_name;
		move_uploaded_file($file_tmp, '/opt/lampp/htdocs/ELearning/upload_imgs/' . $file_name);
	}

	try {
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$con->beginTransaction();

		$success = true;

		$q = $con->prepare("insert into courses(course_name,course_image,course_description, language_id) values(:course_name, :destination_file, :course_desc, :language_id)");
		$q->bindParam("course_name", $course_name);
		$q->bindParam("destination_file", $destination_file);
		$q->bindParam("course_desc", $course_desc);
		$q->bindParam("language_id", $course_lang_id);
		$success = $success && $q->execute();

		$course_id = $con->lastInsertId();

		if (isset($_POST['categories']) && is_array($_POST['categories'])) {
			foreach ($_POST['categories'] as $category_id) {
				$q = $con->prepare("insert into course_categories values(:course_id, :category_id, 'course')");
				$q->bindParam("course_id", $course_id);
				$q->bindParam("category_id", $category_id);
				$success = $success && $q->execute();
			}
		}

		if (isset($_POST['pro_langs']) && is_array($_POST['pro_langs'])) {
			foreach ($_POST['pro_langs'] as $pro_lang_id) {
				$q = $con->prepare("insert into course_programming_languages values(:course_id, :pro_lang_id, 'course')");
				$q->bindParam("course_id", $course_id);
				$q->bindParam("pro_lang_id", $pro_lang_id);
				$success = $success && $q->execute();
			}
		}

		if ($success == true) {
			$con->commit();
			$_SESSION["success_message"] = "Add course successfully!";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
		} else {
			$con->rollBack();
			$_SESSION["failed_message"] = "Add course failed!";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
		}
	} catch (Exception $e) {
		$con->rollBack();
		$_SESSION["failed_message"] = "Add course failed!";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
		return;
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
		$_SESSION["success_message"] = "Delete course successfully!";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
	} else {
		$_SESSION["failed_message"] = "Delete course failed!";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
	}
}


if (isset($_POST['del_course_id'])) {
	$course_id = $_POST['course_id'];
	// Remove image
	$q = $con->prepare("SELECT course_image FROM courses WHERE id=:course_id");
	$q->bindParam("course_id", $course_id);
	$q->execute();

	$old_img = $q->fetch()['course_image'];
	$old_img_path = '/opt/lampp/htdocs/ELearning/' . $old_img;
	if (file_exists($old_img_path)) {
		unlink($old_img_path);
	}

	try {
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$con->beginTransaction();

		$success = true;

		// Clean up
		$q = $con->prepare("DELETE FROM course_categories WHERE course_id=:course_id AND course_type='course'");
		$q->bindParam("course_id", $course_id);
		$success = $success && $q->execute();

		$q = $con->prepare("DELETE FROM course_programming_languages WHERE course_id=:course_id AND course_type='course'");
		$q->bindParam("course_id", $course_id);
		$success = $success && $q->execute();

		$q = $con->prepare("DELETE FROM courses WHERE id=:course_id");
		$q->bindParam("course_id", $course_id);
		$r = $q->execute();
		if ($r == true) {
			$con->commit();
			$_SESSION["success_message"] = "Delete course successfully!";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
		} else {
			$con->rollBack();
			$_SESSION["failed_message"] = "Delete course failed!";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
		}
	} catch (Exception $e) {
		$con->rollBack();
		$_SESSION["failed_message"] = "Update course failed!" . $e->getMessage();
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course_video');
		return;
	}
}


// ==============================================================================
// code to update course by admin from manage_courses.php


if (isset($_POST['update_course'])) {
	$course_id = $_POST['course_id'];

	$course = get_course_video($course_id);

	$course_img = $_FILES['course_image'];
	$course_name = $_POST['course_name'] ?? $course['course_name'];
	$course_desc = $_POST['course_desc'] ?? $course['course_description'];
	$course_lang_id = $_POST['lang_id'] ?? $course['language_id'];

	$file_name = $course_img['name'];
	$file_error = $course_img['error'];
	$file_tmp = $course_img['tmp_name'];


	$file_ext = explode('.', $file_name);
	$file_check = strtolower(end($file_ext));

	$file_ext_stored = array('png', 'jpg', 'jpeg');

	if (in_array($file_check, $file_ext_stored)) {
		// Remove old image
		$q = $con->prepare("select course_image from courses WHERE id=:course_id");
		$q->bindParam("course_id", $course_id);
		$q->execute();
		$old_img = $q->fetch()['course_image'];
		$old_img_path = '/opt/lampp/htdocs/ELearning/' . $old_img;
		if (file_exists($old_img_path)) {
			unlink($old_img_path);
		}

		$file_name = unique_file_name($file_check);
		$destination_file = 'upload_imgs/' . $file_name;
		move_uploaded_file($file_tmp, '/opt/lampp/htdocs/ELearning/upload_imgs/' . $file_name);
	}

	$destination_file = $destination_file ?? $course['course_image'];

	try {
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$con->beginTransaction();

		$success = true;
		
		$q = $con->prepare("UPDATE courses SET course_name=:course_name, course_image=:destination_file,course_description=:course_desc,language_id=:language_id WHERE id=:course_id");
		$q->bindParam("destination_file", $destination_file);
		$q->bindParam("course_desc", $course_desc);
		$q->bindParam("course_id", $course_id);
		$q->bindParam("language_id", $course_lang_id);
		$success = $success && $q->execute();

		if (isset($_POST['categories']) && is_array($_POST['categories'])) {
			// Clean up
			$q = $con->prepare("DELETE FROM course_categories WHERE course_id=:course_id AND course_type='course'");
			$q->bindParam("course_id", $course_id);
			$success = $success && $q->execute();
			foreach ($_POST['categories'] as $category_id) {
				$q = $con->prepare("insert into course_categories values(:course_id, :category_id, 'course')");
				$q->bindParam("course_id", $course_id);
				$q->bindParam("category_id", $category_id);
				$success = $success && $q->execute();
			}
		}

		if (isset($_POST['pro_langs']) && is_array($_POST['pro_langs'])) {
			// Clean up
			$q = $con->prepare("DELETE FROM course_programming_languages WHERE course_id=:course_id AND course_type='course'");
			$q->bindParam("course_id", $course_id);
			$success = $success && $q->execute();
			foreach ($_POST['pro_langs'] as $pro_lang_id) {
				$q = $con->prepare("insert into course_programming_languages values(:course_id, :pro_lang_id, 'course')");
				$q->bindParam("course_id", $course_id);
				$q->bindParam("pro_lang_id", $pro_lang_id);
				$success = $success && $q->execute();
			}
		}

		if ($success == true) {
			$con->commit();
			$_SESSION["success_message"] = "Update course successfully!";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
		} else {
			$con->rollBack();
			$_SESSION["failed_message"] = "Update course failed!";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
		}
	} catch (Exception $e) {
		$con->rollBack();
		$_SESSION["failed_message"] = "Add course failed!";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
		return;
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
		$_SESSION["success_message"] = "Add topic successfully!";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
	} else {
		$_SESSION["failed_message"] = "Add topic failed!";
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
		$_SESSION["success_message"] = "Update topic successfully!";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?edit_course=' . $course_id);
	} else {
		$_SESSION["failed_message"] = "Update topic failed!";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?edit_course=' . $course_id);
	}
}


if (isset($_POST['del_topic'])) {
	$topic_id = $_POST['topic_id'];
	$q = $con->prepare("DELETE FROM course_topic WHERE id=:topic_id");
	$q->bindParam("topic_id", $topic_id);
	$r = $q->execute();
	if ($r == true) {
		$_SESSION["success_message"] = "Delete topic successfully!";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
	} else {
		$_SESSION["failed_message"] = "Delete topic failed!";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course');
	}
}

if (isset($_POST['add_course_video'])) {
	$course_name = $_POST['course_name'];
	$course_img = $_FILES['course_image'];
	$course_desc = $_POST['course_desc'];
	$course_lang_id = $_POST['lang_id'];

	$file_name = $course_img['name'];
	$file_error = $course_img['error'];
	$file_tmp = $course_img['tmp_name'];


	$file_ext = explode('.', $file_name);
	$file_check = strtolower(end($file_ext));

	$file_ext_stored = array('png', 'jpg', 'jpeg');


	if (in_array($file_check, $file_ext_stored)) {
		$file_name = unique_file_name($file_check);
		$destination_file = 'upload_imgs/' . $file_name;
		move_uploaded_file($file_tmp, '/opt/lampp/htdocs/ELearning/upload_imgs/' . $file_name);
	}

	try {
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$con->beginTransaction();

		$success = true;

		$q = $con->prepare("insert into course_videos(course_name,course_image,course_description, language_id) values(:course_name, :destination_file, :course_desc, :language_id)");
		$q->bindParam("course_name", $course_name);
		$q->bindParam("destination_file", $destination_file);
		$q->bindParam("course_desc", $course_desc);
		$q->bindParam("language_id", $course_lang_id);
		$success = $success && $q->execute();

		$course_id = $con->lastInsertId();

		if (isset($_POST['categories']) && is_array($_POST['categories'])) {
			foreach ($_POST['categories'] as $category_id) {
				$q = $con->prepare("insert into course_categories values(:course_id, :category_id, 'course_video')");
				$q->bindParam("course_id", $course_id);
				$q->bindParam("category_id", $category_id);
				$success = $success && $q->execute();
			}
		}

		if (isset($_POST['pro_langs']) && is_array($_POST['pro_langs'])) {
			foreach ($_POST['pro_langs'] as $pro_lang_id) {
				$q = $con->prepare("insert into course_programming_languages values(:course_id, :pro_lang_id, 'course_video')");
				$q->bindParam("course_id", $course_id);
				$q->bindParam("pro_lang_id", $pro_lang_id);
				$success = $success && $q->execute();
			}
		}

		if ($success == true) {
			$con->commit();
			$_SESSION["success_message"] = "Add course video successfully!";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course_video');
		} else {
			$con->rollBack();
			$_SESSION["failed_message"] = "Add course video failed!";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course_video');
		}
	} catch (Exception $e) {
		$con->rollBack();
		$_SESSION["failed_message"] = "Add course failed!" . $e->getMessage();
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course_video');
		return;
	}
}

if (isset($_POST['update_course_video'])) {
	$course_id = $_POST['course_id'];

	$course = get_course_video($course_id);

	$course_img = $_FILES['course_image'];
	$course_name = $_POST['course_name'] ?? $course['course_name'];
	$course_desc = $_POST['course_desc'] ?? $course['course_description'];
	$course_lang_id = $_POST['lang_id'] ?? $course['language_id'];

	$file_name = $course_img['name'];
	$file_error = $course_img['error'];
	$file_tmp = $course_img['tmp_name'];


	$file_ext = explode('.', $file_name);
	$file_check = strtolower(end($file_ext));

	$file_ext_stored = array('png', 'jpg', 'jpeg');

	if (in_array($file_check, $file_ext_stored)) {
		// Remove old image
		$q = $con->prepare("select course_image from course_videos WHERE id=:course_id");
		$q->bindParam("course_id", $course_id);
		$q->execute();
		$old_img = $q->fetch()['course_image'];
		$old_img_path = '/opt/lampp/htdocs/ELearning/' . $old_img;
		if (file_exists($old_img_path)) {
			unlink($old_img_path);
		}

		$file_name = unique_file_name($file_check);
		$destination_file = 'upload_imgs/' . $file_name;
		move_uploaded_file($file_tmp, '/opt/lampp/htdocs/ELearning/upload_imgs/' . $file_name);
	}

	$destination_file = $destination_file ?? $course['course_image'];

	try {
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$con->beginTransaction();

		$success = true;

		$q = $con->prepare("UPDATE course_videos SET course_name=:course_name, course_image=:destination_file,course_description=:course_desc,language_id=:language_id WHERE id=:course_id");
		$q->bindParam("course_name", $course_name);
		$q->bindParam("destination_file", $destination_file);
		$q->bindParam("course_desc", $course_desc);
		$q->bindParam("course_id", $course_id);
		$q->bindParam("language_id", $course_lang_id);
		$success = $success && $q->execute();

		if (isset($_POST['categories']) && is_array($_POST['categories'])) {
			// Clean up
			$q = $con->prepare("DELETE FROM course_categories WHERE course_id=:course_id");
			$q->bindParam("course_id", $course_id);
			$success = $success && $q->execute();
			foreach ($_POST['categories'] as $category_id) {
				$q = $con->prepare("insert into course_categories values(:course_id, :category_id, 'course_video')");
				$q->bindParam("course_id", $course_id);
				$q->bindParam("category_id", $category_id);
				$success = $success && $q->execute();
			}
		}

		if (isset($_POST['pro_langs']) && is_array($_POST['pro_langs'])) {
			// Clean up
			$q = $con->prepare("DELETE FROM course_programming_languages WHERE course_id=:course_id");
			$q->bindParam("course_id", $course_id);
			$success = $success && $q->execute();
			foreach ($_POST['pro_langs'] as $pro_lang_id) {
				$q = $con->prepare("insert into course_programming_languages values(:course_id, :pro_lang_id, 'course_video')");
				$q->bindParam("course_id", $course_id);
				$q->bindParam("pro_lang_id", $pro_lang_id);
				$success = $success && $q->execute();
			}
		}

		if ($success == true) {
			$con->commit();
			$_SESSION["success_message"] = "Update course successfully!";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course_video');
		} else {
			$con->rollBack();
			$_SESSION["failed_message"] = "Update course failed!";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course_video');
		}
	} catch (Exception $e) {
		$con->rollBack();
		$_SESSION["failed_message"] = "Update course failed!" . $e->getMessage();
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course_video');
		return;
	}
}


if (isset($_POST['del_course_video'])) {
	$course_id = $_POST['course_id'];
	// Remove image
	$q = $con->prepare("SELECT course_image FROM course_videos WHERE id=:course_id");
	$q->bindParam("course_id", $course_id);
	$q->execute();

	$old_img = $q->fetch()['course_image'];
	$old_img_path = '/opt/lampp/htdocs/ELearning/' . $old_img;
	if (file_exists($old_img_path)) {
		unlink($old_img_path);
	}

	try {
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$con->beginTransaction();

		$success = true;


		$q = $con->prepare("DELETE FROM course_videos WHERE id=:course_id");
		$q->bindParam("course_id", $course_id);
		$success = $success && $q->execute();

		// Clean up
		$q = $con->prepare("DELETE FROM course_categories WHERE course_id=:course_id AND course_type='course_video'");
		$q->bindParam("course_id", $course_id);
		$success = $success && $q->execute();

		$q = $con->prepare("DELETE FROM course_programming_languages WHERE course_id=:course_id AND course_type='course_video'");
		$q->bindParam("course_id", $course_id);
		$success = $success && $q->execute();
		if ($success == true) {
			$con->commit();
			$_SESSION["success_message"] = "Delete course video successfully!";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course_video');
		} else {
			$con->rollBack();
			$_SESSION["failed_message"] = "Delete course video failed!";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course_video');
		}
	} catch (Exception $e) {
		$con->rollBack();
		$_SESSION["failed_message"] = "Update course failed!" . $e->getMessage();
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?course_video');
		return;
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
			$_SESSION["success_message"] = "Add video topic successfully!";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?edit_course_video=' . $course_id);
		} else {
			$_SESSION["failed_message"] = "Add video topic failed!";
			echo "<script>alert('Add course Failed!');</script>";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?edit_course_video=' . $course_id);
		}
	}
}

if (isset($_POST['update_video_topic'])) {


	$topic_name = $_POST['topic_name'];
	$topic_id = $_POST['topic_id'];
	$video_path = $_POST['video'];

	if (isset($_FILES['topic_image']) && !empty($_FILES['topic_image']['name'])) {
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

			$q = $con->prepare("UPDATE course_video_topics SET topic_name=:topic_name, topic_image=:topic_image, video_path=:video_path WHERE id=:topic_id");
			$q->bindParam("topic_name", $topic_name);
			$q->bindParam("topic_id", $topic_id);
			$q->bindParam("topic_image", $destination_file);
			$q->bindParam("video_path", $video_path);
			$r = $q->execute();

			if ($r == true) {
				$_SESSION["success_message"] = "Update video topic successfully!";
				header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?edit_video_topic=' . $topic_id);
			} else {
				$_SESSION["failed_message"] = "Update video topic failed!";
				header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?edit_video_topic=' . $topic_id);
			}
		}

		return;
	}

	$q = $con->prepare("UPDATE course_video_topics SET topic_name=:topic_name, video_path=:video_path WHERE id=:topic_id");
	$q->bindParam("topic_name", $topic_name);
	$q->bindParam("topic_id", $topic_id);
	$q->bindParam("video_path", $video_path);
	$r = $q->execute();

	if ($r == true) {
		$_SESSION["success_message"] = "Update video topic successfully!";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?edit_video_topic=' . $topic_id);
	} else {
		$_SESSION["failed_message"] = "Update video topic failed!";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?edit_video_topic=' . $topic_id);
	}
}
