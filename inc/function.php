<?php

function get_contact()
{
    include('connect.php');
    $query = $con->prepare("select * from contacts");
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();
    $row = $query->fetch();

    $allowed = ["email", "address_1", "address_2", "fb", "gp", "tw", "link", "phone", "yt"];
    $filtered = array_filter(
        $row,
        function ($key) use ($allowed) {
            return in_array($key, $allowed);
        },
        ARRAY_FILTER_USE_KEY
    );

    return $filtered;
}


function get_courses()
{
    include('connect.php');
    $query = $con->prepare("select c.*, (select min(id) from course_topics t where t.course_id = c.id) as topic_id from courses c;");
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    $courses = array();
    while ($row = $query->fetch()) {
        array_push($courses, $row);
    }
    $con = null;
    return $courses;
}

function get_courses_info()
{
    include('connect.php');
    $query = $con->prepare("select c.*, u.username, u.email, u.role_id, (select min(id) from course_topics t where t.course_id = c.id) as topic_id from courses c inner join users u on c.user_id=u.id;");
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    $courses = array();
    while ($row = $query->fetch()) {
        array_push($courses, $row);
    }
    $con = null;
    return $courses;
}

function get_courses_match($keyword)
{
    include('connect.php');
    $query = $con->prepare("select c.*, (select min(id) from course_topics t where t.course_id = c.id) as topic_id from courses c where c.course_name like :keyword or c.course_description like :keyword;");
    $query->bindParam("keyword", $keyword);
    $query->bindParam("keyword", $keyword);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    $courses = array();
    while ($row = $query->fetch()) {
        array_push($courses, $row);
    }
    $con = null;
    return $courses;
}

function get_courses_of_category($cat_id)
{
    include('connect.php');
    $query = $con->prepare("select co.* from categories c inner join course_categories t on c.cat_id=t.category_id inner join courses co on co.id=t.course_id where c.cat_id=:cat_id;");
    $query->bindParam("cat_id", $cat_id);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    $courses = array();
    while ($row = $query->fetch()) {
        array_push($courses, $row);
    }
    $con = null;
    return $courses;
}

function get_course_videos()
{
    include('connect.php');
    $query = $con->prepare("select c.*, (select min(id) from course_video_topics t where t.course_id = c.id) as topic_id from course_videos c;");
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    $courses = array();
    while ($row = $query->fetch()) {
        array_push($courses, $row);
    }
    $con = null;
    return $courses;
}

function get_course_videos_info()
{
    include('connect.php');
    $query = $con->prepare("select c.*, u.username, u.email, u.role_id, (select min(id) from course_video_topics t where t.course_id = c.id) as topic_id from course_videos c inner join users u on c.user_id=u.id;");
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    $courses = array();
    while ($row = $query->fetch()) {
        array_push($courses, $row);
    }
    $con = null;
    return $courses;
}

function get_course_videos_match($keyword)
{
    include('connect.php');
    $query = $con->prepare("select c.*, (select min(id) from course_video_topics t where t.course_id = c.id) as topic_id from course_videos c where c.course_name like :keyword or c.course_description like :keyword;");
    $query->bindParam("keyword", $keyword);
    $query->bindParam("keyword", $keyword);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    $courses = array();
    while ($row = $query->fetch()) {
        array_push($courses, $row);
    }
    $con = null;
    return $courses;
}

function course_topics($course_id)
{
    include("connect.php");
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

function course_topic_videos($course_id)
{
    include("connect.php");
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

function get_topic_video($topic_id)
{
    include("inc/connect.php");
    $topic_list;
    $query = $con->prepare("select * from course_videos c inner join course_video_topics t on c.id=t.course_id where t.id=:topic_id");
    $query->bindParam("topic_id", $topic_id);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    $row = $query->fetch();
    $con = null;
    return $row;
}

function get_related_topic_video($topic_id)
{
    include("inc/connect.php");
    $topic_list = [];
    $query = $con->prepare("select distinct t.* from course_video_topics t inner join course_video_topics o on t.course_id=o.course_id where o.id=:topic_id;");
    $query->bindParam("topic_id", $topic_id);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    while ($row = $query->fetch()) {
        $topic_list[] = $row;
    }
    return $topic_list;
}

function get_quizz()
{
    include('connect.php');
    $query = $con->prepare("select * from course_quizz;");
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    $courses = array();
    while ($row = $query->fetch()) {
        array_push($courses, $row);
    }
    $con = null;
    return $courses;
}

function get_quizz_of($course_id)
{
    include('connect.php');
    $query = $con->prepare("select * from course_quizz where course_id=:course_id;");
    $query->bindParam("course_id", $course_id);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    $courses = array();
    while ($row = $query->fetch()) {
        array_push($courses, $row);
    }
    $con = null;
    return $courses;
}

function quiz_question_options($quiz_id)
{
    include($_SERVER['DOCUMENT_ROOT'] . '/ELearning/inc/connect.php');
    $separator = '<--br-->';
    $concat_sep = '<---->';
    $topic_list = [];
    $query = $con->prepare("select q.*, group_concat(distinct o.content,'<---->' , o.id separator  '<--br-->') as options,  group_concat(distinct a.option_answer_id separator '<--br-->') as answers from course_questions q inner join course_question_options o on q.id = o.question_id left join course_question_answer a on q.id=a.question_id where q.quiz_id=1 group by q.id;    ");
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