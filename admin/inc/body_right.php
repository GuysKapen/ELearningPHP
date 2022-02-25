<div class="pl-60">

    <?php
    if (isset($_GET['cat'])) {
        include("category/category.php");
    }

    if (isset($_GET['sub_cat'])) {
        include("sub_category/sub_category.php");
    }

    if (isset($_GET['edit_cat'])) {
        include("category/edit_category.php");
    }

    if (isset($_GET['edit_sub_cat'])) {
        include("sub_category/edit_sub_category.php");
    }

    if (isset($_GET['lang'])) {
        include("language/language.php");
    }

    if (isset($_GET['edit_lang'])) {
        include("language/edit_language.php");
    }

    if (isset($_GET['course'])) {
        include("course/course.php");
    }

    if (isset($_GET['edit_course'])) {
        include("course/edit_course.php");
    }

    if (isset($_GET['edit_topic'])) {
        include("course/edit_topic.php");
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

    ?>


</div>