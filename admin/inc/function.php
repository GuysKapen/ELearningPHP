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
        $count = $check->fetch()['result'];

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

    $cats = array();
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
