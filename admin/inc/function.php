<?php

function is_admin($user_id)
{
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    $check = $con->prepare("select role_id from users where id=:id limit 1");
    $check->bindParam("id", $user_id);
    $check->execute();
    $role_id = $check->fetch()['role_id'];
    return $role_id == 2;
}

function add_cat()
{
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    if (isset($_POST['add_cat'])) {
        $cat_name = $_POST["cat_name"];

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $cat_name)));

        $check = $con->prepare("select 1 as result from categories where cat_name like :cat_name limit 1");
        $check->bindParam("cat_name", $cat_name);
        $check->execute();
        $count = $check->fetch()['result'];

        if ($count > 0) {
            $_SESSION["failed_message"] = "Category already existed";
            $con = null;
            return;
        }

        $add_cat = $con->prepare("insert into categories (cat_name, slug) values (:name, :slug)");
        $add_cat->bindParam("slug", $slug);
        $add_cat->bindParam("name", $cat_name);
        if ($add_cat->execute()) {
            $_SESSION["success_message"] = "Add category successfully!";
            echo "<script>window.open('index.php?cat', '_self')</script>";
        } else {
            $_SESSION["failed_message"] = "Add category failed!";
            echo "<script>window.open('index.php?cat', '_self')</script>";
        }
        $con = null;
    }
}

function update_cat()
{
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    if (isset($_POST['update_cat'])) {
        $cat_name = $_POST["name"];
        $cat_id = $_POST["id"];

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $cat_name)));

        $update_cat = $con->prepare("update categories set cat_name=:name, slug=:slug where cat_id=:id");
        $update_cat->bindParam("slug", $slug);
        $update_cat->bindParam("name", $cat_name);
        $update_cat->bindParam("id", $cat_id);
        if ($update_cat->execute()) {
            $_SESSION["success_message"] = "Update category successfully!";
            echo "<script>window.open('index.php?cat', '_self')</script>";
        } else {
            $_SESSION["failed_message"] = "Update category failed!";
            echo "<script>window.open('index.php?cat', '_self')</script>";
        }
        $con = null;
    }
}

function add_sub_cat()
{
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
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
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
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
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    $sel_cat = $con->prepare("select * from categories");
    $sel_cat->setFetchMode(PDO::FETCH_ASSOC);
    $sel_cat->execute();

    $cats = array();
    while ($row = $sel_cat->fetch()) {
        array_push($cats, array("name" => $row["cat_name"], "id" => $row["cat_id"], "slug" => $row["slug"]));
    }
    $con = null;
    return $cats;
}

function select_roles()
{
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    $sel_cat = $con->prepare("select * from roles");
    $sel_cat->setFetchMode(PDO::FETCH_ASSOC);
    $sel_cat->execute();

    $results = array();
    while ($row = $sel_cat->fetch()) {
        array_push($results, $row);
    }
    $con = null;
    return $results;
}

function select_accounts()
{
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    $sel_cat = $con->prepare("select u.*, r.name from users u inner join roles r on r.id=u.role_id");
    $sel_cat->setFetchMode(PDO::FETCH_ASSOC);
    $sel_cat->execute();

    $users = array();
    while ($row = $sel_cat->fetch()) {
        array_push($users, $row);
    }
    $con = null;
    return $users;
}



function select_sub_categories()
{
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
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
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    $sel_cat = $con->prepare("select * from categories where cat_id=:id");
    $sel_cat->bindParam("id", $id);
    $sel_cat->setFetchMode(PDO::FETCH_ASSOC);
    $sel_cat->execute();

    $row = $sel_cat->fetch();
    $con = null;
    return array("name" => $row["cat_name"], "id" => $row["cat_id"]);
}

function get_account($id)
{
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    $sel_cat = $con->prepare("select * from users u inner join roles r on r.id=u.role_id where u.id=:id");
    $sel_cat->bindParam("id", $id);
    $sel_cat->setFetchMode(PDO::FETCH_ASSOC);
    $sel_cat->execute();

    $row = $sel_cat->fetch();
    $con = null;
    return $row;
}

function get_sub_category($id)
{
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
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
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    $del_cat = $con->prepare("delete from categories where cat_id=:id");
    $del_cat->bindParam("id", $id);
    if ($del_cat->execute()) {
        $_SESSION["success_message"] = "Delete category successfully";
        echo "<script>window.open('index.php?cat', '_self')</script>";
    } else {
        $_SESSION["failed_message"] = "Delete category failed";
        echo "<script>window.open('index.php?cat', '_self')</script>";
    }
    $con = null;
}


function del_sub_category()
{
    if (!isset($_GET['del_sub_cat'])) return;
    $id = $_GET['del_sub_cat'];
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
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
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    if (isset($_POST['add_lang'])) {
        $lang_name = $_POST["name"];

        $check = $con->prepare("select 1 as result from languages where lang_name like :lang_name limit 1");
        $check->bindParam("lang_name", $lang_name);
        $check->execute();
        $count = $check->fetch()['result'];

        if ($count > 0) {
            $_SESSION["failed_message"] = "Language already existed";
            $con = null;
            return;
        }

        $add_lang = $con->prepare("insert into languages (lang_name) values (:name)");
        $add_lang->bindParam("name", $lang_name);
        if ($add_lang->execute()) {
            $_SESSION["success_message"] = "Add language successfully!";
            echo "<script>window.open('index.php?lang', '_self')</script>";
        } else {
            $_SESSION["failed_message"] = "Add language failed!";
            echo "<script>window.open('index.php?lang', '_self')</script>";
        }
        $con = null;
    }
}

function get_language($id)
{
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    $sel_lang = $con->prepare("select * from languages where lang_id=:id");
    $sel_lang->bindParam("id", $id);
    $sel_lang->setFetchMode(PDO::FETCH_ASSOC);
    $sel_lang->execute();

    $row = $sel_lang->fetch();
    $con = null;
    return array("name" => $row["lang_name"], "id" => $row["lang_id"]);
}

function update_lang()
{
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    if (isset($_POST['update_lang'])) {
        $lang_name = $_POST["name"];
        $lang_id = $_POST["id"];

        $check = $con->prepare("select 1 as result from languages where lang_name like :lang_name limit 1");
        $check->bindParam("lang_name", $lang_name);
        $check->execute();
        $count = $check->fetch()['result'];

        if ($count > 0) {
            echo "<script>alert('Lang already existed');</script>";
            $con = null;
            return;
        }


        $update_lang = $con->prepare("update languages set lang_name=:name where lang_id=:id");
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
    
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    $del_lang = $con->prepare("delete from languages where lang_id=:id");
    $del_lang->bindParam("id", $id);
    if ($del_lang->execute()) {
        $_SESSION["success_message"] = "Delete language successfully!";
        echo "<script>window.open('index.php?lang', '_self')</script>";
    } else {
        $_SESSION["failed_message"] = "Delete language failed!";
        echo "<script>window.open('index.php?lang', '_self')</script>";
    }
    $con = null;
}

function select_langs()
{
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    $sel_lang = $con->prepare("select * from languages");
    $sel_lang->setFetchMode(PDO::FETCH_ASSOC);
    $sel_lang->execute();

    $langs = array();
    while ($row = $sel_lang->fetch()) {
        array_push($langs, array("name" => $row["lang_name"], "id" => $row["lang_id"]));
    }
    $con = null;
    return $langs;
}

function get_programming_language($id)
{
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    $sel_lang = $con->prepare("select * from programming_languages where id=:id");
    $sel_lang->bindParam("id", $id);
    $sel_lang->setFetchMode(PDO::FETCH_ASSOC);
    $sel_lang->execute();

    $row = $sel_lang->fetch();
    $con = null;
    return array("name" => $row["lang_name"], "id" => $row["id"], "lang_image" => $row["lang_image"]);
}

function select_programming_langs()
{
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    $sel_lang = $con->prepare("select * from programming_languages");
    $sel_lang->setFetchMode(PDO::FETCH_ASSOC);
    $sel_lang->execute();

    $langs = array();
    while ($row = $sel_lang->fetch()) {
        array_push($langs, array("name" => $row["lang_name"], "id" => $row["id"], "lang_image" => $row["lang_image"]));
    }
    $con = null;
    return $langs;
}


function select_terms()
{
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
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
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
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
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
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
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
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
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
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
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
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
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
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
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
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
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
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
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    $course_list;
    $query = $con->prepare("select c.*, u.username from courses c inner join users u on c.user_id=u.id");
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    while ($row = $query->fetch()) {
        $course_list[] = $row;
    }
    return $course_list;
}

function course_topics($course_id)
{
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    $topic_list = [];
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
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
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
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
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
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    $course_video_list = [];
    $query = $con->prepare("select c.*, u.username from course_videos c inner join users u on c.user_id=u.id");
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    while ($row = $query->fetch()) {
        $course_video_list[] = $row;
    }
    return $course_video_list;
}


function get_course_video($course_id)
{
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
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
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
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
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    $list = [];
    $query = $con->prepare("select q.*, c.course_name from course_quizz q inner join courses c on q.course_id=c.id");
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    while ($row = $query->fetch()) {
        $list[] = $row;
    }
    return $list;
}

function get_quiz($quiz_id)
{
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
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
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
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

function quiz_question_options($quiz_id)
{
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    $separator = '<--br-->';
    $concat_sep = '<---->';
    $topic_list = [];
    $query = $con->prepare("select q.*, group_concat(distinct o.content,'<---->' , o.id separator  '<--br-->') as options,  group_concat(distinct a.option_answer_id separator '<--br-->') as answers from course_questions q inner join course_question_options o on q.id = o.question_id left join course_question_answer a on q.id=a.question_id where q.quiz_id=:quiz_id group by q.id;");
    $query->bindParam("quiz_id", $quiz_id);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    while ($row = $query->fetch()) {
        $concat_options = explode($separator, $row['options']);
        $options = [];
        $option_ids = [];

        for ($i = 0; $i < count($concat_options); $i++) {
            $option = $concat_options[$i];
            $split = explode($concat_sep, $option);
            $options[] = $split[0];
            $option_ids[] = $split[1];
        }

        $row['options'] = $options;
        $row['option_ids'] = $option_ids;
        $row['answers'] = explode($separator, $row['answers']);
        $topic_list[] = $row;
    }
    return $topic_list;
}


function get_question($question_id)
{
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    $separator = '<--br-->';
    $query = $con->prepare("select q.*, group_concat(o.content separator  '<--br-->') as options, group_concat(o.id separator '<--br-->') as option_ids,  group_concat(distinct a.option_answer_id separator '<--br-->') as answers from course_questions q inner join course_question_options o on q.id = o.question_id left join course_question_answer a on q.id=a.question_id where q.id=:question_id group by q.id;");
    $query->bindParam("question_id", $question_id);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    $row = $query->fetch();
    $row['options'] = explode($separator, $row['options']);
    $row['option_ids'] = explode($separator, $row['option_ids']);
    $row['answers'] = explode($separator, $row['answers']);
    $con = null;
    return $row;
}

function get_topic_video($topic_id)
{
    include($_SERVER['DOCUMENT_ROOT'] . "/ELearning/admin/inc/connect.php");
    $topic_list;
    $query = $con->prepare("select * from course_videos c inner join course_video_topics t on c.id=t.course_id where t.id=:topic_id");
    $query->bindParam("topic_id", $topic_id);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    $row = $query->fetch();
    $con = null;
    return $row;
}
