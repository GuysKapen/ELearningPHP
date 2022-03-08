<?php

// in this file --> code for add a new course ,update a course and delete a course by admin from manage_courses.php
session_start();
include("../connect.php");

// ==========================================================================================

// code to add a new course by admin from manage_courses.php

// add a new topic in the courses table (request came from add_new_topic.php)

if (isset($_POST['add_quiz'])) {


	$quiz_name = $_POST['quiz_name'];
	$course_id = $_POST['course_id'];

	$q = $con->prepare("INSERT INTO `course_quizz`( `quiz_name`, `course_id`) VALUES (:quiz_name, :course_id)");
	$q->bindParam("quiz_name", $quiz_name);
	$q->bindParam("course_id", $course_id);
	$r = $q->execute();
	if ($r == true) {
		$_SESSION["success_message"] = "Add quiz successful!";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?quiz');
	} else {
		$_SESSION["error_message"] = "Add quiz failed!";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?quiz');
	}
}


// =============================================================================================================

// update a topic in the courses table (request came from update_topic.php)


if (isset($_POST['update_quiz'])) {

	$course_id = $_POST['course_id'];
	$id = $_POST['id'];
	$quiz_name = $_POST['quiz_name'];

	$q = $con->prepare("UPDATE `course_quizz` SET `quiz_name`=:quiz_name,`course_id`=:course_id WHERE id=:id");
	$q->bindParam("quiz_name", $quiz_name);
	$q->bindParam("course_id", $course_id);
	$q->bindParam("id", $id);
	$r = $q->execute();
	if ($r) {
		$_SESSION["success_message"] = "Update quiz successful!";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?edit_quiz=' . $id);
	} else {
		echo "something went wrong";
	}
}


if (isset($_POST['del_quiz'])) {
	$quiz_id = $_POST['quiz_id'];
	$q = $con->prepare("DELETE FROM course_quizz WHERE id=:quiz_id");
	$q->bindParam("quiz_id", $quiz_id);
	$r = $q->execute();
	if ($r == true) {
		$_SESSION["success_message"] = "Delete quiz successful!";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?quiz');
	} else {
		$_SESSION["success_message"] = "Delete quiz failed!";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?quiz');
	}
}

if (isset($_POST['add_question'])) {

	$options_id = [];
	$question_id;

	$quiz_id = $_POST['quiz_id'];
	$question = $_POST['question'];

	try {
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$con->beginTransaction();

		$q = $con->prepare("INSERT INTO `course_questions`( `question`, `quiz_id`) VALUES (:question, :quiz_id)");
		$q->bindParam("question", $question);
		$q->bindParam("quiz_id", $quiz_id);
		$r = $q->execute();

		$question_id = $con->lastInsertId();

		if (isset($_POST['options'])) {
			if (is_array($_POST['options'])) {
				foreach ($_POST['options'] as $value) {
					$q = $con->prepare("INSERT INTO `course_question_options`( `question_id`, `content`) VALUES (:question_id, :content)");
					$q->bindParam("question_id", $question_id);
					$q->bindParam("content", $value);
					$r = $q->execute();

					$options_id[] = $con->lastInsertId();

					echo $value;
				}
			} else {
				$value = $_POST['invite'];
				$q = $con->prepare("INSERT INTO `course_question_options`( `question_id`, `content`) VALUES (:question_id, :content)");
				$q->bindParam("question_id", $question_id);
				$q->bindParam("content", $value);
				$r = $q->execute();

				$options_id[] = $con->lastInsertId();

				echo $value;
			}
		}


		if (isset($_POST['answers'])) {
			if (is_array($_POST['answers'])) {
				foreach ($_POST['answers'] as $value) {
					$q = $con->prepare("INSERT INTO `course_question_answer`( `question_id`, `option_answer_id`) VALUES (:question_id, :answer_id)");
					$q->bindParam("question_id", $question_id);
					$q->bindParam("answer_id", $options_id[$value]);
					$r = $q->execute();

					echo $value;
				}
			} else {
				$value = $_POST['invite'];
				$q = $con->prepare("INSERT INTO `course_question_answer`( `question_id`, `option_answer_id`) VALUES (:question_id, :answer_id)");
				$q->bindParam("question_id", $question_id);
				$q->bindParam("answer_id", $options_id[$value]);
				$r = $q->execute();

				echo $value;
			}
		}


		$con->commit();
		
	} catch (Exception $e) {
		$con->rollBack();
		$_SESSION["error_message"] = "Add question failed!";
		header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?edit_quiz=' . $quiz_id);
		return;
	}

	$_SESSION["success_message"] = "Add question successful!";
	header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/admin/index.php?edit_quiz=' . $quiz_id);
}
