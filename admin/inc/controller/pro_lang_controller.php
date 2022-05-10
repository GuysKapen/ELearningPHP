<?php

// in this file --> code for add a new course ,update a course and delete a course by admin from manage_courses.php

session_start();

include("../connect.php");
include("../utils.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/function.php");

// ==========================================================================================

// code to add a new course by admin from manage_courses.php

if (isset($_POST['add_pro_lang'])) {
	$lang_name = $_POST["name"];
	$lang_img = $_FILES['image'];

	$check = $con->prepare("select 1 as result from programming_languages where lang_name like :lang_name limit 1");
	$check->bindParam("lang_name", $lang_name);
	$check->execute();
	$count = $check->fetch()['result'];

	if ($count > 0) {
		$con = null;
		$_SESSION['failed_message'] = 'Language already existed';
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?pro_lang');
		return;
	}

	$file_name = $lang_img['name'];
	$file_error = $lang_img['error'];
	$file_tmp = $lang_img['tmp_name'];


	$file_ext = explode('.', $file_name);
	$file_check = strtolower(end($file_ext));

	$file_ext_stored = array('png', 'jpg', 'jpeg');

	if (in_array($file_check, $file_ext_stored)) {
		$file_name = unique_file_name($file_check);
		$destination_file = 'upload_imgs/' . $file_name;
		move_uploaded_file($file_tmp, $_SERVER['DOCUMENT_ROOT'] . '/ELearning/upload_imgs/' . $file_name);

		$add_lang = $con->prepare("insert into programming_languages (lang_name, lang_image) values (:name, :image)");
		$add_lang->bindParam("name", $lang_name);
		$add_lang->bindParam("image", $destination_file);

		if ($add_lang->execute()) {
			$_SESSION['success_message'] = 'Add lang successfully!';
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?pro_lang');
		} else {
			$_SESSION['failed_message'] = 'Add lang failed!';
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?pro_lang');
		}
	}
	$con = null;
}



if (isset($_POST['update_pro_lang'])) {
	$lang_name = $_POST["name"];
	$lang_id = $_POST["id"];
	$lang_img = $_FILES['image'];


	$file_name = $lang_img['name'];
	$file_error = $lang_img['error'];
	$file_tmp = $lang_img['tmp_name'];


	$file_ext = explode('.', $file_name);
	$file_check = strtolower(end($file_ext));

	$file_ext_stored = array('png', 'jpg', 'jpeg');

	if (in_array($file_check, $file_ext_stored)) {
		// Remove old image
		$q = $con->prepare("select lang_image from programming_laanguages WHERE id=:id");
		$q->bindParam("id", $lang_id);
		$q->execute();
		$old_img = $q->fetch()['lang_image'];
		$old_img_path = $_SERVER['DOCUMENT_ROOT'] . '/ELearning/' . $old_img;
		if (file_exists($old_img_path)) {
			unlink($old_img_path);
		}


		$file_name = unique_file_name($file_check);
		$destination_file = 'upload_imgs/' . $file_name;
		move_uploaded_file($file_tmp, $_SERVER['DOCUMENT_ROOT'] . '/ELearning/upload_imgs/' . $file_name);

		$update_lang = $con->prepare("update programming_languages set lang_name=:name, lang_image=:image where id=:id");
		$update_lang->bindParam("name", $lang_name);
		$update_lang->bindParam("image", $destination_file);
		$update_lang->bindParam("id", $lang_id);

		if ($update_lang->execute()) {
			$_SESSION['success_message'] = 'Update lang successfully!';
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?pro_lang');
		} else {
			$_SESSION['failed_message'] = 'Update lang failed!';
			header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?pro_lang');
		}
	}
	$con = null;
}


if (isset($_POST['del_pro_lang'])) {

	$id = $_POST['pro_lang_id'];

	
	$pro_lang = get_programming_language($id);
	
	if ($pro_lang == null) {
		return;
	}

	//Remove old file
	$old_file = $_SERVER['DOCUMENT_ROOT'] . "/ELearning/" . $pro_lang["lang_image"];
	if (file_exists($old_file)) {
		unlink($old_file);
	}

	$del_lang = $con->prepare("delete from programming_languages where id=:id");
	$del_lang->bindParam("id", $id);
	if ($del_lang->execute()) {
		$_SESSION['success_message'] = 'Delete programming language successfully!';
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?pro_lang');
	} else {
		$_SESSION['failed_message'] = 'Delete programming lang failed!';
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?pro_lang');
	}
	$con = null;
}
