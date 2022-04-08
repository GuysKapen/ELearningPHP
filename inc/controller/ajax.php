<?php
if (isset($_POST['course_id'])) {
    include("../function.php");
    $quizz = get_quizz_of($_POST['course_id']);
    exit(json_encode(array("success" => true, "quizz" => $quizz)));
}
