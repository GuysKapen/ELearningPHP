<?php 
function get_contact() {
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


function get_courses() {
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