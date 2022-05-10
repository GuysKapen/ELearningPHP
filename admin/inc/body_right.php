<div class="pl-60">

    <?php

    if (count($_GET) == 0) {
        include("course/course.php");
        return;
    }

    if (isset($_GET['cat'])) {
        include("category/category.php");
    }

    if (isset($_GET['lang'])) {
        include("language/language.php");
    }

    if (isset($_GET['edit_lang'])) {
        include("language/edit_language.php");
    }

    if (isset($_GET['account'])) {
        include("account/accounts.php");
    }

    if (isset($_GET['edit_account'])) {
        include("account/edit_account.php");
    }

    if (isset($_GET['pro_lang'])) {
        include("programming_language/programming_languages.php");
    }

    if (isset($_GET['edit_pro_lang'])) {
        include("programming_language/edit_programming_language.php");
    }

    if (isset($_GET['course'])) {
        include("course/course.php");
    }

    if (isset($_GET['add_topic'])) {
        include("course/add_new_topic.php");
    }

    if (isset($_GET['edit_course'])) {
        include("course/edit_course.php");
    }

    if (isset($_GET['edit_topic'])) {
        include("course/edit_topic.php");
    }

    if (isset($_GET['course_video'])) {
        include("course_video/course_video.php");
    }

    if (isset($_GET['add_video_topic'])) {
        include("course_video/add_new_video_topic.php");
    }

    if (isset($_GET['edit_course_video'])) {
        include("course_video/edit_course_video.php");
    }

    if (isset($_GET['edit_video_topic'])) {
        include("course_video/edit_video_topic.php");
    }

    if (isset($_GET['quiz'])) {
        include("quiz/quiz.php");
    }

    if (isset($_GET['edit_quiz'])) {
        include("quiz/edit_quiz.php");
    }

    if (isset($_GET['add_question'])) {
        include("quiz/add_new_question.php");
    }

    if (isset($_GET['edit_question'])) {
        include("quiz/edit_question.php");
    }

    if (isset($_GET['term'])) {
        include("term.php");
    }

    if (isset($_GET['edit_term'])) {
        include("edit_term.php");
    }

    if (isset($_GET['contact'])) {
        include("contact.php");
    }

    if (isset($_GET['faq'])) {
        include("faq.php");
    }

    echo del_category();
    echo del_lang();

    ?>


</div>