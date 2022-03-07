<?php
function add_cat()
{
    include("inc/connect.php");
    if (isset($_POST['add_cat'])) {
        $cat_name = $_POST["cat_name"];

        $check = $con->prepare("select 1 as result from categories where cat_name like :cat_name limit 1");
        $check->bindParam("cat_name", $cat_name);
        $check->execute();
        $count = $check->fetch()['result'];

        if ($count > 0) {
            echo "<script>alert('Category already existed');</script>";
            $con = null;
            return;
        }

        $add_cat = $con->prepare("insert into categories (cat_name) values (:name)");
        $add_cat->bindParam("name", $cat_name);
        if ($add_cat->execute()) {
            echo "<script>alert('Add category successfully!');</script>";
            echo "<script>window.open('index.php?cat', '_self')</script>";
        } else {
            echo "<script>alert('Add category Failed!');</script>";
            echo "<script>window.open('index.php?cat', '_self')</script>";
        }
        $con = null;
    }
}

function update_cat()
{
    include("inc/connect.php");
    if (isset($_POST['update_cat'])) {
        $cat_name = $_POST["name"];
        $cat_id = $_POST["id"];

        $check = $con->prepare("select 1 as result from categories where cat_name like :cat_name limit 1");
        $check->bindParam("cat_name", $cat_name);
        $check->execute();
        $res = $check->fetch(PDO::FETCH_ASSOC);
        $count = $res['result'];
        if ($count > 0) {
            echo "<script>alert('Category already existed');</script>";
            $con = null;
            return;
        }

        $update_cat = $con->prepare("update categories set cat_name=:name where cat_id=:id");
        $update_cat->bindParam("name", $cat_name);
        $update_cat->bindParam("id", $cat_id);
        if ($update_cat->execute()) {
            echo "<script>alert('Update category successfully!');</script>";
            echo "<script>window.open('index.php?cat', '_self')</script>";
        } else {
            echo "<script>alert('Update category Failed!');</script>";
            echo "<script>window.open('index.php?cat', '_self')</script>";
        }
        $con = null;
    }
}

function add_sub_cat()
{
    include("inc/connect.php");
    if (isset($_POST['add_sub_cat'])) {
        $cat_name = $_POST["sub_cat_name"];
        $cat_id = $_POST["cat_id"];

        $check = $con->prepare("select 1 as result from sub_categories where sub_cat_name like :sub_cat_name limit 1");
        $check->bindParam("sub_cat_name", $cat_name);
        $check->execute();
        $count = $check->fetch()['result'];

        if ($count > 0) {
            echo "<script>alert('Sub category already existed');</script>";
            $con = null;
            return;
        }

        $add_cat = $con->prepare("insert into sub_categories (sub_cat_name, cat_id) values (:name, :cat_id)");
        $add_cat->bindParam("name", $cat_name);
        $add_cat->bindParam("cat_id", $cat_id);
        if ($add_cat->execute()) {
            echo "<script>alert('Add sub category successfully!');</script>";
            echo "<script>window.open('index.php?sub_cat', '_self')</script>";
        } else {
            echo "<script>alert('Add sub category Failed!');</script>";
            echo "<script>window.open('index.php?sub_cat', '_self')</script>";
        }
        $con = null;
    }
}

function update_sub_cat()
{
    include("inc/connect.php");
    if (isset($_POST['update_sub_cat'])) {
        $cat_name = $_POST["name"];
        $cat_id = $_POST["cat_id"];
        $id = $_POST["id"];

        $check = $con->prepare("select 1 as result from sub_categories where sub_cat_name like :sub_cat_name and cat_id=:cat_id limit 1");
        $check->bindParam("sub_cat_name", $cat_name);
        $check->bindParam("cat_id", $cat_id);
        $check->execute();
        $count = $check->fetch()['result'];

        if ($count > 0) {
            echo "<script>alert('Sub category already existed');</script>";
            $con = null;
            return;
        }

        $add_cat = $con->prepare("update sub_categories set sub_cat_name=:name, cat_id=:cat_id where sub_cat_id=:id");
        $add_cat->bindParam("name", $cat_name);
        $add_cat->bindParam("cat_id", $cat_id);
        $add_cat->bindParam("id", $id);

        print_r($add_cat->errorInfo());
        if ($add_cat->execute()) {
            echo "<script>alert('Update sub category successfully!');</script>";
            echo "<script>window.open('index.php?sub_cat', '_self')</script>";
        } else {
            echo "<script>alert('Update sub category Failed!');</script>";
            echo "<script>window.open('index.php?sub_cat', '_self')</script>";
        }
        $con = null;
    }
}

function select_categories()
{
    include("inc/connect.php");
    $sel_cat = $con->prepare("select * from categories");
    $sel_cat->setFetchMode(PDO::FETCH_ASSOC);
    $sel_cat->execute();

    $cats = array();
    while ($row = $sel_cat->fetch()) {
        array_push($cats, array("name" => $row["cat_name"], "id" => $row["cat_id"]));
    }
    $con = null;
    return $cats;
}


function select_sub_categories()
{
    include("inc/connect.php");
    $sel_cat = $con->prepare("select c.cat_name, s.sub_cat_name, s.sub_cat_id from categories c inner join sub_categories s on c.cat_id=s.cat_id");
    $sel_cat->setFetchMode(PDO::FETCH_ASSOC);
    $sel_cat->execute();

    $cats = array();
    while ($row = $sel_cat->fetch()) {
        array_push($cats, array("name" => $row["sub_cat_name"], "id" => $row["sub_cat_id"], "cat_name" => $row["cat_name"]));
    }
    $con = null;
    return $cats;
}

function get_category($id)
{
    include("inc/connect.php");
    $sel_cat = $con->prepare("select * from categories where cat_id=:id");
    $sel_cat->bindParam("id", $id);
    $sel_cat->setFetchMode(PDO::FETCH_ASSOC);
    $sel_cat->execute();

    $row = $sel_cat->fetch();
    $con = null;
    return array("name" => $row["cat_name"], "id" => $row["cat_id"]);
}

function get_sub_category($id)
{
    include("inc/connect.php");
    $sel_cat = $con->prepare("select * from sub_categories where sub_cat_id=:id");
    $sel_cat->bindParam("id", $id);
    $sel_cat->setFetchMode(PDO::FETCH_ASSOC);
    $sel_cat->execute();

    $cats = array();
    $row = $sel_cat->fetch();

    $con = null;
    return array("name" => $row["sub_cat_name"], "id" => $row["sub_cat_id"], "cat_id" => $row["cat_id"]);
}

function del_category()
{
    if (!isset($_GET['del_cat'])) return;
    $id = $_GET['del_cat'];
    include("inc/connect.php");
    $del_cat = $con->prepare("delete from categories where cat_id=:id");
    $del_cat->bindParam("id", $id);
    if ($del_cat->execute()) {
        echo "<script>alert('Delete category successfully!');</script>";
        echo "<script>window.open('index.php?sub_cat', '_self')</script>";
    } else {
        echo "<script>alert('Delete category Failed!');</script>";
        echo "<script>window.open('index.php?sub_cat', '_self')</script>";
    }
    $con = null;
}


function del_sub_category()
{
    if (!isset($_GET['del_sub_cat'])) return;
    $id = $_GET['del_sub_cat'];
    include("inc/connect.php");
    $del_cat = $con->prepare("delete from sub_categories where sub_cat_id=:id");
    $del_cat->bindParam("id", $id);
    if ($del_cat->execute()) {
        echo "<script>alert('Delete sub category successfully!');</script>";
        echo "<script>window.open('index.php?sub_cat', '_self')</script>";
    } else {
        echo "<script>alert('Delete sub category Failed!');</script>";
        echo "<script>window.open('index.php?sub_cat', '_self')</script>";
    }

    $con = null;
}

function add_lang()
{
    include("inc/connect.php");
    if (isset($_POST['add_lang'])) {
        $lang_name = $_POST["name"];

        $check = $con->prepare("select 1 as result from language where lang_name like :lang_name limit 1");
        $check->bindParam("lang_name", $lang_name);
        $check->execute();
        $count = $check->fetch()['result'];

        if ($count > 0) {
            echo "<script>alert('Language already existed');</script>";
            $con = null;
            return;
        }

        $add_lang = $con->prepare("insert into language (lang_name) values (:name)");
        $add_lang->bindParam("name", $lang_name);
        if ($add_lang->execute()) {
            echo "<script>alert('Add lang successfully!');</script>";
            echo "<script>window.open('index.php?lang', '_self')</script>";
        } else {
            echo "<script>alert('Add lang Failed!');</script>";
            echo "<script>window.open('index.php?lang', '_self')</script>";
        }
        $con = null;
    }
}

function get_language($id)
{
    include("inc/connect.php");
    $sel_lang = $con->prepare("select * from language where lang_id=:id");
    $sel_lang->bindParam("id", $id);
    $sel_lang->setFetchMode(PDO::FETCH_ASSOC);
    $sel_lang->execute();

    $row = $sel_lang->fetch();
    $con = null;
    return array("name" => $row["lang_name"], "id" => $row["lang_id"]);
}

function update_lang()
{
    include("inc/connect.php");
    if (isset($_POST['update_lang'])) {
        $lang_name = $_POST["name"];
        $lang_id = $_POST["id"];

        $check = $con->prepare("select 1 as result from language where lang_name like :lang_name limit 1");
        $check->bindParam("lang_name", $lang_name);
        $check->execute();
        $count = $check->fetch()['result'];

        if ($count > 0) {
            echo "<script>alert('Lang already existed');</script>";
            $con = null;
            return;
        }


        $update_lang = $con->prepare("update language set lang_name=:name where lang_id=:id");
        $update_lang->bindParam("name", $lang_name);
        $update_lang->bindParam("id", $lang_id);
        if ($update_lang->execute()) {
            echo "<script>alert('Update lang successfully!');</script>";
            echo "<script>window.open('index.php?lang', '_self')</script>";
        } else {
            echo "<script>alert('Update lang Failed!');</script>";
            echo "<script>window.open('index.php?lang', '_self')</script>";
        }
        $con = null;
    }
}

function del_lang()
{
    if (!isset($_GET['del_lang'])) return;
    $id = $_GET['del_lang'];
    include("inc/connect.php");
    $del_lang = $con->prepare("delete from language where lang_id=:id");
    $del_lang->bindParam("id", $id);
    if ($del_lang->execute()) {
        echo "<script>alert('Delete language successfully!');</script>";
        echo "<script>window.open('index.php?lang', '_self')</script>";
    } else {
        echo "<script>alert('Delete language Failed!');</script>";
        echo "<script>window.open('index.php?lang', '_self')</script>";
    }
    $con = null;
}

function select_langs()
{
    include("inc/connect.php");
    $sel_lang = $con->prepare("select * from language");
    $sel_lang->setFetchMode(PDO::FETCH_ASSOC);
    $sel_lang->execute();

    $langs = array();
    while ($row = $sel_lang->fetch()) {
        array_push($langs, array("name" => $row["lang_name"], "id" => $row["lang_id"]));
    }
    $con = null;
    return $langs;
}

function select_terms()
{
    include("inc/connect.php");
    $sel_term = $con->prepare("select * from terms");
    $sel_term->setFetchMode(PDO::FETCH_ASSOC);
    $sel_term->execute();

    $terms = array();
    while ($row = $sel_term->fetch()) {
        array_push($terms, array("name" => $row["name"], "id" => $row["id"], "type" => $row["type"]));
    }
    $con = null;
    return $terms;
}

function add_term()
{
    include("inc/connect.php");
    if (isset($_POST['add_term'])) {
        $term_name = $_POST["name"];
        $term_type = $_POST["type"];

        $check = $con->prepare("select 1 as result from terms where name like :name limit 1");
        $check->bindParam("name", $term_name);
        $check->execute();
        $count = $check->fetch()['result'];

        if ($count > 0) {
            echo "<script>alert('Term already existed');</script>";
            $con = null;
            return;
        }

        $add_term = $con->prepare("insert into terms (name, type) values (:name, :type)");
        $add_term->bindParam("name", $term_name);
        $add_term->bindParam("type", $term_type);
        if ($add_term->execute()) {
            echo "<script>alert('Add term successfully!');</script>";
            echo "<script>window.open('index.php?term', '_self')</script>";
        } else {
            echo "<script>alert('Add term Failed!');</script>";
            echo "<script>window.open('index.php?term', '_self')</script>";
        }
        $con = null;
    }
}

function update_term()
{
    include("inc/connect.php");
    if (isset($_POST['update_term'])) {
        $term_name = $_POST["name"];
        $term_id = $_POST["id"];
        $term_type = $_POST["type"];

        $check = $con->prepare("select 1 as result from terms where name like :name and type=:type limit 1");
        $check->bindParam("name", $term_name);
        $check->bindParam("type", $term_type);
        $check->execute();
        $count = $check->fetch()['result'];

        if ($count > 0) {
            echo "<script>alert('Term already existed');</script>";
            $con = null;
            return;
        }

        $update_term = $con->prepare("update terms set name=:name, type=:type where id=:id");
        $update_term->bindParam("name", $term_name);
        $update_term->bindParam("id", $term_id);
        $update_term->bindParam("type", $term_type);
        if ($update_term->execute()) {
            echo "<script>alert('Update term successfully!');</script>";
            echo "<script>window.open('index.php?term', '_self')</script>";
        } else {
            echo "<script>alert('Update term Failed!');</script>";
            echo "<script>window.open('index.php?term', '_self')</script>";
        }
        $con = null;
    }
}

function del_term()
{
    if (!isset($_GET['del_term'])) return;
    $id = $_GET['del_term'];
    include("inc/connect.php");
    $del = $con->prepare("delete from terms where id=:id");
    $del->bindParam("id", $id);
    if ($del->execute()) {
        echo "<script>alert('Delete term successfully!');</script>";
        echo "<script>window.open('index.php?term', '_self')</script>";
    } else {
        echo "<script>alert('Delete term Failed!');</script>";
        echo "<script>window.open('index.php?term', '_self')</script>";
    }
    $con = null;
}

function get_term($id)
{
    include("inc/connect.php");
    $sel = $con->prepare("select * from terms where id=:id");
    $sel->bindParam("id", $id);
    $sel->setFetchMode(PDO::FETCH_ASSOC);
    $sel->execute();

    $row = $sel->fetch();
    $con = null;
    return array("name" => $row["name"], "type" => $row["type"], "id" => $row["id"]);
}

function add_faq()
{
    include("inc/connect.php");
    if (isset($_POST['add_faq'])) {
        $question = $_POST["question"];
        $answer = $_POST["answer"];

        $check = $con->prepare("select 1 as result from faqs where question like :question limit 1");
        $check->bindParam("question", $question);
        $check->execute();
        $count = $check->fetch()['result'];

        if ($count > 0) {
            echo "<script>alert('FAQ already existed');</script>";
            $con = null;
            return;
        }

        $query = $con->prepare("insert into faqs (question, answer) values (:question, :answer)");
        $query->bindParam("question", $question);
        $query->bindParam("answer", $answer);

        if ($query->execute()) {
            echo "<script>alert('Add FAQ successfully!');</script>";
            echo "<script>window.open('index.php?faq', '_self')</script>";
        } else {
            echo "<script>alert('Add FAQ Failed!');</script>";
            echo "<script>window.open('index.php?faq', '_self')</script>";
        }
        $con = null;
    }
}

function del_faq()
{
    if (!isset($_GET['del_faq'])) return;
    $id = $_GET['del_faq'];
    include("inc/connect.php");
    $del = $con->prepare("delete from faqs where id=:id");
    $del->bindParam("id", $id);
    if ($del->execute()) {
        echo "<script>alert('Delete FAQ successfully!');</script>";
        echo "<script>window.open('index.php?faq', '_self')</script>";
    } else {
        echo "<script>alert('Delete FAQ Failed!');</script>";
        echo "<script>window.open('index.php?faq', '_self')</script>";
    }
    $con = null;
}

function update_faq()
{
    include("inc/connect.php");
    if (isset($_POST['update_faq'])) {
        $question = $_POST["question"];
        $id = $_POST["id"];
        $answer = $_POST["answer"];

        $check = $con->prepare("select 1 as result from faqs where answer like :answer and question like :question and type=:type limit 1");
        $check->bindParam("answer", $answer);
        $check->bindParam("question", $question);
        $check->execute();
        $count = $check->fetch()['result'];

        if ($count > 0) {
            echo "<script>alert('FAQ already existed');</script>";
            $con = null;
            return;
        }

        $update = $con->prepare("update faqs set question=:question, answer=:answer where id=:id");
        $update->bindParam("question", $question);
        $update->bindParam("id", $id);
        $update->bindParam("answer", $answer);
        if ($update->execute()) {
            echo "<script>alert('Update FAQ successfully!');</script>";
            echo "<script>window.open('index.php?faq', '_self')</script>";
        } else {
            echo "<script>alert('Update FAQ Failed!');</script>";
            print_r($update->errorInfo());
            // echo "<script>window.open('index.php?faq', '_self')</script>";
        }
        $con = null;
    }
}

function select_faqs()
{
    include("inc/connect.php");
    $sel = $con->prepare("select * from faqs");
    $sel->setFetchMode(PDO::FETCH_ASSOC);
    $sel->execute();

    $faqs = array();
    while ($row = $sel->fetch()) {
        array_push($faqs, array("question" => $row["question"], "id" => $row["id"], "answer" => $row["answer"]));
    }
    $con = null;
    return $faqs;
}

function display_courses()
{
    include("inc/connect.php");
    $course_list;
    $query = $con->prepare("select * from courses");
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    while ($row = $query->fetch()) {
        $course_list[] = $row;
    }
    return $course_list;
}

function course_topics($course_id)
{
    include("inc/connect.php");
    $topic_list;
    $query = $con->prepare("select * from course_topics where course_id=:course_id");
    $query->bindParam("course_id", $course_id);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    while ($row = $query->fetch()) {
        $topic_list[] = $row;
    }
    return $topic_list;
}


function get_topic($topic_id)
{
    include("inc/connect.php");
    $topic_list;
    $query = $con->prepare("select * from courses c inner join course_topics t on c.id=t.course_id where t.id=:topic_id");
    $query->bindParam("topic_id", $topic_id);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    $row = $query->fetch();
    $con = null;
    return $row;
}

function get_course($course_id)
{
    include("inc/connect.php");
    $query = $con->prepare("select * from courses where id=:course_id");
    $query->bindParam("course_id", $course_id);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    $row = $query->fetch();
    $con = null;
    return $row;
}


function display_course_videos()
{
    include("inc/connect.php");
    $course_video_list = [];
    $query = $con->prepare("select * from course_videos");
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    while ($row = $query->fetch()) {
        $course_video_list[] = $row;
    }
    return $course_video_list;
}


function get_course_video($course_id)
{
    include("inc/connect.php");
    $query = $con->prepare("select * from course_videos where id=:course_id");
    $query->bindParam("course_id", $course_id);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    $row = $query->fetch();
    $con = null;
    return $row;
}


function course_video_topics($course_id)
{
    include("inc/connect.php");
    $topic_list = [];
    $query = $con->prepare("select * from course_video_topics where course_id=:course_id");
    $query->bindParam("course_id", $course_id);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    while ($row = $query->fetch()) {
        $topic_list[] = $row;
    }
    return $topic_list;
}

function display_quizz()
{
    include("inc/connect.php");
    $list = [];
    $query = $con->prepare("select * from course_quizz q inner join courses c on q.course_id=c.id");
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    while ($row = $query->fetch()) {
        $list[] = $row;
    }
    return $list;
}

function get_quiz($quiz_id)
{
    include("inc/connect.php");
    $query = $con->prepare("select * from course_quizz where id=:quiz_id");
    $query->bindParam("quiz_id", $quiz_id);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    $row = $query->fetch();
    $con = null;
    return $row;
}

function quiz_questions($quiz_id)
{
    include("inc/connect.php");
    $topic_list = [];
    $query = $con->prepare("select * from course_questions where quiz_id=:quiz_id");
    $query->bindParam("quiz_id", $quiz_id);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    while ($row = $query->fetch()) {
        $topic_list[] = $row;
    }
    return $topic_list;
}
